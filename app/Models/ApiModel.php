<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class ApiModel extends Model
{
    use HasUuid;

    protected $hidden = ['id'];

    protected $casts = [
        'uuid' => 'string'
    ];

    protected static function booted() 
    {
        static::creating(function ($model) {
            if(empty($model->uuid)) {
                $model->uuid = Str::uuid()->toString();
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
