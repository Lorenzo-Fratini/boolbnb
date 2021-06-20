<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Apartment;
use App\User;
use App\Service;

class LoggedController extends Controller {
    
    public function __construct() {
        
        $this->middleware('auth');
    }

    public function dashboard($id) {

        $user = User::findOrFail($id);
        $apartments = Apartment::where('user_id', 'LIKE', $id) -> orderBy('city') -> get();

        return view('pages.dashboard', compact('user', 'apartments'));
    }
    
    public function createApartment($id) {

        $user = User::findOrFail($id);
        $services = Service::all();

        return view('pages.apartmentCreate', compact('user', 'services'));
    }
    public function storeApartment(Request $request) {

        $validation = $request -> validate([
            'title' => 'required|string|max:256',
            'cover_image' => 'required|string|',
            'rooms_number' => 'required|integer',
            'beds_number' => 'required|integer',
            'bathrooms_number' => 'required|integer',
            'area' => 'required|integer',
            'address' => 'required|string|min:1',
            'city' => 'required|string|min:1',
            'country' => 'required|string|min:1',
            'postal_code' => 'required|integer|min:5|max:5',
            'user_id' => 'required|exists:App\User,id|integer',
            'service_id.*' => 'required_if:current,1|distinct|exists:App\Service,id|integer'       
        ]);

        $user = User::findOrFail($request -> get('user_id'));

        $apartment = Apartment::make($validation);
        $apartment -> user() -> associate($user);
        $apartment -> save();

        $apartment -> services() -> attach($request -> get('service_id'));
        $apartment -> save();

        return redirect() -> route('dashboard', ['id' => $user -> id]);
    }

    public function editApartment($id) {

        $apartment = Apartment::findOrFail($id);
        $user = User::findOrFail($apartment -> user_id);
        $services = Service::all();

        return view('pages.apartmentEdit', compact('apartment', 'user', 'services'));
    }
    public function updateApartment(Request $request, $id) {

        $validation = $request -> validate([
            'title' => 'required|string|max:256',
            'cover_image' => 'required|string',
            'rooms_number' => 'required|integer',
            'beds_number' => 'required|integer',
            'bathrooms_number' => 'required|integer',
            'area' => 'required|integer',
            'address' => 'required|string|min:1',
            'city' => 'required|string|min:1',
            'country' => 'required|string|min:1',
            'postal_code' => 'required|integer|min:5|max:5',
            'user_id' => 'required|exists:App\User,id|integer',
            'service_id.*' => 'required_if:current,1|distinct|exists:App\Service,id|integer'       
        ]);

        $user = User::findOrFail($request -> get('user_id'));

        $apartment = Apartment::findOrFail($id);
        $apartment -> update($validation);

        $apartment -> user() -> associate($user);
        $apartment -> save();

        $apartment -> services() -> sync($request -> get('service_id'));

        return redirect() -> route('dashboard', ['id' => $user -> id]);
    }

    public function destroyApartment($id) {

        $apartment = Apartment::findOrFail($id);
        $userId = $apartment -> user_id;
        $apartment -> delete();
        $apartment -> save();

        return redirect() -> route('dashboard', ['id' => $userId]);
    }
}
