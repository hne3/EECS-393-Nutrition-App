<?php

use Illuminate\Database\Seeder;

class NutAllergyBasicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nuts = ['acorn', 'cashew', 'pecan', 'nut', 'almond', 'pistachio'];
        $nutFoodsArray = array();

        //Retrieve all foods with nut in the name. Super rudimentary way to filter, but this will just show that the API works.

        foreach($nuts as $nut) {
            $nutFoodsArray = array_merge($nutFoodsArray, \App\Food::GetNameSimilarTo($nut)->lists('id')->toArray());
        }

        $nutFoodsArray = array_unique($nutFoodsArray);

        $restriction = App\Restriction::find(1);

        $restriction->restrictedFoods()->attach($nutFoodsArray);
    }
}
