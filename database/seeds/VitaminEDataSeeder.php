<?php

use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;
use App\Nutrient;

class VitaminEDataSeeder extends CsvSeeder
{

    /**
     * FoodDataSeeder constructor.
     */
    public function __construct()
    {
        $this->table = 'food_nutrient';
        $this->filename = base_path().'/database/seeds/csvs/vitaminedata.csv';
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $protein = Nutrient::where('name','Vitamin E')->first();
        if($protein == null){
            $protein = new Nutrient();
            $protein->id = 323;
            $protein->unit = 'mg';
            $protein->name = 'Vitamin E';
            $protein->save();
        }

        DB::disableQueryLog();

        parent::run();
    }
}
