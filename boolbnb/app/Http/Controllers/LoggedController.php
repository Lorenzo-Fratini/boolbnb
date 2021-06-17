<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;

class LoggedController extends Controller
{
    public function editApartment($id){

        $apartment = Apartment::findOrFail($id);

        return view('pages.apartment-edit', compact('apartment'));

    }
}
