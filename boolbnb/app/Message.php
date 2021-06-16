<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [

        'sender',
        'title', 
        'text',
        'date',
        'apartment_id',
    ];

    public function apartment(){

        return $this -> belongsTo(Apartment::class);
    }
}
