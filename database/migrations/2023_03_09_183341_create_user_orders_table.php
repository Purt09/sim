<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('operator_id');
            $table->unsignedBigInteger('country_id');
            $table->integer('price');
            $table->integer('status');
            $table->timestamps();

            $table->foreign('user_id', 'user_orders_user_id')->references('id')->on('users');
            $table->foreign('operator_id', 'user_orders_operator_id_key')->references('id')->on('operators');
            $table->foreign('country_id', 'user_orders_country_key')->references('id')->on('countries');

            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_orders');
    }
}
