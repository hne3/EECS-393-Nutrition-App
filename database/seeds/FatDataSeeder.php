<?php

use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;
use App\Nutrient;

class FatDataSeeder extends CsvSeeder
{

    /**
     * FoodDataSeeder constructor.
     */
    public function __construct()
    {
        $this->table = 'food_nutrient';
        $this->filename = base_path().'/database/seeds/csvs/fatdata.csv';
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $protein = Nutrient::where('name','Fat')->first();
        if($protein == null){
            $protein = new Nutrient();
            $protein->id = 204;
            $protein->unit = 'g';
            $protein->name = 'Fat';
            $protein->save();
        }

        DB::disableQueryLog();

        DB::table($this->table)->delete();

        parent::run();
    }
}
