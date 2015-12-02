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
        //Retrieve all foods with nut in the name. Super rudimentary way to filter, but this will just show that the API works.
        $nutFoods = \App\Food::GetNameSimilarTo('nut')->lists('id')->toArray();

        $restriction = App\Restriction::find(1);

        $restriction->restrictedFoods()->attach($nutFoods);
    }
}
