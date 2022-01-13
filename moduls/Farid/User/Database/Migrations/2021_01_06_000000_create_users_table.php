<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('image_id')->unsigned()->nullable();
            $table->integer('balance')->default(0);
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile')->unique()->nullable();
            $table->string('username',20)->nullable();
            $table->string('ip')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('headline')->nullable();
            $table->string('bio')->nullable();
            $table->string('password');
            $table->enum('status',['active','inactive','banned'])->default('inactive');
            $table->rememberToken();

            $table->foreign('image_id')->references('id')->on('media')->onDelete('set null');
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
        Schema::dropIfExists('users');
    }
}
