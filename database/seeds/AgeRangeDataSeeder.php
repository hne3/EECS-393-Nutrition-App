<?php
/**
 * Created by PhpStorm.
 * User: LauraTheGreat
 * Date: 10/20/2015
 * Time: 4:50 PM
 */

use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;

class AgeRangeDataSeeder extends CsvSeeder
{
    /**
     * AgeRangeSeeder constructor.
     */
    public function __construct()
    {
        $this->table = 'age_ranges';
        $this->filename = base_path().'/database/seeds/csvs/agerangedata.csv';
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