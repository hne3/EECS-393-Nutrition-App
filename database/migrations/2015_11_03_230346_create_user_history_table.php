<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_history', function (Blueprint $table) {
            $table->integer('users_email')
            $table->foreign('users_email')->references('email')->on('users');
            $table->timestamp('date')->default(DB:raw('CURRENT_TIMESTAMP'));
            $table->string('food_name')
            $table->foreign('food_name')->references('name')->on('foods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
