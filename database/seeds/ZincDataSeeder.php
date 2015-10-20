<?php

use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;
use App\Nutrient;

class ZincDataSeeder extends CsvSeeder
{

    /**
     * FoodDataSeeder constructor.
     */
    public function __construct()
    {
        $this->table = 'food_nutrient';
        $this->filename = base_path().'/database/seeds/csvs/zincdata.csv';
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $protein = Nutrient::where('name','Zinc')->first();
        if($protein == null){
            $protein = new Nutrient();
            $protein->id = 309;
            $protein->unit = 'mg';
            $protein->name = 'Zinc';
            $protein->save();
        }

        DB::disableQueryLog();

        parent::run();
    }
}
