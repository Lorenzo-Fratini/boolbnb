<?php

use Illuminate\Database\Seeder;

use App\Statistic;

class StatisticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Statistic::class, 50) -> create();
    }
}
