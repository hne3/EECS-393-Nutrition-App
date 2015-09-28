<?php

use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;
use App\Nutrient;

class VitaminB6DataSeeder extends CsvSeeder
{

    /**
     * FoodDataSeeder constructor.
     */
    public function __construct()
    {
        $this->table = 'food_nutrient';
        $this->filename = base_path().'/database/seeds/csvs/vitaminb6data.csv';
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $protein = Nutrient::where('name','Vitamin B-6')->first();
        if($protein == null){
            $protein = new Nutrient();
            $protein->id = 415;
            $protein->unit = 'mg';
            $protein->name = 'Vitamin B-6';
            $protein->save();
        }

        DB::disableQueryLog();

        DB::table($this->table)->delete();

        parent::run();
    }
}
