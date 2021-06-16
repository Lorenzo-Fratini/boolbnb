<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [

        'carholder_name',
        'card_number',
        'expiration',
        'cvv',
        'user_id',
    ];

    public function user(){

        return $this -> belongsTo(User::class);
    }
}
