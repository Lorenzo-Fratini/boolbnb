<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Service;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker){

    $services = [
        'WiFi',
        'Posto Macchina',
        'Piscina',
        'Portineria',
        'Sauna',
        'Cucina',
        'Riscaldamento',
        'Aria Condizionata',
        'Colazione',
        'TV'
    ];

    $index= $faker -> unique() -> numberBetween(0, 9);

    $service = $services[$index];

    return [
        'name' => $service,
    ];
});
