<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::table('apartments', function (Blueprint $table) {

            $table -> foreign('user_id', 'apartment-user')
                   -> references('id')
                   -> on('users');
        });

        Schema::table('payments', function (Blueprint $table) {

            $table -> foreign('user_id', 'payment-user')
                   -> references('id')
                   -> on('users');
        });

        Schema::table('orders', function (Blueprint $table) {

            $table -> foreign('apartment_id', 'orders-apartment')
                   -> references('id')
                   -> on('apartments');
            $table -> foreign('sponsorship_id', 'orders-sponsorship')
                   -> references('id')
                   -> on('sponsorships');
        });

        Schema::table('statistics', function (Blueprint $table) {

            $table -> foreign('apartment_id', 'statistic-apartment')
                   -> references('id')
                   -> on('apartments');
        });

        Schema::table('images', function (Blueprint $table) {

            $table -> foreign('apartment_id', 'image-apartment')
                   -> references('id')
                   -> on('apartments');
        });

        Schema::table('messages', function (Blueprint $table) {

            $table -> foreign('apartment_id', 'message-apartment')
                   -> references('id')
                   -> on('apartments');
        });

        Schema::table('apartment_service', function (Blueprint $table) {

            $table -> foreign('apartment_id', 'apartment-service')
                   -> references('id')
                   -> on('apartments');
            $table -> foreign('service_id', 'service-apartment')
                   -> references('id')
                   -> on('services');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        
        Schema::table('apartments', function (Blueprint $table) {

            $table -> dropForeign('apartment-user');
        });

        Schema::table('payments', function (Blueprint $table) {

            $table -> dropForeign('payment-user');
        });

        Schema::table('statistics', function (Blueprint $table) {

            $table -> dropForeign('statistic-apartment');
        });

        Schema::table('images', function (Blueprint $table) {

            $table -> dropForeign('image-apartment');
        });

        Schema::table('messages', function (Blueprint $table) {

            $table -> dropForeign('message-apartment');
        });

        Schema::table('apartment_service', function (Blueprint $table) {

            $table -> dropForeign('apartment-service');
            $table -> dropForeign('service-apartment');
        });
    }
}
