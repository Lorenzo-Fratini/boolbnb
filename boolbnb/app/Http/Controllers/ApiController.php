<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Apartment;
use App\Service;


class ApiController extends Controller {
    
    public function search(Request $request) {

        $validation = $request -> validate([
            'searchString' => 'required|string'
        ]);

        $apartments = Apartment::where('address', 'LIKE', '%' . $validation['searchString'] . '%')->get();
        $services = Service::all();

        return response() -> json([$apartments, $services], 200);

        // return view('pages.apartmentSearch', compact('apartments', 'services'));
    }
}
