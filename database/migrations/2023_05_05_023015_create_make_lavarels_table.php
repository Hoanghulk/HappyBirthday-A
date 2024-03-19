<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMakeLavarelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('make_lavarels', function (Blueprint $table) {
            $table->id();
            $table->string('background', 255)->nullable();
            $table->mediumText('image')->nullable();
            $table->string('button', 255)->nullable();
            $table->string('button_link', 255)->nullable();
            $table->mediumText('content')->nullable();
            $table->mediumText('status')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->tinyInteger('order')->default(0);
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
        Schema::dropIfExists('make_lavarels');
    }
}
