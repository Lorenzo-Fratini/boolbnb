<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Apartment;
use App\Message;

class GuestController extends Controller
{
    public function index(){      

        $apartments = Apartment::all(); //temp //where sponsor not null?
        // $proApartments = Apartment::all(); //temp //where sponsor not null?

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

        return view('pages.apartment', compact('apartment'));
    }

    public function message($id){

        $apartment = Apartment::findOrFail($id);

        return view('pages.message', compact('apartment'));
    }

    public function storeMessage(Request $request){

        dd($request);
        $valid = $request -> validate([
            'email' => 'required|string|max:128',
            'text' => 'required|string|min:20|max:255',
            'date' => 'required|date'
        ]);

        $apartment = Apartment::findOrFail($request -> get('apartment_id'));
        $message = Message::make($valid);
        $message -> apartment() -> associate($apartment);
        $message -> save();

        return redirect() -> route('index');
    }
}
