<?php

use Illuminate\Support\Facades\Artisan;
use App\Food;
use App\Nutrient;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class FoodHistoryTest extends TestCase
{


    public function spawnUser(){
        $user = factory(App\User::class)->create();
        $user->name = 'FoodHistoryTest';
        $user->email = 'foodhistorytest@test.com';
        $user->password = 'password';
        $user->gender = 'female';
        $ageTemp = new \Carbon\Carbon();
        $ageTemp->addYear(-23);
        $user->bdate = $ageTemp->toDateString();
        $user->daily_calories = 1500;
        return $user;
    }

    // Logs a food via user UI
    public function logFoodUI(){
        $user = $this->spawnUser();

        $this->actingAs($user)
            ->visit('/food')
            ->type('apple', 'q')
            ->select('search', 'method')
            ->press('Go!')
            ->see('Apple juice, canned or bottled, unsweetened, with added ascorbic acid')
            ->type('1', 'quantity')
            ->press('Eat now');
    }

    // Logs a food via direct variable manipulation
    public function logFoodUnit(){
        $user = $this->spawnUser();
        $food = App\Food::SearchByName('apple')[0];
        $user->addToFoodHistory($food, 1,1);
        return $user;
    }

    // Tests user history via direct UI manipulation
    public function testHistoryViaUI(){
        $this->logFoodUI();

        $this->visit('/history')
            // Checks name, calories, and quantity
            ->see('Apple juice, canned or bottled, unsweetened, with added ascorbic acid')
            ->see('0.46')
            ->see('1')
            ->visit('http://snackr.app/history#dailyNutrients')
            // Ensures each day's nutrients is displaying properly
            ->see('5 days ago')
            ->see('4 days ago')
            ->see('3 days ago')
            ->see('2 days ago')
            ->see('1 day ago')
            ->see('Today')
            // TODO: Check each column for appropriate values
            ->see('0');
    }

    // Tests user history with object manipulation
    public function testHistoryUnit(){
        $u = $this->logFoodUnit();
        $this->assertEquals('1', count($u->getFoodHistory()));
        $this->assertEquals('Apple juice, canned or bottled, unsweetened, with added ascorbic acid', $u->getFoodHistory()[0]->name);
    }
}
