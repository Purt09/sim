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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('title_ru')->nullable(false);
            $table->string('title_eng')->nullable(false);
            $table->string('image')->nullable(true);
            $table->timestamps();

            $table->index('name');
        });

        Schema::create('operators', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->unsignedBigInteger('country_id');
            $table->timestamps();

            $table->foreign('country_id', 'operator_country_key')->references('id')->on('countries');

            $table->index('name');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('tg_id')->unique();
            $table->unsignedBigInteger('operator_id');
            $table->unsignedBigInteger('country_id');
            $table->string('language', 3)->default('ru')->nullable(false);
            $table->timestamps();

            $table->foreign('operator_id', 'user_operator_id_key')->references('id')->on('operators');
            $table->foreign('country_id', 'user_country_key')->references('id')->on('countries');

            $table->index('tg_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
        Schema::dropIfExists('operators');
        Schema::dropIfExists('users');
    }
}
