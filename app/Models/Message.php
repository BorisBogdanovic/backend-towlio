<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
     protected $fillable = [
        'from_id',
        'to_id',
        'type',
        'message',
        'file_path',
        'file_name',
        'file_size',
        'voice_duration',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function from()
    {
        return $this->belongsTo(User::class, 'from_id');
    }

    public function to()
    {
        return $this->belongsTo(User::class, 'to_id');
    }
}
