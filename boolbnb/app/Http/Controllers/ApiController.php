<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Apartment;
use App\Service;


class ApiController extends Controller {
    
    public function getApartments($searchString) {

        $getApartments = Apartment::where('city', 'LIKE', '%' . $searchString . '%')->get();

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

    public function filterApartments($searchString, $filterServices) {


        /* $getApartments = Apartment::where('address', 'LIKE', '%' . $searchString . '%')->get();

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
        } */

        $filter = explode(',', $filterServices);
        
        $filter2 = [];
        
        foreach ($filter as $data) {
            
            $filter2 [] = intval($data);
        }
        
        $filteredApartments = Apartment::whereHas('services', function($query) use($filter2)
        {
            $query -> whereIn('service_id', $filter2);
        }, "=", count($filter2))
        ->where('city', 'LIKE', '%' . $searchString . '%')
        /* -> join('apartment_service', 'apartments.id', '=', 'apartment_service.apartment_id')
        -> join('services', 'apartment_service.service_id', '=', 'services.id') */
        ->get();

        /* $selectedApartments = [];

        foreach ($filteredApartments as $selectedApartment) {
            
            !in_array($selectedApartment, $selectedApartments) ? $selectedApartments [] = $selectedApartment : '';
        }
        */
        $apartments = [];

        foreach ($filteredApartments as $apartment) {
            
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
        
        foreach ($filteredApartments as $apartment) {
            
            !in_array($apartment, $apartments) ? $apartments [] = $apartment : '';
        }

        return response() -> json($apartments, 200);
        
    }
}
