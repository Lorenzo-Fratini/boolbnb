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

        

        factory(Sponsorship::class, 3) -> create()
            -> each(function($sponsorship) {

            $startDates = [
                '2021-01-03',
                '2021-01-11',
                '2021-02-24',
                '2021-02-28',
                '2021-03-14',
                '2021-04-11',
                '2021-04-12',
                '2021-04-30',
                '2021-05-01',
                '2021-06-10'
            ];

            $startDate = $startDates[rand(0, 9)];

            if ($sponsorship -> id == 1) {

                $endDate = date("Y-m-d H:i:s", strtotime('+24 hours', strtotime($startDate)));
            } else if ($sponsorship -> id == 2) {

                $endDate = date("Y-m-d H:i:s", strtotime('+48 hours', strtotime($startDate)));
            } else {

                $endDate = date("Y-m-d H:i:s", strtotime('+144 hours', strtotime($startDate)));
            }
                

            $apartment = Apartment::inRandomOrder() 
                        -> limit(rand(2, 5))
                        -> get();
            $sponsorship -> apartments() -> attach($apartment, ['start_date' => $startDate, 'end_date' => $endDate]); 
            $sponsorship -> save();
        });
    }
}
