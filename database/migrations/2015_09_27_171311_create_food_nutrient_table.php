<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodNutrientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_nutrient', function (Blueprint $table) {
            $table->integer('food_id')->unsigned()->index();
            $table->foreign('food_id')->references('id')->on('foods');
            $table->integer('nutrient_id')->unsigned()->index();
            $table->foreign('nutrient_id')->references('id')->on('nutrients');
            $table->float('amount_in_food');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('food_nutrient');
    }
}
