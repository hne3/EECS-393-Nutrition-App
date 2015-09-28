<?php

use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;
use App\Nutrient;

class ManganeseDataSeeder extends CsvSeeder
{

    /**
     * FoodDataSeeder constructor.
     */
    public function __construct()
    {
        $this->table = 'food_nutrient';
        $this->filename = base_path().'/database/seeds/csvs/manganesedata.csv';
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $protein = Nutrient::where('name','Manganese')->first();
        if($protein == null){
            $protein = new Nutrient();
            $protein->id = 315;
            $protein->unit = 'mg';
            $protein->name = 'Manganese';
            $protein->save();
        }

        DB::disableQueryLog();

        DB::table($this->table)->delete();

        parent::run();
    }
}
