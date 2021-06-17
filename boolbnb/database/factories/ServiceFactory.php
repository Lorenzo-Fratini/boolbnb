<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Service;
use Faker\Generator as Faker;

$autoIncrement = autoIncrement();
$factory->define(Service::class, function (Faker $faker) use ($autoIncrement){

    $services = [
        'WiFi',
        'Posto Macchina',
        'Piscina',
        'Portineria',
        'Sauna',
        'Cucina',
        'Riscaldamento',
        'Aria Cpndizionata',
        'Colazione',
        'TV'
    ];

    $autoIncrement->next();
    $index= $autoIncrement->current();

    $service = $services[$index];

    return [
        'name' => $service,
    ];
});

function autoIncrement() {
    for ($i = -1; $i < 10; $i++) {
        yield $i;
    }
}
