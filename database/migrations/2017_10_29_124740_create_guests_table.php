<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event');
            $table->integer('user');
            $table->string('sign')->nullable();
            $table->string('role')->nullable();
            $table->integer('accomodation')->default(0);
            $table->integer('adult');
            $table->integer('ticket');
            $table->integer('code');
            $table->text('annotation')->nullable();
            $table->text('sign_annotation')->nullable();
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
        Schema::dropIfExists('guests');
    }
}
