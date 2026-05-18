<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
        'file_size' => 'integer',
        'voice_duration' => 'integer',
    ];

    protected $appends = [
        'file_url',
    ];

    public function from()
    {
        return $this->belongsTo(User::class, 'from_id');
    }

    public function to()
    {
        return $this->belongsTo(User::class, 'to_id');
    }

    public function getFileUrlAttribute()
    {
        return $this->file_path
            ? Storage::url($this->file_path)
            : null;
    }
}