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

    public function filterApartments($searchString, $filterServices, $bedsRooms) {

        $apartments = Apartment::where('city', 'LIKE', '%' . $searchString . '%') -> get();

        if ($filterServices != 'noServices') {

            $filterServices = explode(',', $filterServices);
            
            $services = [];
            
            foreach ($filterServices as $data) {
                
                $services [] = intval($data);
            }
            
            $apartments = Apartment::whereHas('services', function($query) use($services)
            {
                $query -> whereIn('service_id', $services);
            }, "=", count($services))
            ->where('city', 'LIKE', '%' . $searchString . '%')
            ->get();
    
            $newApartments = [];
    
            foreach ($apartments as $apartment) {
                
                foreach ($apartment -> sponsorships as $apartRel) {
    
                    $endDate = $apartRel -> pivot -> end_date;
    
                    date_default_timezone_set('Europe/Rome');
                    $currentDate = date('m/d/Y H:i:s', time());
                    $endDateFormat = date('m/d/Y H:i:s', strtotime($endDate));
                    
                    if ($currentDate < $endDateFormat) {
    
                        !in_array($apartment, $newApartments) ? $newApartments [] = $apartment : '';
                    }
                }
            }
            
            foreach ($apartments as $apartment) {
                
                !in_array($apartment, $newApartments) ? $newApartments [] = $apartment : '';
            }

            $apartments = $newApartments;
        }

        $filterBedsRooms = explode(',', $bedsRooms);
        $bedsRooms = [];
        
        foreach ($filterBedsRooms as $data) {
            
            $bedsRooms [] = intval($data);
        }

        $beds = $bedsRooms[0];
        $rooms = $bedsRooms[1];
        $filteredApartments = [];

        foreach ($apartments as $apartment) {

            if ($apartment -> beds_number >= $beds && $apartment -> rooms_number >= $rooms) {

                $filteredApartments []= $apartment;
            }
        }

        return response() -> json($filteredApartments, 200);
        
    }

    public function getViews($ip, $id) {

        $statistics = Statistic::all();

        foreach ($statistics as $statistic) {
            
            if ($statistic -> ip == $ip && $statistic -> apartment_id == $id) {
                
                return;
            }
        }

        $apartment = Apartment::findOrFail($id);

        $newStatistic = [
            'ip' => $ip
        ];

        $statistic = Statistic::make($newStatistic);
        $statistic -> apartment() -> associate($apartment);
        $statistic -> save();
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


