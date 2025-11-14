<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
   use HasFactory;

    protected $fillable = [
        'client_name',
        'client_last_name',
        'address',
        'phone',
        'email',
        'car_brand_id',    
        'car_model_id',
        'licence_plate',
        'vin',
        'start_date',
        'towlio_service_id',
        'sales_person_id',
        'expired_date',
        'status',
        'production_year',
        'city',
        'country',
        
    ];

    protected $casts = [
        'status' => 'boolean',
        'start_date' => 'date',
        'expired_date' => 'date',
    ];

     public function service()
    {
        return $this->belongsTo(Service::class, 'towlio_service_id');
    }

     public function salesPerson()
    {
        return $this->belongsTo(User::class, 'sales_person_id');
    }

     public function brand()
    {
        return $this->belongsTo(CarBrand::class, 'car_brand_id');
    }

    public function model()
    {
        return $this->belongsTo(CarModel::class, 'car_model_id');
    }

    public function checkExpired()
    {
        if ($this->expired_date->isPast() && $this->status) {
            $this->status = false;
            $this->save();
        }

        return $this->status;
    }
}
