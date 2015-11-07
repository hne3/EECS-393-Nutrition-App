<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
Use Illuminate\Support\Facades\Schema;

class CreateAgeRangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('age_ranges', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('min_age');
            $table->integer('max_age');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('age_ranges');
    }
}
