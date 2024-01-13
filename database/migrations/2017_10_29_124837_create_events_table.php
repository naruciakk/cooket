<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('color');
            $table->string('slug');
            $table->text('description');
            $table->integer('organization');
            $table->integer('db');
            $table->string('image');
            $table->string('website');
            $table->string('contact');
            $table->datetime('start');
            $table->datetime('finish');
            $table->string('city');
            $table->string('address');
            $table->integer('accomodation');
            $table->integer('prepaid');
            $table->text('ticket')->nullable();
            $table->integer('userimage')->default(0);
            $table->integer('code_length')->default(6);
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
        Schema::dropIfExists('events');
    }
}
