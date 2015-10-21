<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecommendedvaluesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recommendedvalues', function (Blueprint $table) {
            $table->increments('id')->unsigned()->index();
            $table->string('nutrient_name')->references('name')->on('nutrients');
            $table->integer('age_range')->references('id')->on('ageranges');
            $table->string('sex');
            $table->float('daily_value');
            $table->float('upper_limit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('recommendedvalues');
    }
}
