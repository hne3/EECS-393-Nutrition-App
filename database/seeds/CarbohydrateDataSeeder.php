<?php

use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;
use App\Nutrient;

class CarbohydrateDataSeeder extends CsvSeeder
{

    /**
     * FoodDataSeeder constructor.
     */
    public function __construct()
    {
        $this->table = 'food_nutrient';
        $this->filename = base_path().'/database/seeds/csvs/carbohydratesdata.csv';
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $protein = Nutrient::where('name','Carbohydrates')->first();
        if($protein == null){
            $protein = new Nutrient();
            $protein->id = 205;
            $protein->unit = 'g';
            $protein->name = 'Carbohydrates';
            $protein->save();
        }

        DB::disableQueryLog();

        parent::run();
    }
}
