<?php

namespace Database\Seeders;

use App\Models\Airport;
use Illuminate\Database\Seeder;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Airport::create([
            "code" => "YUL",
            "city_code" => "YMQ",
            "name" => "Pierre Elliott Trudeau International",
            "city" => "Montreal",
            "country_code" => "CA",
            "region_code" => "QC",
            "latitude" => "45.457714",
            "longitude" => "-73.749908",
            "timezone" => "America/Montreal"
        ]);
        Airport::create([
            "code" => "YVR",
            "city_code" => "YVR",
            "name" => "Vancouver International",
            "city" => "Vancouver",
            "country_code" => "CA",
            "region_code" => "BC",
            "latitude" => "49.194698",
            "longitude" => "-123.179192",
            "timezone" => "America/Vancouver"
        ]);
        Airport::create([
            "code" => "YYZ",
            "city_code" => "YYZ",
            "name" => "Toronto Pearson International",
            "city" => "Toronto",
            "country_code" => "CA",
            "region_code" => "ON",
            "latitude" => "43.6777176000001",
            "longitude" => "-79.624819699999",
            "timezone" => "America/Torontor"
        ]);
        Airport::create([
            "code" => "YWG",
            "city_code" => "YWG",
            "name" => "Winnipeg International Airport",
            "city" => "Winnipeg",
            "country_code" => "CA",
            "region_code" => "ON",
            "latitude" => "49.904",
            "longitude" => "-97.2259",
            "timezone" => "America/Torontor"
        ]);
        Airport::create([
            "code" => "YOW",
            "city_code" => "YOW",
            "name" => "Ottawa McDonald-Cartier International Airport",
            "city" => "Ottawa",
            "country_code" => "CA",
            "region_code" => "ON",
            "latitude" => "45.3225",
            "longitude" => "-75.669167",
            "timezone" => "America/Toronto"
        ]);
        Airport::create([
            "code" => "YYC",
            "city_code" => "YYC",
            "name" => "Calgary International Airport",
            "city" => "Calgary",
            "country_code" => "CA",
            "region_code" => "AB",
            "latitude" => "51.113888",
            "longitude" => "-114.020278",
            "timezone" => "America/Edmonton"
        ]);
        Airport::create([
            "code" => "YEG",
            "city_code" => "YEA",
            "name" => "Edmonton International Airport",
            "city" => "Edmonton",
            "country_code" => "CA",
            "region_code" => "AB",
            "latitude" => "53.309723",
            "longitude" => "-113.579722",
            "timezone" => "America/Edmonton"
        ]);
        Airport::create([
            "code" => "YHZ",
            "city_code" => "YHZ",
            "name" => "Halifax International",
            "city" => "Halifax",
            "country_code" => "CA",
            "region_code" => "NS",
            "latitude" => "44.880833",
            "longitude" => "-63.50861",
            "timezone" => "America/Halifax"
        ]);
        Airport::create([
            "code" => "YYJ",
            "city_code" => "YYJ",
            "name" => "Victoria International Airport",
            "city" => "Victoria",
            "country_code" => "CA",
            "region_code" => "BC",
            "latitude" => "48.646944",
            "longitude" => "-123.425833",
            "timezone" => "America/Vancouver"
        ]);
        Airport::create([
            "code" => "YQB",
            "city_code" => "YQB",
            "name" => "Quebec City Jean Lesage International Airport",
            "city" => "Québec",
            "country_code" => "CA",
            "region_code" => "QC",
            "latitude" => "46.791111",
            "longitude" => "-71.393333",
            "timezone" => "America/Toronto"
        ]);

    }
}
