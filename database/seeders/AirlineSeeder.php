<?php

namespace Database\Seeders;

use App\Models\Airline;
use Illuminate\Database\Seeder;

class AirlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Airline::create([
            'code' => 'AC',
            'name' => 'Air Canada',
        ]);
        Airline::create([
            'code' => 'WS',
            'name' => 'WestJet',
        ]);
        Airline::create([
            'code' => 'TS',
            'name' => 'Air Transat',
        ]);
        Airline::create([
            'code' => 'AF',
            'name' => 'Air France',
        ]);
        Airline::create([
            'code' => 'AA',
            'name' => 'American Airlines',
        ]);
        Airline::create([
            'code' => 'DL',
            'name' => 'Delta Airlines',
        ]);
        Airline::create([
            'code' => 'UA',
            'name' => 'United Airlines',
        ]);
        Airline::create([
            'code' => 'BA',
            'name' => 'British Airways',
        ]);
        Airline::create([
            'code' => 'KL',
            'name' => 'KLM',
        ]);
    }
}
