<?php

use Illuminate\Support\Facades\Artisan;
use App\User;
use App\Food;
use App\Nutrient;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class FoodSuggestionTest extends TestCase
{

    public function spawnUser(){
        $user = factory(App\User::class)->create();
        $user->name = 'FoodRestrictionTest';
        $user->email = 'foodrestrictiontest@test.com';
        $user->password = 'password';
        $user->gender = 'female';
        $ageTemp = new \Carbon\Carbon();
        $ageTemp->addYear(-23);
        $user->bdate = $ageTemp->toDateString();
        $user->daily_calories = 1500;
        return $user;
    }

    public function testFoodSuggestionRedirect()
    {
        $user = $this->spawnUser();
        $this->actingAs($user)
            ->visit('/home')
            ->click('Food Suggestion')
            ->seePageIs('/suggestion');
    }

    public function testSuggestion(){
    	$user = $this->spawnUser();

    	//tests getting suggestion when history is empty
    	$suggestion1 = $user->getFoodSuggestion();    
    	$user->addToFoodHistory($suggestion1, 1, 1);

    	$suggestion2 = $user->getFoodSuggestion();
    	$user->addToFoodHistory($suggestion2, 1, 1);
    }

    public function testMap(){
    	$user = $this->spawnUser();
    	$this->actingAs($user)
    		->visit('/home')
    		->click('Nearby Food')
    		->seePageIs('/map')
    		->see('Nearby Food');
    }
}	