<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip', function (Blueprint $table) {
            $table->id();
            $table->text('route_name');
            $table->text('work_code');
            $table->text('Km_start');
            $table->text('km_end');
            $table->text('total_distance');
            $table->datetime('Date_of_trip')->nullable();
            $table->datetime('time_out')->nullable();
            $table->datetime('time_in')->nullable();
            $table->datetime('total_time')->nullable();
           
            $table->bigInteger('city_id')->unsigned(); 
            $table->foreign('city_id')->references('id')->on('city')->onDelete('cascade');
            $table->bigInteger('car_id')->unsigned(); 
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
            $table->bigInteger('driver_id')->unsigned(); 
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');
            $table->bigInteger('co_driver_id')->unsigned(); 
            $table->foreign('co_driver_id')->references('id')->on('co_driver')->onDelete('cascade');
            $table->bigInteger('company_id')->unsigned(); 
            $table->foreign('company_id')->references('id')->on('company')->onDelete('cascade');

            $table->bigInteger('user_id')->unsigned(); 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('created_by')->nullable();
            $table->text('deleted_by')->nullable();
            $table->text('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trip', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });    }
};