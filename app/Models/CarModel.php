<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    public $timestamps = false;

    protected $fillable = ['car_brand_id', 'name'];

    public function brand()
    {
        return $this->belongsTo(CarBrand::class, 'car_brand_id');
    }
}
