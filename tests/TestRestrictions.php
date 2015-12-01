<?php

use Illuminate\Support\Facades\Artisan;
use App\Food;
use App\Nutrient;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class TestRestrictions extends TestCase
{

    function __construct()
    {
        parent::setUp();
    }

    public function spawnUser(){
        $user = factory(App\User::class)->create();
        $user->name = 'FoodHistoryTest';
        $user->email = 'foodhistorytest@test.com';
        $user->password = 'password';
        $user->gender = 'female';
        $user->weight = '110';
        $user->height = '60';
        $ageTemp = new \Carbon\Carbon();
        $ageTemp->addYear(-23);
        $user->bdate = $ageTemp->toDateString();
        $r = App\Restriction::all()[0];
        $user->addRestriction($r);
        return $user;
    }

    public function testRestrictionsUI(){
        $user = $this->spawnUser();
        $f = App\Food::SearchByName("nuts", []);
        $this->actingAs($user)
            ->visit('/food')
            ->type('nuts', 'q')
            ->select('search', 'method')
            ->press('Go!')
            ->dontSee($f);
    }

    public function testRestrictions(){
        $user = $this->spawnUser();
        $r = App\Restriction::all()[0];
        $f = App\Food::GetNameSimilarTo("nuts", [])[0];
        $this-> assertEquals($user->canEatFood($f), false);
        $this->assertEquals($f->isRestricted($r), true);
    }

}
