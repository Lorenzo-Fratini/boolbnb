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

    public function orders(){

        return $this -> hasMany(Order::class);
    }
}
