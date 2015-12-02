<?php

use Illuminate\Support\Facades\Artisan;
use App\Food;
use App\Nutrient;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class RecommendedValueTest extends TestCase
{
    public function testRecommendedValues(){
        $u = $this->spawnUser();
        $val = App\Recommendedvalue::GetRecommendedValues($u);
        $this->assertEquals($val->getRecommendedCarbohydrates(), '130.0');
        $this->assertEquals($val->getRecommendedCalories(), null);
        $this->assertEquals($val->getRecommendedProtein(), '56.0');
        $this->assertEquals($val->getRecommendedFat(), '0.0');
        $this->assertEquals($val->getRecommendedCaffeine(), '0.0');
        $this->assertEquals($val->getRecommendedSugar(), '0.0');
        // fiber
        $this->assertEquals($val->getRecommendedFiber(), '38.0');
        // calcium
        $this->assertEquals($val->getRecommendedCalcium(), '1000.0');
        // iron
        $this->assertEquals($val->getRecommendedIron(), '8.0');
        // magnesium
        $this->assertEquals($val->getRecommendedMagnesium(), '400.0');
        // phosphorus
        $this->assertEquals($val->getRecommendedPhosphorus(), '700.0');
        // potassium
        $this->assertEquals($val->getRecommendedPotassium(), '4.7');
        // sodium
        $this->assertEquals($val->getRecommendedSodium(), '1500.0');
        // zinc
        $this->assertEquals($val->getRecommendedZinc(), '11.0');
        // copper
        $this->assertEquals($val->getRecommendedCopper(), '0.9');
        // manganese
        $this->assertEquals($val->getRecommendedManganese(), '2.3');
        // vitamin a
        $this->assertEquals($val->getRecommendedVitaminA(), '900.0');
        // vitamin b6
        $this->assertEquals($val->getRecommendedVitaminB6(), '1.3');
        // vitamin b12
        $this->assertEquals($val->getRecommendedVitaminB12(), '2.4');
        // vitamin c
        $this->assertEquals($val->getRecommendedVitaminC(), '90.0');
        // vitamin d
        $this->assertEquals($val->getRecommendedVitaminD(), '5.0');
        // vitamin e
        $this->assertEquals($val->getRecommendedVitaminE(), '15.0');
        // vitamin k
        $this->assertEquals($val->getRecommendedVitaminK(), '120.0');
    }

    public function testUpperLimitValues()
    {
        $u = $this->spawnUser();
        $val = App\Recommendedvalue::GetRecommendedValues($u);
        $this->assertEquals($val->getUpperLimitCarbohydrates(), null);
        $this->assertEquals($val->getUpperLimitProtein(), null);
        $this->assertEquals($val->getUpperLimitFat(), null);
        $this->assertEquals($val->getUpperLimitCaffeine(), '400.0');
        $this->assertEquals($val->getUpperLimitSugar(), null);
        // fiber
        $this->assertEquals($val->getUpperLimitFiber(), null);
        // calcium
        $this->assertEquals($val->getUpperLimitCalcium(), '2500.0');
        // iron
        $this->assertEquals($val->getUpperLimitIron(), '45.0');
        // magnesium
        $this->assertEquals($val->getUpperLimitMagnesium(), null);
        // phosphorus
        $this->assertEquals($val->getUpperLimitPhosphorus(), '4000.0');
        // potassium
        $this->assertEquals($val->getUpperLimitPotassium(), null);
        // sodium
        $this->assertEquals($val->getUpperLimitSodium(), '2300.0');
        // zinc
        $this->assertEquals($val->getUpperLimitZinc(), '40.0');
        // copper
        $this->assertEquals($val->getUpperLimitCopper(), '10.0');
        // manganese
        $this->assertEquals($val->getUpperLimitManganese(), '11.0');
        // vitamin a
        $this->assertEquals($val->getUpperLimitVitaminA(), '3000.0');
        // vitamin b6
        $this->assertEquals($val->getUpperLimitVitaminB6(), '100.0');
        // vitamin b12
        $this->assertEquals($val->getUpperLimitVitaminB12(), null);
        // vitamin c
        $this->assertEquals($val->getUpperLimitVitaminC(), '2000.0');
        // vitamin d
        $this->assertEquals($val->getUpperLimitVitaminD(), '50.0');
        // vitamin e
        $this->assertEquals($val->getUpperLimitVitaminE(), '1000.0');
        // vitamin k
        $this->assertEquals($val->getUpperLimitVitaminK(), null);
    }

    public function spawnUser(){
        $user = new App\User();
        $user->name = 'Test';
        $user->email = 'test@test.com';
        $user->password = 'password';
        $user->gender = 'female';
        $user->weight = '110';
        $user->height = '60';
        $ageTemp = new \Carbon\Carbon();
        $ageTemp->addYear(-23);
        $user->bdate = $ageTemp->toDateString();
        return $user;
    }
}
