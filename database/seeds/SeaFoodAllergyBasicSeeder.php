<?php

use Illuminate\Database\Seeder;

class SeaFoodAllergyBasicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seafoods = ['fish', 'anchovy', 'basa', 'bass', 'cod', 'bream', 'brill', 'eel', 
                    'herring', 'pike', 'pollock', 'salmon', 'sardine', 'shark', 'snapper',
                    'tilapia', 'trout', 'tuna', 'whiting', 'caviar', 'crab', 'lobster', 
                    'shrimp', 'mollusc', 'conch', 'mussel', 'octopus', 'oyster', 'scallop',
                    'squid', 'sea'];
        $seaFoodsArray = array();

        //Retrieve all foods with nut in the name. Super rudimentary way to filter, but this will just show that the API works.

        foreach($seafoods as $seafood) {
            $seaFoodsArray = array_merge($seaFoodsArray, \App\Food::GetNameSimilarTo($seafood)->lists('id')->toArray());
        }

        $seaFoodsArray = array_unique($seaFoodsArray);

        $restriction = App\Restriction::find(2);

        $restriction->restrictedFoods()->attach($seaFoodsArray);
    }
}
