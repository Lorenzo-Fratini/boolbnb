<?php

use Illuminate\Database\Seeder;

use App\Apartment;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        
        $apartments = [
            [
                'title' => 'Caseggiato Millefoglie',
                'rooms_number' => '4',
                'beds_number' => '3',
                'bathrooms_number' => '2',
                'area' => '150',
                'address' => 'Via Nazionale 1',
                'city' => 'Roma', 
                'country' => 'it',
                'postal_code' => '00127',
                /* 'latitude' => '',
                'longitude' => '', */
                'user_id' => '1'
            ],
            [
                'title' => 'Villa Nest',
                'rooms_number' => '6',
                'beds_number' => '4',
                'bathrooms_number' => '3',
                'area' => '210',
                'address' => 'Via del Corso 12',
                'city' => 'Roma', 
                'country' => 'it',
                'postal_code' => '00127',
                /* 'latitude' => '',
                'longitude' => '', */
                'user_id' => '2'
            ],
            [
                'title' => 'Prima Luce',
                'rooms_number' => '2',
                'beds_number' => '1',
                'bathrooms_number' => '1',
                'area' => '90',
                'address' => 'Piazza Garibaldi 8',
                'city' => 'Roma', 
                'country' => 'it',
                'postal_code' => '00127',
                /* 'latitude' => '',
                'longitude' => '', */
                'user_id' => '3'
            ],
            [
                'title' => 'il Podere del Lago',
                'rooms_number' => '5',
                'beds_number' => '5',
                'bathrooms_number' => '3',
                'area' => '170',
                'address' => 'Viale Mazzini 18',
                'city' => 'Roma', 
                'country' => 'it',
                'postal_code' => '00127',
                /* 'latitude' => '',
                'longitude' => '', */
                'user_id' => '4'
            ],
            [
                'title' => 'La Contea',
                'rooms_number' => '2',
                'beds_number' => '3',
                'bathrooms_number' => '1',
                'area' => '110',
                'address' => 'Via del Corso, 125',
                'city' => 'Roma', 
                'country' => 'it',
                'postal_code' => '00127',
                /* 'latitude' => '',
                'longitude' => '', */
                'user_id' => '5'
            ],
        ];

        foreach ($apartments as $key => $apartment) {
            
            Apartment::create($apartment);
        }
    }
}
