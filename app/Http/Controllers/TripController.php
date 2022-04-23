<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripRequest;
use App\Http\Resources\LegResource;
use App\Models\Leg;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class TripController extends Controller
{
    private $request;

    /**
     * @param TripRequest $request
     */
    public function __construct(TripRequest $request){
        $this->request = $request;
    }

    /**
     * build trips according to search data
     * @return JsonResponse
     */
    public function buildTrips(): JsonResponse
    {
        $request = $this->request;
        $results = [];
        switch (count($request->cityPairs)){
            case 1:
                // One way
                $itineraries = $this->getItineraries($request->cityPairs[0]);
                foreach ($itineraries as $itinerary){
                    $result = [
                        "itinerary" => [new LegResource($itinerary)],
                        "trip_type" => "OW",
                        "price" => sprintf("%.2f",$itinerary->price),
                        "date_dep" => $request->cityPairs[0]["date_dep"]
                    ];
                    $results[] = $result;
                }
                break;
            case 2:
                // Return or openjaw flight
                if($request->cityPairs[0]['airport_dep'] == $request->cityPairs[1]['airport_arr'] &&
                   $request->cityPairs[0]['airport_arr'] == $request->cityPairs[1]['airport_dep']
                ){
                    $trip_type = "RE";
                } else {
                    $trip_type = "OJ";
                }
                $outboundItineraries = $this->getItineraries($request->cityPairs[0]);
                $inboundItineraries = $this->getItineraries($request->cityPairs[1]);
                foreach ($outboundItineraries as $outboundItinerary) {
                    foreach ($inboundItineraries as $inboundItinerary) {
                        if($this->isCompatible($outboundItinerary, $inboundItinerary)){
                            $result = [
                                "itinerary" => [new LegResource($outboundItinerary), new LegResource($inboundItinerary)],
                                "trip_type" => $trip_type,
                                "price" => sprintf("%.2f",$outboundItinerary->price + $inboundItinerary->price),
                                "date_dep" => $request->cityPairs[0]["date_dep"],
                                "date_ret" => $request->cityPairs[1]["date_dep"]
                            ];
                            $results[] = $result;
                        }
                    }
                }
                break;
            case 3:
                $boundOne = $this->getItineraries($request->cityPairs[0]);
                $boundTwo = $this->getItineraries($request->cityPairs[1]);
                $boundThree = $this->getItineraries($request->cityPairs[2]);
                foreach ($boundOne as $boundOneItin) {
                    foreach ($boundTwo as $boundTwoItin) {
                        if($this->isCompatible($boundOneItin, $boundTwoItin)){
                            foreach ($boundThree as $boundThreeItin) {
                                if($this->isCompatible($boundTwoItin, $boundThreeItin)) {
                                    $result = [
                                        "itinerary" => [new LegResource($boundOneItin), new LegResource($boundTwoItin), new LegResource($boundThreeItin)],
                                        "trip_type" => "MC",
                                        "price" => sprintf("%.2f", $boundOneItin->price + $boundTwoItin->price + $boundThreeItin->price),
                                        "date_dep_first_leg" => $request->cityPairs[0]["date_dep"],
                                        "date_dep_second_leg" => $request->cityPairs[1]["date_dep"],
                                        "date_dep_third_leg" => $request->cityPairs[2]["date_dep"]
                                    ];
                                    $results[] = $result;
                                }
                            }
                        }
                    }
                }
                break;
            case 4:
                $trip_type = "MC";
                $boundOne = $this->getItineraries($request->cityPairs[0]);
                $boundTwo = $this->getItineraries($request->cityPairs[1]);
                $boundThree = $this->getItineraries($request->cityPairs[2]);
                $boundFour = $this->getItineraries($request->cityPairs[3]);
                foreach ($boundOne as $boundOneItin) {
                    foreach ($boundTwo as $boundTwoItin) {
                        if($this->isCompatible($boundOneItin, $boundTwoItin)){
                            foreach ($boundThree as $boundThreeItin) {
                                if($this->isCompatible($boundTwoItin, $boundThreeItin)) {
                                    foreach ($boundFour as $boundFourItin) {
                                        if($this->isCompatible($boundThreeItin,$boundFourItin)) {
                                            $result = [
                                                "itinerary" => [
                                                    new LegResource($boundOneItin),
                                                    new LegResource($boundTwoItin),
                                                    new LegResource($boundThreeItin),
                                                    new LegResource($boundFourItin)
                                                ],
                                                "trip_type" => "MC",
                                                "price" => sprintf("%.2f", $boundOneItin->price + $boundTwoItin->price + $boundThreeItin->price + $boundFourItin->price),
                                                "date_dep_first_leg" => $request->cityPairs[0]["date_dep"],
                                                "date_dep_second_leg" => $request->cityPairs[1]["date_dep"],
                                                "date_dep_third_leg" => $request->cityPairs[2]["date_dep"],
                                                "date_dep_fourth_leg" => $request->cityPairs[3]["date_dep"]
                                            ];
                                            $results[] = $result;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                break;
        }

        return response()->json(
            $this->paginate($results,$request->perPage, $request->page)
        );
    }

    /**
     * fetch flights according to search data
     * @param $cityPair
     * @return Collection
     */
    private function getItineraries($cityPair): Collection
    {
        return Leg::where([
            ["departure_airport","=",$cityPair["airport_dep"]],
            ["arrival_airport","=",$cityPair["airport_arr"]]
        ])->get();
    }

    /**
     * check if two itineraries are compatible,
     * for example if departure time of $itineraryTwo is before arrival time of itinerary one,
     * then these itineraries are not compatible
     * @param $itineraryOne
     * @param $itineraryTwo
     * @return boolean
     */
    private function isCompatible($itineraryOne, $itineraryTwo): bool
    {
        if($itineraryTwo->departure_time < $itineraryOne->arrival_time){
            return false;
        }
        return true;
    }


    /**
     * Paginate results
     * @param $items
     * @param int $perPage
     * @param $page
     * @param array $options
     * @return LengthAwarePaginator
     */
    private function paginate($items, int $perPage = 10, $page = null, array $options = []): LengthAwarePaginator
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
