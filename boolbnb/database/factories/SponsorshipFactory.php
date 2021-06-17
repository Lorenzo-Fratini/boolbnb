<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Sponsorship;
use Faker\Generator as Faker;

$autoIncrement = autoIncrement();
$factory->define(Sponsorship::class, function (Faker $faker) use ($autoIncrement) {

    $sponsorships = [
        [
            'price' => 2.99,
            'duration' => 24
        ],
        [
            'price' => 5.99,
            'duration' => 72
        ],
        [
            'price' => 9.99,
            'duration' => 144
        ]
    ];

    $autoIncrement->next();
    $index= $autoIncrement->current();

    $sponsorship = $sponsorships[$index];

    return [
        'price' => $sponsorship['price'],
        'duration' => $sponsorship['duration']
    ];
});

function autoIncrement() {
    for ($i = -1; $i < 3; $i++) {
         yield $i;
     }
 } 
