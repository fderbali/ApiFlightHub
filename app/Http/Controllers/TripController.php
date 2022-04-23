<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripRequest;
use App\Http\Resources\LegResource;
use App\Models\Leg;

class TripController extends Controller
{
    public function buildTrips(TripRequest $request){
        $results = [];
        if(count($request->cityPairs) == 1){
            // One way
            $itineraries = $this->getItineraries($request->cityPairs[0]);
            foreach ($itineraries as $itinerary){
                $result = [
                    "itinerary" => [new LegResource($itinerary)],
                    "searchtype" => "OW",
                    "price" => sprintf("%.2f",$itinerary->price)
                ];
                $results[] = $result;
            }
        }
        else
        {
            foreach ($request->cityPairs as $cityPair){
                $itinerary = $this->getItinerary($cityPair);
            }
        }
        return response()->json($results);
    }

    private function getItineraries($cityPair){
        $legs = Leg::where([
            ["departure_airport","=",$cityPair["airport_dep"]],
            ["arrival_airport","=",$cityPair["airport_arr"]]
        ])->get();
        return($legs);
    }

    private function calculatePrice($itinerary){
        print_r($itinerary);exit;
    }
}
