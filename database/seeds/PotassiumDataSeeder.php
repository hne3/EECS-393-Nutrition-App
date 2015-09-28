<?php

use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;
use App\Nutrient;

class PotassiumDataSeeder extends CsvSeeder
{

    /**
     * FoodDataSeeder constructor.
     */
    public function __construct()
    {
        $this->table = 'food_nutrient';
        $this->filename = base_path().'/database/seeds/csvs/potassiumsdata.csv';
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $protein = Nutrient::where('name','Potassium')->first();
        if($protein == null){
            $protein = new Nutrient();
            $protein->id = 306;
            $protein->unit = 'mg';
            $protein->name = 'Potassium';
            $protein->save();
        }

        DB::disableQueryLog();

        parent::run();
    }
}
