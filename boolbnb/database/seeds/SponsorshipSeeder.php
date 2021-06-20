<?php

use Illuminate\Database\Seeder;

use App\Apartment;
use App\Sponsorship;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(Sponsorship::class, 3) -> create();
        /*     -> each(function($sponsorship) {

            $startDates = [
                '2021-01-03',
                date("Y-m-d H:i:s", time())
            ];

            $startDate = $startDates[rand(0, 1)];

            if ($sponsorship -> id == 1) {

                $endDate = date("Y-m-d H:i:s", strtotime('+24 hours', strtotime($startDate)));
            } else if ($sponsorship -> id == 2) {

                $endDate = date("Y-m-d H:i:s", strtotime('+48 hours', strtotime($startDate)));
            } else {

                $endDate = date("Y-m-d H:i:s", strtotime('+144 hours', strtotime($startDate)));
            }
                
            $apartment = Apartment::inRandomOrder() -> first();
            $sponsorship -> apartments() -> attach($apartment, ['start_date' => $startDate, 'end_date' => $endDate]); 
            $sponsorship -> save();
        });*/
    }
}
