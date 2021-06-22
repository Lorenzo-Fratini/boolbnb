<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Apartment;
use App\Service;


class ApiController extends Controller {
    
    public function getApartments($searchString) {

        $sponsoredApartments = Apartment::where('address', 'LIKE', '%' . $searchString . '%')->get();

        $apartments = [];

        foreach ($sponsoredApartments as $apartment) {
           
            foreach ($apartment -> sponsorships  as $apartRel) {

                $endDate = $apartRel -> pivot -> end_date;

                date_default_timezone_set('Europe/Rome');
                $currentDate = date('m/d/Y H:i:s', time());
                $endDateFormat = date('m/d/Y H:i:s', strtotime($endDate));
                
                if ($currentDate < $endDateFormat) {

                    !in_array($apartment, $apartments) ? $apartments [] = $apartment : '';
                }
            }
        }

        $otherApartments = Apartment::where('address', 'LIKE', '%' . $searchString . '%')->get();

        foreach ($otherApartments as $otherApartment) {
            
            !in_array($otherApartment, $apartments) ? $apartments [] = $otherApartment : '';
        }

        return response() -> json($apartments, 200);
    }

    public function getServices() {

        $services = Service::all();

        return response() -> json($services, 200);
    }
}
