<?php

use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;
use App\Nutrient;

class VitaminCDataSeeder extends CsvSeeder
{

    /**
     * FoodDataSeeder constructor.
     */
    public function __construct()
    {
        $this->table = 'food_nutrient';
        $this->filename = base_path().'/database/seeds/csvs/vitamincdata.csv';
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $protein = Nutrient::where('name','Vitamin C')->first();
        if($protein == null){
            $protein = new Nutrient();
            $protein->id = 401;
            $protein->unit = 'mg';
            $protein->name = 'Vitamin C';
            $protein->save();
        }

        DB::disableQueryLog();

        parent::run();
    }
}
