<?php

use Illuminate\Support\Facades\Artisan;
use App\Food;
use App\Nutrient;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class FoodHistoryTest extends TestCase
{


    public function spawnUser(){
        $user = new App\User();
        $user->name = 'HistoryTest';
        $user->email = 'htest@test.com';
        $user->password = 'password';
        $user->gender = 'female';
        $user->weight = '110';
        $user->height = '60';
        $user->age = '23';
        $user->nuts = '0';
        $user->seafood = '0';
        $user->dairy = '0';
        $user->chocolate = '0';
        $user->id = '10000';
        return $user;
    }

    // Logs a food via user UI
    public function logFoodUI(){
        $user = $this->spawnUser();

        $this->visit('/food')

            ->type($user->email, 'E-Mail Address')
            ->type($user->password, 'Password')
            ->click('Login')

            ->type('apple', 'q')
            ->press('Go!')
            ->see('Apple juice, canned or bottled, unsweetened, with added ascorbic acid')
            ->type('1', 'q')
            ->click('Eat now');
    }

    // Logs a food via direct variable manipulation
    public function logFoodUnit(){
        $user = $this->spawnUser();
        $food = App\Food::SearchByName('apple')[0];
        $user->addToFoodHistory($food, '1');
        return $user;
    }

    public function testHistoryViaUI(){
        $this->logFoodUI();

        $this->visit('/history')
            // Checks name, calories, and quantity
            ->see('Apple juice, canned or bottled, unsweetened, with added ascorbic acid')
            ->see('0.46')
            ->see('1');
    }

    public function testHistoryUnit(){
        $u = $this->logFoodUnit();
        $food = App\Food::SearchByName('apple')[0];
        $this->assertEquals('1', count($u->getFoodHistory()));
        $this->assertEquals($food, $u->getFoodHistory());
    }
}
