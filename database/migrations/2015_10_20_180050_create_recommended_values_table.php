<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateRecommendedValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recommended_values', function (Blueprint $table) {
            $table->increments('id')->unsigned()->index();
            $table->string('nutrient_id')->references('id')->on('nutrients');
            $table->integer('age_range')->references('id')->on('age_ranges');
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
        Schema::drop('recommended_values');
    }
}
