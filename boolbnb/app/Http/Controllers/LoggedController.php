<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Apartment;
use App\User;

class LoggedController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard($id){

        $userInfo = User::findOrFail($id);
        $apartments = Apartment::where($user_id = $id);

        return view('pages.dashboard', compact('userInfo', 'apartments'));
    }
    
    public function createApartment(){

        return view('pages.apartment-create');
    }

    public function storeApartment(Request $request){

        $validation = $request -> validate([
            
            'title' => 'required|string|min:8|max:256',
            'cover_image' => 'required|string|',
            'rooms_number' => 'required|integer',
            'beds_number' => 'required|integer',
            'bathrooms_number' => 'required|integer',
            'area' => 'required|integer',
            'address' => 'required|string|min:1',
            'city' => 'required|string|min:1',
            'country' => 'required|string|min:1',
            'postal_code' => 'required|integer|min:5|max:5',           
        ]);

        $apartment = Apartment::create($validation);

        return redirect() -> route('dashboard');
    }

    public function editApartment($id){

        $apartment = Apartment::findOrFail($id);

        return view('pages.apartment-edit', compact('apartment'));
    }

    public function updateApartment(Request $request, $id){

        $validation = $request -> validate([
            
            'title' => 'required|string|min:8|max:256',
            'cover_image' => 'required|string',
            'rooms_number' => 'required|integer',
            'beds_number' => 'required|integer',
            'bathrooms_number' => 'required|integer',
            'area' => 'required|integer',
            'address' => 'required|string|min:1',
            'city' => 'required|string|min:1',
            'country' => 'required|string|min:1',
            'postal_code' => 'required|integer|min:5|max:5',           
        ]);

        $apartment = Apartment::findOrFail($id);
        $apartment -> update($validation);

        return redirect() -> route('dashboard');
    }

    public function destroyApartment($id){

        $apartment = Apartment::findOrFail($id);
        $apartment -> delete();
        $apartment -> save();

        return redirect() -> route('dashboard');
    }
}
