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
        $user->gender = 'F';
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
            ->select('1', 'restrictions')
            ->select('search', 'method')
            ->press('Go!')
            ->dontSee($f);
    }

    public function testRestrictions(){
        $user = $this->spawnUser();
        //$r = App\Restriction::all()[0];
        $this->assertEquals($r->getDisplayName(), "Nut Allergy");
        $this->assertEquals($user->getRestrictions(), $r);

        // Spawns food and detaches + reattaches restriction
        $f = App\Food::GetNameSimilarTo("nuts", [])[0];
        App\Food::ObeyRestrictions($r);

        if($f->isRestricted($r)){
            $f->removeRestriction($r);
            $this->assertEquals($f->isRestricted($r), false);
        }

        $f->addRestriction($r);
        $this-> assertEquals($user->canEatFood($f), false);
        $this->assertEquals($f->isRestricted($r), true);

        $sample = $user->getFoodSuggestion();
        $this->assertEquals($user->canEatFood($sample), true);
    }

}
