<?php

use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $startDate = [
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

        for ($i = 0; $i < 10; $i++) {

            $randApartment = rand(1, 5);
            $randSponsorship = rand(1, 3);

            if ($randSponsorship == 1) {

                $endDate = date("Y-m-d H:i:s", strtotime('+24 hours', strtotime($startDate[$i])));
            } else if ($randSponsorship == 2) {

                $endDate = date("Y-m-d H:i:s", strtotime('+48 hours', strtotime($startDate[$i])));
            } else {

                $endDate = date("Y-m-d H:i:s", strtotime('+144 hours', strtotime($startDate[$i])));
            }
    
            DB::table('orders')->insert([
                'date_start' => $startDate[$i],
                'date_end' => $endDate,
                'apartment_id' => $randApartment,
                'sponsorship_id' => $randSponsorship
            ]);
        }
        
    }
}
