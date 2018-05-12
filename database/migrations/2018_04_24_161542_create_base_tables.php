<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaseTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories');
            $table->timestamps();
        });

        Schema::create('cityhall', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('user_id');
          $table->foreign('user_id')
                ->references('id')
                ->on('users');
          $table->string('phone1');
          $table->string('phone2');
          $table->string('address');
          $table->string('address_number');
          $table->string('address_postalcode');
          $table->string('address_complement')->nullable();
          $table->string('proof_document');
          $table->string('city');
          $table->string('state');
        });

        Schema::create('cityhallservice', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cityhall_id');
            $table->foreign('cityhall_id')
                  ->references('id')
                  ->on('cityhall');
            $table->unsignedInteger('service_id');
            $table->foreign('service_id')
                  ->references('id')
                  ->on('services');
        });

        Schema::create('citizens', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
            $table->string('cpf');
            $table->string('name');
            $table->string('cellphone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('services');
        Schema::dropIfExists('cityhallservice');
        Schema::dropIfExists('citizens');
    }
}
