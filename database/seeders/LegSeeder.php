<?php

namespace Database\Seeders;

use App\Models\Airline;
use App\Models\Airport;
use App\Models\Leg;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class LegSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(100, 500) as $number) {
            $airports = Airport::inRandomOrder()->get();
            Leg::create([
                'airline' => Airline::inRandomOrder()->first()->code,
                'number' => $number,
                'departure_airport' => $airports->first()->code,
                'departure_time' => $departureTime = $faker->time('H:i'),
                'arrival_airport' => $airports->last()->code,
                'arrival_time' => Carbon::parseFromLocale($departureTime)->addHours($faker->numberBetween(1,7)),
                'price' => $faker->numberBetween(799, 1099),
            ]);
        }
    }
}
