<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AnalyticsResource;
use App\Models\User;
use App\Models\Service;

class AnalyticsController extends Controller
{
    public function getDashboardData()
    {
        
        $users = User::withCount([
            'clients as total_clients',
            'clients as active_clients' => fn($query) => $query->where('status', true),
            'clients as inactive_clients' => fn($query) => $query->where('status', false),
        ])
        ->whereHas('clients')
        ->get(['id', 'name']);

        
        $totals = [
            'total_clients' => $users->sum('total_clients'),
            'active_clients' => $users->sum('active_clients'),
            'inactive_clients' => $users->sum('inactive_clients'),
        ];

        
        $services = Service::withCount('clients')->get(['id', 'name', 'price'])
    ->map(fn($service) => [
        'id' => $service->id,
        'name' => $service->name,
        'clients_count' => $service->clients_count,
        'total_earned' => $service->clients_count * $service->price, 
    ]);

        
        return response()->json([
            'status' => true,
            'message' => 'Dashboard data fetched successfully.',
            'data' => AnalyticsResource::collection($users),
            'totals' => $totals,
            'services' => $services,
        ]);
    }
}
