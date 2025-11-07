<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Boris',
            'last_name' => 'Bogdanovic',
            'email' => 'bbogdanovic167@gmail.com',  
            'password' => Hash::make('B0li$ta2025!'),  
            'phone' => '+381631234567',  
            'status_id' => 1, 
            'city_id'=> 1
        ])->assignRole('admin');
    }
}
