<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leg extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function departureAirport()
    {
        return $this->belongsTo(Airport::class, 'departure_airport');
    }

    public function arrivalAirport()
    {
        return $this->belongsTo(Airport::class, 'arrival_airport');
    }

    public function airline()
    {
        return $this->belongsTo(Airline::class, 'airline');
    }

}
