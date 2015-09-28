<?php

use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;

class FoodDataSeeder extends CsvSeeder
{


    /**
     * FoodDataSeeder constructor.
     */
    public function __construct()
    {
        $this->table = 'foods';
        $this->filename = base_path().'/database/seeds/csvs/fooddata1.csv';
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();

        DB::table($this->table)->delete();

        parent::run();
    }
}
