<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateFoodRestrictionPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_restriction', function (Blueprint $table) {
            $table->integer('food_id')->unsigned()->index();
            $table->foreign('food_id')->references('id')->on('foods')->onDelete('cascade');
            $table->integer('restriction_id')->unsigned()->index();
            $table->foreign('restriction_id')->references('id')->on('restrictions')->onDelete('cascade');
            $table->primary(['food_id', 'restriction_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('food_restriction');
    }
}
