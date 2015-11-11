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
        $user->weight = '110';
        $user->height = '60';
        $user->age = '23';
        $user->nuts = '0';
        $user->seafood = '0';
        $user->dairy = '0';
        $user->chocolate = '0';
        //$user->id = '10000';
        return $user;
    }

    // Logs a food via user UI
    public function logFoodUI(){
        $user = $this->spawnUser();

        $this->actingAs($user)
/*
            ->seePageIs('/auth/login')
            ->type($user->email, 'email')
            ->type($user->password, 'password')
            ->click('Login')*/

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
        $user->addToFoodHistory($food, '1');
        return $user;
    }

    // Tests user history via direct UI manipulation
    public function testHistoryViaUI(){
        $this->logFoodUI();

        $this->visit('/history')
            // Checks name, calories, and quantity
            ->see('Apple juice, canned or bottled, unsweetened, with added ascorbic acid')
            ->see('0.46')
            ->see('1');
    }

    // Tests user history with object manipulation
    public function testHistoryUnit(){
        $u = $this->logFoodUnit();
        $this->assertEquals('1', count($u->getFoodHistory()));
        $this->assertEquals('Apple juice, canned or bottled, unsweetened, with added ascorbic acid', $u->getFoodHistory()[0]->name);
    }
}
