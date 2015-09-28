<?php

use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;
use App\Nutrient;

class CalciumDataSeeder extends CsvSeeder
{

    /**
     * FoodDataSeeder constructor.
     */
    public function __construct()
    {
        $this->table = 'food_nutrient';
        $this->filename = base_path().'/database/seeds/csvs/calciumdata.csv';
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $protein = Nutrient::where('name','Calcium')->first();
        if($protein == null){
            $protein = new Nutrient();
            $protein->id = 301;
            $protein->unit = 'mg';
            $protein->name = 'Calcium';
            $protein->save();
        }

        DB::disableQueryLog();

        DB::table($this->table)->delete();

        parent::run();
    }
}
