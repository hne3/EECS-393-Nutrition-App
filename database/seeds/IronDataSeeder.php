<?php

use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;
use App\Nutrient;

class IronDataSeeder extends CsvSeeder
{

    /**
     * FoodDataSeeder constructor.
     */
    public function __construct()
    {
        $this->table = 'food_nutrient';
        $this->filename = base_path().'/database/seeds/csvs/irondata.csv';
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $protein = Nutrient::where('name','Iron')->first();
        if($protein == null){
            $protein = new Nutrient();
            $protein->id = 303;
            $protein->unit = 'mg';
            $protein->name = 'Iron';
            $protein->save();
        }

        DB::disableQueryLog();

        parent::run();
    }
}
