<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Apartment;
use App\Message;
use App\Service;
use App\Sponsorship;

class GuestController extends Controller
{
    public function index(){    

        $allApartments = Apartment::all();

        $apartments = [];

        foreach ($allApartments as $apartment) {
           
            foreach ($apartment -> sponsorships  as $apartRel) {

                $endDate = $apartRel -> pivot -> end_date;

                date_default_timezone_set('Europe/Rome');
                $currentDate = date('m/d/Y H:i:s', time());
                $endDateFormat = date('m/d/Y H:i:s', strtotime($endDate));

                /* dd($currentDate, $endDate); */
                
                if ($currentDate < $endDateFormat) {

                    !in_array($apartment, $apartments) ? $apartments [] = $apartment : '';
                }
            }
        }

        return view('pages.home', compact('apartments'));
    }

    public function search(Request $request) {

        $validation = $request -> validate([
            'searchString' => 'required|string'
        ]);

        $apartments = Apartment::where('city', 'LIKE', '%' . $validation['searchString'] . '%')->get();
        $services = Service::all();

        return view('pages.apartmentSearch', compact('apartments', 'services'));
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
