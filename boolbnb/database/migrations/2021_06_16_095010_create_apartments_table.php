<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table -> id();

            $table -> string('title');
            $table -> integer('rooms_number');
            $table -> integer('beds_number');
            $table -> integer('bathrooms_number');
            $table -> integer('m2');
            $table -> string('address');
            $table -> float('latitude');
            $table -> float('longitude');
            $table -> date('sponsorships_date');

            $table -> bigInteger('user_id') -> unsigned() -> index();

            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartments');
    }
}
