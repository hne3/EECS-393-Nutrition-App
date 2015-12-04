<?php

use Illuminate\Database\Seeder;

class DairyAllergyBasicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dairys = ['milk', 'dairy', 'yogurt', 'butter', 'cheese', 'casein', 
                    'clabber', 'gelato', 'cream', 'custard', 'brick', 'brie', 
                    'camembert', 'cheddar', 'chesire', 'colby', 'coldpack', 'edam', 
                    'feta'];
        $dairysArray = array();

        //Retrieve all foods with nut in the name. Super rudimentary way to filter, but this will just show that the API works.

        foreach($dairys as $dairy) {
            $dairysArray = array_merge($dairysArray, \App\Food::GetNameSimilarTo($dairy)->lists('id')->toArray());
        }

        $dairysArray = array_unique($dairysArray);

        $restriction = App\Restriction::find(3);

        $restriction->restrictedFoods()->attach($dairysArray);
    }
}
