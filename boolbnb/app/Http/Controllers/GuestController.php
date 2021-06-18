<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Apartment;
use App\Message;

class GuestController extends Controller
{
    public function index(){      

        $apartments = Apartment::all();

        return view('pages.home', compact('apartments'));
    }

    public function search(Request $request){

        $valid = $request -> validate([
            'search' => 'required|string'
        ]);

        $apartments = Apartment::where('city', 'LIKE', '%{$valid}%');
        $services = Service::all();

        return view('pages.results', compact('apartments', 'services'));
    }

    public function showApartment($id){

        $apartment = Apartment::findOrFail($id);

        return view('pages.apartmentShow', compact('apartment'));
    }
    public function storeMessage(Request $request) {

        $validation = $request -> validate([
            'email' => 'required|string|max:128',
            'text' => 'required|string|min:20|max:255',
            'apartment_id' => 'required|exists:App\Apartment,id|integer'
        ]);

        $apartment = Apartment::findOrFail($request -> apartment_id);

        $message = Message::make($validation);
        $message -> apartment() -> associate($apartment);
        $message -> save();

        return redirect() -> route('index');
    }

    /* public function message($id){

        $apartment = Apartment::findOrFail($id);

        return view('pages.message', compact('apartment'));
    } */
}
