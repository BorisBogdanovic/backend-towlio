<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CarBrand;

class CarBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            'Audi', 'BMW', 'Mercedes-Benz', 'Volkswagen', 'Opel', 'Ford', 'Renault', 'Peugeot', 'Citroën', 'Toyota',
            'Nissan', 'Honda', 'Mazda', 'Mitsubishi', 'Suzuki', 'Hyundai', 'Kia', 'Chevrolet', 'Fiat', 'Alfa Romeo',
            'Jeep', 'Dodge', 'Chrysler', 'Volvo', 'Saab', 'Skoda', 'Seat', 'Lancia', 'Jaguar', 'Land Rover',
            'Porsche', 'Ferrari', 'Lamborghini', 'Maserati', 'Bentley', 'Rolls-Royce', 'Aston Martin', 'Mini', 'Smart', 'Tesla',
            'Subaru', 'Infiniti', 'Lexus', 'Acura', 'Buick', 'Cadillac', 'GMC', 'Lincoln', 'Hummer', 'Pontiac',
            'Daewoo', 'Dacia', 'SsangYong', 'Great Wall', 'Geely', 'BYD', 'Chery', 'MG', 'Rover', 'Tata',
            'Mahindra', 'Proton', 'Perodua', 'Holden', 'Isuzu', 'Scion', 'Genesis', 'RAM', 'Pagani', 'Bugatti',
            'Koenigsegg', 'McLaren', 'Maybach', 'Oldsmobile', 'Saturn', 'Eagle', 'Talbot', 'Simca', 'Austin', 'Triumph',
            'Vauxhall', 'Zastava', 'Yugo', 'Lada', 'GAZ', 'UAZ', 'Moskvitch', 'Fisker', 'Lucid', 'Rivian',
            'Polestar', 'Cupra', 'BYTON', 'NIO', 'XPeng', 'Lucid Motors', 'Ariel', 'Caterham', 'TVR', 'Lotus'
        ];

        foreach ($brands as $brand) {
            CarBrand::create(['name' => $brand]);
        }
    }
}
