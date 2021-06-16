<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [

        'url',
        'extension',
        'is_cover',
        'apartment_id',
    ];

    public function apartment(){

        return $this -> belongsTo(Apartment::class);
    }
}
