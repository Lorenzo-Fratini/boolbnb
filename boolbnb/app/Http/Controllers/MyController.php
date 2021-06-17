<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;

class MyController extends Controller
{

    public function home(){
        // code 2

        //apartment's data call
        $apartments = Apartment::all();

        // dd($apartments);

        return view('pages.home', compact('apartments'));
    }
}
