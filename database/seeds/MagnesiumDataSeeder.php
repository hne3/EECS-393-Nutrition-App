<?php

use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;
use App\Nutrient;

class MagnesiumDataSeeder extends CsvSeeder
{

    /**
     * FoodDataSeeder constructor.
     */
    public function __construct()
    {
        $this->table = 'food_nutrient';
        $this->filename = base_path().'/database/seeds/csvs/magnesiumdata.csv';
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $protein = Nutrient::where('name','Magnesium')->first();
        if($protein == null){
            $protein = new Nutrient();
            $protein->id = 304;
            $protein->unit = 'mg';
            $protein->name = 'Magnesium';
            $protein->save();
        }

        DB::disableQueryLog();

        parent::run();
    }
}
