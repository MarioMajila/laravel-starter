<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApiController;
use App\Http\Requests\auth\LoginRequest;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends ApiController
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return $this->responseSuccess([
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ], 'Authentification réussie');
        }

        return $this->responseError('Identifiants invalides', Response::HTTP_UNAUTHORIZED);
    }

    public function register(Request $request)
    {
        // Implementer la logique d'enregistrement de l'utilisateur
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        return $this->responseSuccess(null, 'Déconnexion réussie');
    }
}
