<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarBrand extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];


public function models()
{
    return $this->hasMany(CarModel::class, 'car_brand_id');
}
}
