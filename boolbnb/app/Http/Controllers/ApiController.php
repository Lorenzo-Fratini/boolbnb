<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Apartment;
use App\Service;


class ApiController extends Controller {
    
    public function getApartments($searchString) {

        $getApartments = Apartment::where('address', 'LIKE', '%' . $searchString . '%')->get();

        $apartments = [];

        foreach ($getApartments as $apartment) {
           
            foreach ($apartment -> sponsorships as $apartRel) {

                $endDate = $apartRel -> pivot -> end_date;

                date_default_timezone_set('Europe/Rome');
                $currentDate = date('m/d/Y H:i:s', time());
                $endDateFormat = date('m/d/Y H:i:s', strtotime($endDate));
                
                if ($currentDate < $endDateFormat) {

                    !in_array($apartment, $apartments) ? $apartments [] = $apartment : '';
                }
            }
        }
        
        foreach ($getApartments as $apartment) {
            
            !in_array($apartment, $apartments) ? $apartments [] = $apartment : '';
        }

        return response() -> json($apartments, 200);
    }

    public function getServices() {

        $services = Service::all();

        return response() -> json($services, 200);
    }

    public function filterApartments(Request $request) {

        $allApartments = json_decode($request -> allApartments);
        $currentApartments = json_decode($request -> currentApartments);
        $filterServices = json_decode($request -> filterServices);

        if (!($request -> filterServices)) {

            return response() -> json($allApartments, 200);
        }

        $filteredApartments = Apartment::whereHas('services', function($query) use($filterServices)
        {
            $query -> whereIn('service_id', $filterServices);
        }, "=", count($filterServices))->get();

        return response() -> json($filteredApartmets, 200);
    }
}
