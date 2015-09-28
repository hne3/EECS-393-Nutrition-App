<?php

use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;
use App\Nutrient;

class PhosphorusDataSeeder extends CsvSeeder
{

    /**
     * FoodDataSeeder constructor.
     */
    public function __construct()
    {
        $this->table = 'food_nutrient';
        $this->filename = base_path().'/database/seeds/csvs/phosphorusdata.csv';
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $protein = Nutrient::where('name','Phosphorus')->first();
        if($protein == null){
            $protein = new Nutrient();
            $protein->id = 305;
            $protein->unit = 'mg';
            $protein->name = 'Phosphorus';
            $protein->save();
        }

        DB::disableQueryLog();

        DB::table($this->table)->delete();

        parent::run();
    }
}
