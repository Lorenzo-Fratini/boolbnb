<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Apartment;

class LoggedController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        
        $this->middleware('auth');
    }

    public function dashboard($id){

        $userInfo = Auth::findOrFail($id);
        $apartments = Apartment::where($user_id = $id);
        // dd($apartments);

        return view('pages.dashboard', compact('userInfo', 'apartments'));
    }

    public function editApartment($id){

        $apartment = Apartment::findOrFail($id);

        return view('pages.apartment-edit', compact('apartment'));

    }
}
