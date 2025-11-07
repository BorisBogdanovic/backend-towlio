<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Status;
use App\Models\CarBrand;
use App\Http\Requests\SearchCarBrandRequest;
use App\Http\Requests\SearchCarModelRequest;
use App\Models\CarModel;
use App\Models\Service;

class MasterDataController extends Controller
{
/////////////////////////////////////////////////////////////////////GET STATUSES
   public function statuses(){
    $countries = Status::all();
    return response()->json([
            'status' => true,
            'message' => 'all statuses',
            'data' => $countries
        ]);
}
/////////////////////////////////////////////////////////////////////GET CITIES
public function cities(){
    $countries = City::all();

    return response()->json([
            'status' => true,
            'message' => 'all cities',
            'data' => $countries
        ]);
}
/////////////////////////////////////////////////////////////////////GET CAR BRANDS
public function index(SearchCarBrandRequest $request)
{
    $query = $request->get('q', '');

    $brandsQuery = CarBrand::query()->orderBy('name');

    if (!empty($query)) {
        $brandsQuery->where('name', 'like', "%{$query}%");
    }

   $brands = $brandsQuery->limit(50)->get(['id', 'name']);

    return response()->json($brands);
}
/////////////////////////////////////////////////////////////////////GET CAR MODELS
public function models(SearchCarModelRequest $request)
{
    $brandId = $request->get('brand_id');
    $query = $request->get('q', '');
    if (!$brandId) {
        return response()->json(['message' => 'Brand ID is required'], 400);
    }
    $modelsQuery = CarModel::query()
        ->where('car_brand_id', $brandId)
        ->orderBy('name');
    if (!empty($query)) {
        $modelsQuery->where('name', 'like', "%{$query}%");
    }
    $models = $modelsQuery->get(['id', 'name']);
    return response()->json($models);
}
/////////////////////////////////////////////////////////////////////GET SERVICES
public function service(){
    $services = Service::all();
    return response()->json([
            'status' => true,
            'message' => 'all statuses',
            'data' =>  $services
        ]);
}
}
