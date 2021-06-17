<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller
{

    public function home(){
        // code 2

        return view('pages.home');
    }

    public function flat(){
        // code 2

        return view('pages.flat');
    }
}
