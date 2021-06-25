<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Apartment;
use App\Message;
use App\Service;
use App\Statistic;


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

    public function filterBedsRooms($searchString, $bedsRooms) {

        $apartments = Apartment::where('city', 'LIKE', '%' . $searchString . '%') -> get();

        $filter = explode(',', $bedsRooms);
        $filter2 = [];
        
        foreach ($filter as $data) {
            
            $filter2 [] = intval($data);
        }

        $beds = $filter2[0];
        $rooms = $filter2[1];
        $filteredApartments = [];

        foreach ($apartments as $apartment) {

            if ($apartment -> beds_number >= $beds && $apartment -> rooms_number >= $rooms) {

                $filteredApartments []= $apartment;
            }
        }
        
        return response() -> json($filteredApartments, 200);
    }

    public function getStatistics($id){

        $apartment = Apartment::findOrFail($id);
        $statistics = Statistic::where('apartment_id', 'LIKE', $id) -> get();
            
        $ordered_stats = array();
            
        foreach ($statistics as $statistic) {
                
            $formattedDate = date("n-Y", strtotime($statistic -> date));
            $statDate = explode("-", $formattedDate);
            list($month, $year) = $statDate;
            
            $ordered_stats[$year][$month][]= $statistic;
        };
        
        return response() -> json($ordered_stats, 200);
    }

    public function getMessages($id) {

        $apartment = Apartment::findOrFail($id);
        $messages = Message::where('apartment_id', 'LIKE', $id) -> get();

        $ordered_messages = array();
            
        foreach ($messages as $message) {
                
            $formattedDate = date("n-Y", strtotime($message -> created_at));
            $messageDate = explode("-", $formattedDate);
            list($month, $year) = $messageDate;
            
            $ordered_messages[$year][$month][]= $message;
        };

        return response() -> json($ordered_messages, 200);
    }
}


