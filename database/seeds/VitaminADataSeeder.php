<?php

use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;
use App\Nutrient;

class VitaminADataSeeder extends CsvSeeder
{

    /**
     * FoodDataSeeder constructor.
     */
    public function __construct()
    {
        $this->table = 'food_nutrient';
        $this->filename = base_path().'/database/seeds/csvs/vitaminadata.csv';
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $protein = Nutrient::where('name','Vitamin A')->first();
        if($protein == null){
            $protein = new Nutrient();
            $protein->id = 320;
            $protein->unit = 'ug';
            $protein->name = 'Vitamin A';
            $protein->save();
        }

        DB::disableQueryLog();

        parent::run();
    }
}
