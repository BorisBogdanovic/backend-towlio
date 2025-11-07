<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $list = [
            ['name' => 'Package Serbia', 'price' => 60],
            ['name' => 'Package Europe', 'price' => 100],
            ['name' => 'Package Super', 'price' => 120],
            ['name' => 'Package City', 'price' => 40],
        ];

        foreach ($list as $a) {
            Service::create([  
                'name' => $a['name'],  
                'price' => $a['price']
            ]);
        }
    }
}
