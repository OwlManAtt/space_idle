<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Resources extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('short_code', 30)->unique();
            $table->string('name');
            $table->string('icon');
            $table->string('description');
            $table->integer('base_harvest_interval');
            $table->integer('base_harvest_amount');
            $table->boolean('basic');
        });

        Schema::create('resources', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('resource_type_id')->unsigned();
            $table->dateTime('last_harvested_at');
            $table->dateTime('penultimate_harvested_at');
            $table->integer('quantity')->unsigned();

            $table->unique(['user_id', 'resource_type_id']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('resource_type_id')->references('id')->on('resource_types');
        });

        Artisan::call('db:seed', [
            '--class' => 'ResourceTypeSeeder',
            '--force' => true 
        ]);
    } // end up

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resources');
        Schema::dropIfExists('resource_types');
    } // end down
}
