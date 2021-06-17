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
                'm2' => '150',
                'address' => 'Via Nazionale 1',
                /* 'latitude' => '',
                'longitude' => '', */
                'user_id' => '1'
            ],
            [
                'title' => 'Villa Nest',
                'rooms_number' => '6',
                'beds_number' => '4',
                'bathrooms_number' => '3',
                'm2' => '210',
                'address' => 'Via del Corso 12',
                /* 'latitude' => '',
                'longitude' => '', */
                'user_id' => '2'
            ],
            [
                'title' => 'Prima Luce',
                'rooms_number' => '2',
                'beds_number' => '1',
                'bathrooms_number' => '1',
                'm2' => '90',
                'address' => 'Piazza Garibaldi 8',
                /* 'latitude' => '',
                'longitude' => '', */
                'user_id' => '3'
            ],
            [
                'title' => 'il Podere del Lago',
                'rooms_number' => '5',
                'beds_number' => '5',
                'bathrooms_number' => '3',
                'm2' => '170',
                'address' => 'Viale Mazzini 18',
                /* 'latitude' => '',
                'longitude' => '', */
                'user_id' => '4'
            ],
            [
                'title' => 'La Contea',
                'rooms_number' => '2',
                'beds_number' => '3',
                'bathrooms_number' => '1',
                'm2' => '110',
                'address' => 'Vicolo Stretto 91',
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
