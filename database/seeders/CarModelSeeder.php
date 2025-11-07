<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CarBrand;
use App\Models\CarModel;

class CarModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $models = [
            'Audi' => [
                'A1', 'A3', 'A4', 'A5', 'A6', 'A7', 'A8',
                'Q2', 'Q3', 'Q5', 'Q7', 'Q8',
                'TT', 'R8', 'e-tron', 'RS3', 'RS4', 'RS5', 'RS6', 'RS7'
            ],

            'BMW' => [
                '1 Series', '2 Series', '3 Series', '4 Series', '5 Series', '7 Series', '8 Series',
                'X1', 'X2', 'X3', 'X4', 'X5', 'X6', 'X7',
                'i3', 'i4', 'i7', 'iX', 'M2', 'M3', 'M4', 'M5', 'Z4'
            ],

            'Mercedes-Benz' => [
                'A-Class', 'B-Class', 'C-Class', 'E-Class', 'S-Class',
                'CLA', 'CLS', 'GLA', 'GLB', 'GLC', 'GLE', 'GLS', 'G-Class',
                'EQC', 'EQA', 'EQB', 'EQE', 'EQS', 'AMG GT'
            ],

            'Volkswagen' => [
                'Up!', 'Polo', 'Golf', 'Passat', 'Arteon', 'Touran', 'Tiguan', 'Touareg',
                'T-Roc', 'Taigo', 'ID.3', 'ID.4', 'ID.5', 'ID.7', 'Caddy', 'Transporter', 'Caravelle'
            ],

            'Opel' => [
                'Adam', 'Corsa', 'Astra', 'Insignia', 'Mokka', 'Crossland', 'Grandland',
                'Combo', 'Zafira', 'Vivaro'
            ],

            'Ford' => [
                'Ka', 'Fiesta', 'Focus', 'Mondeo', 'Fusion', 'Kuga', 'Puma', 'Edge',
                'Explorer', 'Mustang', 'Ranger', 'Transit', 'Tourneo', 'Bronco'
            ],

            'Renault' => [
                'Twingo', 'Clio', 'Captur', 'Megane', 'Kadjar', 'Austral', 'Arkana',
                'Scenic', 'Espace', 'Talisman', 'Kangoo', 'Trafic', 'Master'
            ],

            'Peugeot' => [
  
                "104", "106", "107", "108",
                "204", "205", "206", "206+", "206 CC", "206 SW",
                "207", "207 CC", "207 SW",
                "208", "208 GT", "208 GTi",
                "1007",

                
                "304", "305", "306", "306 Cabriolet", "306 Break",
                "307", "307 CC", "307 SW",
                "308", "308 SW", "308 CC", "308 GT", "308 GTi",
                "309",
                "310", 

                
                "405", "406", "406 Coupe",
                "407", "407 Coupe", "407 SW",
                "408", "408 Fastback",
                "504", "505", "508", "508 SW", "508 PSE",
                "604", "605", "607",
                "301", "302", "303",

                
                "2008", "2008 GT",
                "3008", "3008 Hybrid", "3008 GT",
                "4007", "4008",
                "5008", "5008 GT",
                "Traveller", "Rifter", "Landtrek",
                "e-2008", "e-3008", "e-5008",

                
                "RCZ", "RCZ R",
                "Peugeot Sport Engineered (PSE)",
                "Oxia", "Onyx", "Exalt", "Fractal", "Instinct",

                
                "Partner", "Partner Tepee",
                "Bipper", "Bipper Tepee",
                "Expert", "Expert Tepee",
                "Boxer", "Boxer Combi",
                "J5", "J7", "J9",
                "P4", "Pick Up", "Hoggar",

                
                "201", "202", "203", "301", "302", "304", "305",
                "401", "402", "403", "404", "504", "505", "604",
                "Type 1", "Type 2", "Type 3", "Type 69", "Type 125",

                
                "e-208", "e-308", "e-408", "e-Partner", "e-Expert", "e-Boxer",
                "Inception Concept", "E-Legend Concept"
                ],

            'Citroën' => [
                'C1', 'C3', 'C3 Aircross', 'C4', 'C4 Cactus', 'C4 X', 'C5 Aircross',
                'Berlingo', 'Spacetourer'
            ],

            'Toyota' => [
                'Aygo X', 'Yaris', 'Yaris Cross', 'Corolla', 'Camry', 'C-HR',
                'RAV4', 'Highlander', 'Land Cruiser', 'Hilux', 'Supra', 'Prius', 'GR86'
            ],
            'Nissan' => [
                'Micra', 'Note', 'Almera', 'Juke', 'Qashqai', 'X-Trail',
                'Murano', 'Pathfinder', 'Navara', 'Ariya', 'Leaf', 'GT-R', 'Z'
            ],

            'Honda' => [
                'Jazz', 'Civic', 'Accord', 'HR-V', 'CR-V', 'ZR-V',
                'e:NY1', 'Insight', 'Legend', 'Prelude', 'NSX', 'Type R'
            ],

            'Mazda' => [
                'Mazda2', 'Mazda3', 'Mazda6', 'CX-3', 'CX-30', 'CX-5',
                'CX-60', 'CX-9', 'MX-5', 'BT-50'
            ],

            'Mitsubishi' => [
                'Space Star', 'Colt', 'ASX', 'Eclipse Cross', 'Outlander',
                'Pajero', 'Pajero Sport', 'L200', 'i-MiEV'
            ],

            'Suzuki' => [
                'Alto', 'Swift', 'Baleno', 'Ignis', 'SX4', 'Vitara',
                'S-Cross', 'Jimny', 'Across', 'Swace'
            ],

            'Hyundai' => [
                'i10', 'i20', 'i30', 'i40', 'Bayon', 'Kona', 'Tucson',
                'Santa Fe', 'Ioniq', 'Ioniq 5', 'Ioniq 6', 'Nexo', 'Venue'
            ],

            'Kia' => [
                'Picanto', 'Rio', 'Ceed', 'Proceed', 'Stonic', 'XCeed',
                'Niro', 'Sportage', 'Sorento', 'EV6', 'EV9', 'Stinger', 'Carens'
            ],

            'Chevrolet' => [
                'Spark', 'Aveo', 'Cruze', 'Malibu', 'Impala', 'Camaro',
                'Corvette', 'Trax', 'Equinox', 'Blazer', 'Traverse',
                'Tahoe', 'Suburban', 'Silverado'
            ],

            'Fiat' => [
                '500', '500X', '500L', 'Panda', 'Tipo', 'Doblo',
                'Fiorino', 'Bravo', 'Punto', 'Multipla', 'Sedici'
            ],

            'Alfa Romeo' => [
                'Giulietta', 'Giulia', 'Stelvio', 'Tonale', '4C', '8C', 'Mito', 'Spider'
            ],

            'Jeep' => [
                'Renegade', 'Compass', 'Patriot', 'Cherokee', 'Grand Cherokee',
                'Wrangler', 'Gladiator', 'Commander', 'Avenger'
            ],

            'Dodge' => [
                'Neon', 'Dart', 'Charger', 'Challenger', 'Durango',
                'Journey', 'Ram 1500', 'Viper'
            ],

            'Chrysler' => [
                '200', '300', 'Pacifica', 'Voyager', 'Aspen', 'Sebring'
            ],

            'Volvo' => [
                'C40', 'S60', 'S90', 'V40', 'V60', 'V90',
                'XC40', 'XC60', 'XC90', 'EX30', 'EX90'
            ],

            'Saab' => [
                '9-3', '9-5', '900', '9000', '9-4X', '9-7X'
            ],

            'Skoda' => [
                'Citigo', 'Fabia', 'Scala', 'Octavia', 'Superb',
                'Kamiq', 'Karoq', 'Kodiaq', 'Enyaq'
            ],

            'Seat' => [
                'Mii', 'Ibiza', 'Leon', 'Toledo', 'Arona',
                'Ateca', 'Tarraco', 'Alhambra'
            ],

            'Lancia' => [
                'Ypsilon', 'Delta', 'Thema', 'Phedra', 'Lybra', 'Musa'
            ],

            'Jaguar' => [
                'XE', 'XF', 'XJ', 'E-Pace', 'F-Pace', 'I-Pace', 'F-Type'
            ],

            'Land Rover' => [
                'Defender', 'Discovery', 'Discovery Sport',
                'Range Rover', 'Range Rover Sport', 'Range Rover Evoque', 'Velar'
            ],

            'Porsche' => [
                '911', '718 Cayman', '718 Boxster', 'Panamera',
                'Macan', 'Cayenne', 'Taycan'
            ],

            'Ferrari' => [
                'Roma', 'Portofino', '296 GTB', 'F8 Tributo',
                'SF90 Stradale', '812 Superfast', 'Daytona SP3', 'Purosangue'
            ],

            'Lamborghini' => [
                'Huracán', 'Aventador', 'Revuelto', 'Urus', 'Sián', 'Gallardo'
            ],

            'Maserati' => [
                'Ghibli', 'Quattroporte', 'Levante', 'Grecale', 'MC20', 'GranTurismo'
            ],

            'Bentley' => [
                'Continental GT', 'Flying Spur', 'Bentayga', 'Mulsanne'
            ],

            'Rolls-Royce' => [
                'Ghost', 'Wraith', 'Phantom', 'Cullinan', 'Spectre', 'Dawn'
            ],

            'Aston Martin' => [
                'Vantage', 'DB11', 'DB12', 'DBS Superleggera', 'Rapide', 'DBX', 'Valhalla'
            ],

            'Mini' => [
                '3-Door', '5-Door', 'Clubman', 'Countryman', 'Convertible', 'Electric'
            ],

            'Smart' => [
                'EQ ForTwo', 'EQ ForFour', 'Hashtag1 (#1)', 'Hashtag3 (#3)'
            ],
            'Subaru' => [
                'Impreza', 'Legacy', 'Levorg', 'Outback', 'Forester',
                'Crosstrek', 'XV', 'BRZ', 'Ascent', 'Solterra'
            ],

            'Infiniti' => [
                'Q30', 'Q50', 'Q60', 'Q70', 'QX30', 'QX50', 'QX55', 'QX60', 'QX80'
            ],

            'Lexus' => [
                'CT', 'IS', 'ES', 'GS', 'LS',
                'UX', 'NX', 'RX', 'GX', 'LX', 'RC', 'LC'
            ],

            'Acura' => [
                'ILX', 'TLX', 'RLX', 'RDX', 'MDX', 'ZDX', 'Integra', 'NSX'
            ],

            'Buick' => [
                'Encore', 'Encore GX', 'Envision', 'Enclave', 'Verano', 'Regal'
            ],

            'Cadillac' => [
                'CT4', 'CT5', 'CT6', 'XT4', 'XT5', 'XT6',
                'Escalade', 'Lyriq', 'Celestiq'
            ],

            'GMC' => [
                'Terrain', 'Acadia', 'Yukon', 'Canyon', 'Sierra 1500',
                'Sierra 2500HD', 'Hummer EV', 'Envoy'
            ],

            'Lincoln' => [
                'Corsair', 'Nautilus', 'Aviator', 'Navigator', 'Continental', 'MKZ'
            ],

            'Hummer' => [
                'H1', 'H2', 'H3', 'EV Pickup', 'EV SUV'
            ],

            'Pontiac' => [
                'G3', 'G5', 'G6', 'G8', 'Solstice', 'Firebird', 'Grand Prix', 'Torrent'
            ],
            'Daewoo' => [
                'Matiz', 'Lanos', 'Nubira', 'Leganza', 'Kalos', 'Lacetti', 'Tacuma', 'Evanda'
            ],

            'Dacia' => [
                'Spring', 'Sandero', 'Logan', 'Jogger', 'Duster', 'Lodgy', 'Dokker'
            ],

            'SsangYong' => [
                'Tivoli', 'Korando', 'Rexton', 'Rodius', 'Musso', 'Torres'
            ],

            'Great Wall' => [
                'Hover H3', 'Hover H5', 'Steed 5', 'Steed 6', 'Poer', 'Tank 300', 'Cannon'
            ],

            'Geely' => [
                'Coolray', 'Emgrand', 'Emgrand X7', 'Tugella', 'Monjaro', 'Atlas', 'Binrui'
            ],

            'BYD' => [
                'Dolphin', 'Seal', 'Atto 3', 'Tang', 'Han', 'Song Plus', 'Yuan Plus', 'Destroyer 05'
            ],

            'Chery' => [
                'Tiggo 2', 'Tiggo 4', 'Tiggo 7', 'Tiggo 8', 'Arrizo 5', 'Arrizo 6', 'Omoda 5'
            ],

            'MG' => [
                'MG3', 'MG4', 'MG5', 'MG6', 'ZS', 'HS', 'Marvel R', 'EHS'
            ],

            'Rover' => [
                '25', '45', '75', '200', '400', '600', '800', 'Streetwise'
            ],

            'Tata' => [
                'Nano', 'Tiago', 'Tigor', 'Altroz', 'Punch', 'Nexon', 'Harrier', 'Safari'
            ],

            'Mahindra' => [
                'KUV100', 'XUV300', 'XUV500', 'XUV700', 'Scorpio', 'Bolero', 'Thar', 'Marazzo'
            ],

            'Proton' => [
                'Saga', 'Persona', 'Iriz', 'Exora', 'X50', 'X70', 'X90', 'Preve'
            ],

            'Perodua' => [
                'Axia', 'Bezza', 'Myvi', 'Ativa', 'Alza', 'Aruz', 'Kancil'
            ],

            'Holden' => [
                'Commodore', 'Cruze', 'Astra', 'Barina', 'Captiva', 'Colorado', 'Trax', 'Monaro', 'Ute'
            ],

            'Isuzu' => [
                'D-Max', 'MU-X', 'Trooper', 'Rodeo', 'Wizard', 'VehiCROSS', 'Axiom', 'Panther'
            ],

            'Scion' => [
                'iA', 'iM', 'iQ', 'tC', 'xA', 'xB', 'xD', 'FR-S'
            ],

            'Genesis' => [
                'G70', 'G80', 'G90', 'GV60', 'GV70', 'GV80', 'GV90'
            ],

            'RAM' => [
                '1500', '2500', '3500', 'ProMaster City', 'ProMaster Van', 'Rebel', 'TRX'
            ],

            'Pagani' => [
                'Zonda', 'Huayra', 'Utopia'
            ],

            'Bugatti' => [
                'Veyron', 'Chiron', 'Divo', 'Centodieci', 'Bolide', 'Mistral'
            ],

            'Koenigsegg' => [
                'CC8S', 'CCR', 'CCX', 'CCXR', 'Agera', 'Agera RS', 'Jesko', 'Gemera', 'Regera'
            ],

            'McLaren' => [
                '540C', '570S', '600LT', '620R', '650S', '675LT',
                '720S', '750S', '765LT', 'Artura', 'GT', 'Speedtail', 'Elva', 'P1'
            ],

            'Maybach' => [
                '57', '62', 'S580', 'S680', 'GLS600', 'Pullman'
            ],

            'Oldsmobile' => [
                'Alero', 'Aurora', 'Bravada', 'Cutlass', 'Intrigue', 'Silhouette', 'Achieva', 'Eighty-Eight'
            ],

            'Saturn' => [
                'Ion', 'Vue', 'Outlook', 'Sky', 'Aura', 'Relay', 'L-Series', 'S-Series'
            ],

            'Eagle' => [
                'Talon', 'Summit', 'Vision', 'Premier', 'Medallion'
            ],

            'Talbot' => [
                'Samba', 'Horizon', 'Solara', 'Tagora', '1510'
            ],

            'Simca' => [
                '1000', '1100', '1301', '1501', 'Aronde', 'Vedette'
            ],

            'Austin' => [
                'Mini', 'Allegro', 'Maestro', 'Montego', 'Cambridge', 'Princess', 'Maxi'
            ],

            'Triumph' => [
                'Spitfire', 'TR6', 'TR7', 'TR8', 'Stag', 'Herald', 'Dolomite'
            ],
            'Vauxhall' => [
                'Adam', 'Corsa', 'Astra', 'Insignia', 'Mokka', 'Crossland', 'Grandland',
                'Combo', 'Vivaro', 'Zafira', 'Meriva'
            ],

            'Zastava' => [
                '750', '101', '128', 'Skala', 'Florida', 'Yugo 45', 'Yugo 55', 'Tempo'
            ],

            'Yugo' => [
                '45', '55', 'Tempo', 'Florida', 'Cabrio'
            ],

            'Lada' => [
                'Niva', 'Granta', 'Vesta', 'XRAY', 'Kalina', 'Priora', 'Samara'
            ],

            'GAZ' => [
                'Volga', 'Gazelle', 'Sobol', 'Sadko', 'Next'
            ],

            'UAZ' => [
                '469', 'Hunter', 'Patriot', 'Pickup', 'Profi'
            ],

            'Moskvitch' => [
                '400', '408', '412', '2140', '2141 Aleko', '3', '6'
            ],

            'Fisker' => [
                'Karma', 'Ocean', 'Pear', 'Ronin', 'Alaska'
            ],

            'Lucid' => [
                'Air', 'Gravity'
            ],

            'Rivian' => [
                'R1T', 'R1S', 'EDV 500', 'EDV 700'
            ],

            'Polestar' => [
                '1', '2', '3', '4', '5', '6'
            ],

            'Cupra' => [
                'Born', 'Leon', 'Ateca', 'Formentor', 'Tavascan'
            ],

            'BYTON' => [
                'M-Byte', 'K-Byte'
            ],

            'NIO' => [
                'ET5', 'ET7', 'EL6', 'EL7', 'EC6', 'EC7', 'ES6', 'ES8'
            ],

            'XPeng' => [
                'P5', 'P7', 'P7i', 'G3', 'G6', 'G9'
            ],

            'Lucid Motors' => [
                'Air', 'Gravity'
            ],

            'Ariel' => [
                'Atom', 'Nomad', 'Hipercar'
            ],

            'Caterham' => [
                'Seven 170', 'Seven 360', 'Seven 420', 'Seven 620'
            ],

            'TVR' => [
                'Griffith', 'Sagaris', 'Tuscan', 'Cerbera', 'Chimaera'
            ],

            'Lotus' => [
                'Elise', 'Exige', 'Evora', 'Emira', 'Eletre', 'Evija'
            ],





        ];


        foreach ($models as $brandName => $brandModels) {
            $brand = CarBrand::where('name', $brandName)->first();

            if ($brand) {
                foreach ($brandModels as $model) {
                    CarModel::create([
                        'car_brand_id' => $brand->id,
                        'name' => $model,
                    ]);
                }
            }
        }


    }
}
