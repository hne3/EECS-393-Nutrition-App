<?php

use Illuminate\Database\Seeder;

class LactoseAllergyBasicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lactoses = ['milk', 'dairy', 'yogurt', 'butter', 'cheese', 'casein', 
                    'clabber', 'gelato', 'cream', 'custard', 'brick', 'brie', 
                    'camembert', 'cheddar', 'chesire', 'colby', 'coldpack', 'edam', 
                    'feta'];
        $lactosesArray = array();

        //Retrieve all foods with nut in the name. Super rudimentary way to filter, but this will just show that the API works.

        foreach($lactoses as $lactose) {
            $lactosesArray = array_merge($lactosesArray, \App\Food::GetNameSimilarTo($lactose)->lists('id')->toArray());
        }

        $lactosesArray = array_unique($lactosesArray);

        $restriction = App\Restriction::find(4);

        $restriction->restrictedFoods()->attach($lactosesArray);
    }
}
