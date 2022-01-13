<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('course_id')->unsigned();
            $table->bigInteger('season_id')->unsigned();
            $table->bigInteger('media_id')->unsigned()->nullable();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->tinyInteger('time');
            $table->boolean('free');
            $table->integer('number');
            $table->longText('desc')->nullable();


            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade');
            $table->foreign('media_id')->references('id')->on('media')->onDelete('set null');
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
        Schema::dropIfExists('lessons');
    }
}
