<?php

use Illuminate\Database\Seeder;

use App\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $services = [
            [
                'name' => 'WiFi'
            ],
            [
                'name' => 'Posto Macchina'
            ],
            [
                'name' => 'Piscina'
            ],
            [
                'name' => 'Portineria'
            ],
            [
                'name' => 'Sauna'
            ],
            [
                'name' => 'Cucina'
            ],
            [
                'name' => 'Riscaldamento'
            ],
            [
                'name' => 'Aria Cpndizionata'
            ],
            [
                'name' => 'Colazione'
            ],
            [
                'name' => 'TV'
            ],
        ];

        foreach ($services as $key => $service) {
            
            Service::create($service);
            
        }
    }
}
