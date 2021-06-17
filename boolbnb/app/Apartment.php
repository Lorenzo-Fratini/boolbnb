<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [

        'title',
        'cover_image',
        'rooms_number',
        'beds_number',
        'bathrooms_number',
        'area',
        'address',
        'city',
        'country',
        'postal_code',
        'latitude',
        'longitude',
        'sponsor_date',
        'user_id',
        'visible'
    ];

    public function images(){

        return $this -> hasMany(Image::class);
    }

    public function statistics(){

        return $this -> hasMany(Statistic::class);
    }

    public function user(){

        return $this -> belongsTo(User::class);
    }

    public function services(){

        return $this -> belongsToMany(Service::class);
    }

    public function messages(){

        return $this -> hasMany(Message::class);
    }

    public function sponsorships(){

        return $this -> belongsToMany(Sponsorship::class);
    }
}
