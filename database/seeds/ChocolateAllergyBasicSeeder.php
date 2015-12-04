<?php

use Illuminate\Database\Seeder;

class ChocolateAllergyBasicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chocolates = ['chocolate', 'cocoa'];
        $chocolatesArray = array();

        //Retrieve all foods with nut in the name. Super rudimentary way to filter, but this will just show that the API works.

        foreach($chocolates as $chocolate) {
            $chocolatesArray = array_merge($chocolatesArray, \App\Food::GetNameSimilarTo($chocolate)->lists('id')->toArray());
        }

        $chocolatesArray = array_unique($chocolatesArray);

        $restriction = App\Restriction::find(5);

        $restriction->restrictedFoods()->attach($chocolatesArray);
    }
}