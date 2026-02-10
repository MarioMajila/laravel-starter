<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class defaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'uuid' => Str::uuid()->toString(),
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => bcrypt('password')
        ]);
    }
}
