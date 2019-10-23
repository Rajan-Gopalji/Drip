<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('caption');
            $table->string('gender');
            $table->string('category');
            $table->string('size');
            $table->string('quality');
            $table->text('description');
            $table->string('colour');
            $table->double('price');
            $table->string('image');
            $table->timestamps();

            $table->index('user_id');
        });

        Schema::multiImage('multi_image', function (Blueprint $table) {
            $table->unsignedBigInteger(post_id);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
