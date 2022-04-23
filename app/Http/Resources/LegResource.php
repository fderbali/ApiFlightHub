<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class LegResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "airline" => $this->airline,
            "airline_name" => $this->airlineCompany->name,
            "flight_number" => $this->number,
            "departure" => [
                "airport" => $this->departure_airport,
                "time" => Carbon::parse($this->departure_time)->format('H:i'),
                "airport_name"=>$this->departureAirport->name
            ],
            "arrival" => [
                "airport"=>$this->arrival_airport,
                "time"=>Carbon::parse($this->arrival_time)->format('H:i'),
                "airport_name"=>$this->arrivalAirport->name
            ]
        ];
    }
}
