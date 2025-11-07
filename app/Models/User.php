<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
  protected $fillable = [
        'name',
        'last_name',
        'email',
        'phone',
        'status_id',
        'city_id',
        'profile_image_path',
        'password'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password'
        
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
           
            'password' => 'hashed',
        ];
    }

     public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function clients()
    {
        return $this->hasMany(Client::class, 'sales_person_id');
    }


}
