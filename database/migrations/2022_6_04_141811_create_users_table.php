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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // $table->bigIncrements('id');

            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->default(null);
            $table->string('password')->nullable();
            $table->datetime('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            // $table->rememberToken();
            // $table->timestamp('email_verified_at')->nullable();
            $table->text('created_by')->nullable();
            $table->text('deleted_by')->nullable();
            $table->text('updated_by')->nullable();
            $table->softDeletes();
            $table->bigInteger('city_id')->unsigned()->nullable(); 
            $table->foreign('city_id')->references('id')->on('city')->onDelete('cascade');
            $table->timestamps();
            // $table->bigInteger('team_id')->unsigned(); 
            // $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};