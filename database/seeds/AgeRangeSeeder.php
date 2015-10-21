<?php
/**
 * Created by PhpStorm.
 * User: LauraTheGreat
 * Date: 10/20/2015
 * Time: 4:50 PM
 */

namespace database\seeds;

use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;
use App\Nutrient;

class AgeRangeSeeder extends CsvSeeder
{
    /**
     * AgeRangeSeeder constructor.
     */
    public function __construct()
    {
        $this->table = 'ageranges';
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