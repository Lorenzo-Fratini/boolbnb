<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Apartment;
use Faker\Generator as Faker;

$factory->define(Apartment::class, function (Faker $faker) {

    $cities = [
        'Roma',
        'Milano',
        'Torino',
        'Venezia',
        'Firenze',
        'Napoli',
        'Genova',
        'Palermo',
        'Bari',
        'Bologna'
    ];

    $apartmentTypes = [
        'Casa',
        'Appartamento',
        'Caseggiato',
        'Villa',
        'Podere',
        'Casale',
        'Baita',
        'Bungalow',
        'Rifugio',
        'Pied-à-terre',
        'Monolocale',
        'Cottage'
    ];

    $streetTypes = [
        'Via',
        'Viale',
        'Vicolo',
        'Pazza',
        'Piazzale'
    ];

    return [
        'title' =>  $apartmentTypes[rand(0, 11)] . ' ' . $faker -> unique() -> firstname,
        'description' => $faker -> text,
        'cover_image' => 'es' . rand(1, 9) . '.jpg',
        'rooms_number' => rand(1, 5),
        'beds_number' => rand(1, 5),
        'bathrooms_number' => rand(1, 5),
        'area' => rand(70, 300),
        'address' => $streetTypes[rand(0, 4)] . ' ' . $faker -> lastname . ' ' . rand(1, 500),
        'city' => $cities[rand(0, 9)], 
        'country' => 'it',
        'postal_code' => rand(10000, 99999),
    ];
});
