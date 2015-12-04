<?php

use Illuminate\Support\Facades\Artisan;
use App\User;
use App\Food;
use App\Nutrient;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class RestrictionsTest extends TestCase
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

    public function testRestrictionsUI(){
        $user = $this->spawnUser();
        $r = App\Restriction::all()[0];
        $user->addRestriction($r);
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
        $r = App\Restriction::all()[0];
        $user->addRestriction($r);

        $this->assertEquals($user->addRestriction($r), null);
        $this->assertEquals($r->getDisplayName(), "Nut Allergy");

        //Spawns food and detaches + reattaches restriction
        $f = App\Food::GetNameSimilarTo("nuts", [])[0];
        App\Food::ObeyRestrictions($r);
        $this->assertEquals(App\Food::ObeyRestrictions($r), null);

        if($f->isRestricted($r)){
            $f->removeRestriction($r);
            $this->assertEquals($f->removeRestriction($r), null);
            $this->assertEquals($f->isRestricted($r), false);
        }

        $f->addRestriction($r);
        $this-> assertEquals($user->canEatFood($f), false);
        $this->assertEquals($f->isRestricted($r), true);

        $sample1 = $user->getFoodSuggestion();
        $sample2 = $user->getFoodSuggestion();
        $this->assertNotEquals($sample1, $sample2);
        //$this->assertEquals($user->canEatFood($sample), true); 
    }

}
