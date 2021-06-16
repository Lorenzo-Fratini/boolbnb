<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    protected $fillable = [

        'price',
        'duration',
        'apartment_id',
    ];

    public function apartments(){

        return $this -> hasMany(Apartment::class);
    }
}
