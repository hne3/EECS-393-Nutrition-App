<?php
/**
 * Created by PhpStorm.
 * User: LauraTheGreat
 * Date: 10/20/2015
 * Time: 4:50 PM
 */

use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;

class DailyValueSeeder extends CsvSeeder
{
    /**
     * DailyValueSeeder constructor.
     */
    public function __construct()
    {
        $this->table = 'recommendedvalues';
        $this->filename = base_path().'/database/seeds/csvs/dailyvaluesdata.csv';
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();

        parent::run();
    }
}