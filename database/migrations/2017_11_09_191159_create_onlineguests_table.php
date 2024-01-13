<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnlineguestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_guests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('guest');
            $table->string('email');
            $table->string('userimage')->nullable();
            $table->integer('is_main');
            $table->string('pin');
            $table->string('sha');
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
        Schema::dropIfExists('onlineguests');
    }
}
