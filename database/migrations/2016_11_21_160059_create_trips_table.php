<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('inizio');
            $table->string('fine');
            $table->string('durata');
            $table->string('co2');
            $table->string('percorso');
            $table->string('puntiAttribuiti');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('vehicle_id')->unsigned()->nullable();
            $table->integer('ztl_id')->unsigned()->nullable();
            $table->timestamps();


        });

        Schema::table('trips', function ( $table) {

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('set null');
            $table->foreign('vehicle_id')
                ->references('id')->on('vehicles')
                ->onDelete('set null');
            $table->foreign('ztl_id')
                ->references('id')->on('ztls')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('trips');
    }
}