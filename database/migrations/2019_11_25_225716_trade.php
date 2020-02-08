<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Trade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id_tradee');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('post_id_tradee');
            $table->unsignedBigInteger('post_id_trader');
            $table->string('accepts');
            $table->timestamps();

            $table->index('user_id_tradee');
            $table->index('user_id');
            $table->index('post_id_tradee');
            $table->index('post_id_trader');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trades');
    }
}
