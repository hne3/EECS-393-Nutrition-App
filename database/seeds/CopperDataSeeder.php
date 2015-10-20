<?php

use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;
use App\Nutrient;

class CopperDataSeeder extends CsvSeeder
{

    /**
     * FoodDataSeeder constructor.
     */
    public function __construct()
    {
        $this->table = 'food_nutrient';
        $this->filename = base_path().'/database/seeds/csvs/copperdata.csv';
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $protein = Nutrient::where('name','Copper')->first();
        if($protein == null){
            $protein = new Nutrient();
            $protein->id = 312;
            $protein->unit = 'mg';
            $protein->name = 'Copper';
            $protein->save();
        }

        DB::disableQueryLog();

        parent::run();
    }
}
