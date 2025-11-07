<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $fillable = ['email', 'token', 'name', 'last_name', 'phone','expires_at'];


    public $timestamps = false;

    protected $casts = [
    'expires_at' => 'datetime',
    ];

     public function getRouteKey()
    {
        return 'token'; 
    }

    public function getRouteKeyName()
    {
        return 'token'; 
    }

}
