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

            $table -> string('title', 256);
            $table -> string('rooms_number', 5);
            $table -> string('beds_number', 5);
            $table -> string('bathrooms_number', 5);
            $table -> string('m2', 10);
            $table -> string('address', 256);
            $table -> string('city');
            $table -> string('country');
            $table -> string('postal_code', 5);
            $table -> float('latitude') -> nullable();
            $table -> float('longitude') -> nullable();

            $table -> bigInteger('user_id') -> unsigned() -> index();
            $table -> bigInteger('sponsorship_id') -> unsigned() -> index();

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
