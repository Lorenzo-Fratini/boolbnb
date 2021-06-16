<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'date_start',
        'date_end',
        'apartment_id',
        'sponsorship_id'
    ];

    public function apartment(){

        return $this -> belongsTo(Apartment::class);
    }

    public function sponsorship(){

        return $this -> belongsTo(Sponsorship::class);
    }
}
