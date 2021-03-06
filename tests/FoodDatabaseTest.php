<?php

use Illuminate\Support\Facades\Artisan;
use App\Food;
use App\Nutrient;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class FoodDatabaseTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */

    use WithoutMiddleware;

    protected static $dbSeeded = false;

    protected static function setupDB()
    {
        Artisan::call('migrate:refresh');
        Artisan::call('db:seed');
    }

    public function setUp()
    {
        parent::setUp();
        if(!static::$dbSeeded){
            static::setupDB();
            static::$dbSeeded = true;
        }
    }

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

   public function testFoodSearchRedirect()
   {
        $user = $this->spawnUser();
        $this->actingAs($user)
           ->visit('/home')
           ->see('Snackr')
           ->click('Food Search')
           ->seePageIs('/food');
   }

    public function testFoodSearchByPrefix()
    {
        //?q=Apple&method=search
        $this->visit('/food')
            ->type('Apple', 'q')
            ->select('search', 'method')
            ->press('Go!')
            ->seePageStartsWith('/food')
            ->seePageHasGetParameters(['q'=>'Apple','method'=>'search'])
            ->see('Apple juice, canned or bottled, unsweetened, with added ascorbic acid');
    }

    public function testFoodSearchByName()
    {
        $this->visit('/food')
        ->type('Apple juice, canned or bottled, unsweetened, with added ascorbic acid', 'q')
        ->select('name', 'method')
        ->press('Go!')
        ->seePageStartsWith('/food')
        ->seePageHasGetParameters(['q'=>'Apple%20juice%2C%20canned%20or%20bottled%2C%20unsweetened%2C%20with%20added%20ascorbic%20acid','method'=>'name'])
        ->see('Apple juice, canned or bottled, unsweetened, with added ascorbic acid');
    }

    public function testFoodSearchBySimilarName()
    {
        $this->visit('/food')
            ->type('Apple', 'q')
            ->select('similar', 'method')
            ->select('1', 'restrictions')
            ->select('cal', 'sort')
            ->press('Go!')
            ->seePageStartsWith('/food')
            ->seePageHasGetParameters(['q'=>'Apple','method'=>'similar'])
            ->see('Apples, raw, gala, with skin');
    }

    public function testSearchSorting()
    {
        $this->visit('/food')
            ->type('pear', 'q')
            ->select('search', 'method')
            ->select('sugar', 'sort')
            ->press('Go!')
            ->seePageHasGetParameters(['q'=>'pear','method'=>'search', 'sort'=>'sugar'])
            ->see('Pears, dried, sulfured, stewed, with added sugar');

        $this->visit('/food')
            ->type('pear', 'q')
            ->select('search', 'method')
            ->select('fat', 'sort')
            ->press('Go!')
            ->seePageHasGetParameters(['q'=>'pear', 'method'=>'search', 'sort'=>'fat'])
            ->see('Pear nectar, canned, with added ascorbic acid');
    }

    // UNIT TESTS FOR FOOD DATABASE
    public function testFoodCreation()
    {
        $food = Food::GetNameSimilarTo("apple")[0];
        $this->assertEquals("Babyfood, apples, dices, toddler", $food->getName());
        $this->assertEquals("3115", $food->getId());
        // 51 calories
        $this->assertEquals("51", $food->getCalories());
        // 0.0 caffiene
        $this->assertEquals("0.0", $food->getCaffeine());
        $this->assertEquals("mg", $food->getCaffieneUnits());
        // 0.02 mg copper
        $this->assertEquals("0.02", $food->getCopper());
        $this->assertEquals("mg", $food->getCopperUnits());
        // 0.1 g fat
        $this->assertEquals("0.1", $food->getFat());
        $this->assertEquals("g", $food->getFatUnits());
        // 0.9 g fiber
        $this->assertEquals("0.9", $food->getFiber());
        $this->assertEquals("g", $food->getFiberUnits());
        // 0.2 mg iron
        $this->assertEquals("0.2", $food->getIron());
        $this->assertEquals("mg", $food->getIronUnits());
        // 6.0 mg magnesium
        $this->assertEquals("6.0", $food->getMagnesium());
        $this->assertEquals("mg", $food->getMagnesiumUnits());
        // 13.0 mg phosphorus
        $this->assertEquals("13.0", $food->getPhosphorus());
        $this->assertEquals("mg", $food->getPhosphorusUnits());
        // 0.04 mg manganese
        $this->assertEquals("0.04", $food->getManganese());
        $this->assertEquals("mg", $food->getManganeseUnits());
        // 0 mg potassium
        $this->assertEquals("0", $food->getPotassium());
        $this->assertEquals("mg", $food->getPotassiumUnits());
        // 0 mg sodium
        $this->assertEquals("0", $food->getSodium());
        $this->assertEquals("mg", $food->getSodiumUnits());
        // 10.0 calcium
        $this->assertEquals("10.0", $food->getCalcium());
        // Calcium unit: mg
        $this->assertEquals("mg", $food->getCalciumUnits());
        // 12.1 carbohydrates
        $this->assertEquals("12.1", $food->getCarbohydrates());
        // Carbohydrates units: g
        $this->assertEquals("g", $food->getCarbohydratesUnits());
        // 0.2g protein
        $this->assertEquals("0.2", $food->getProtein());
        $this->assertEquals("g", $food->getProteinUnits());
        // 10.83g sugar
        $this->assertEquals("10.83", $food->getSugar());
        $this->assertEquals("g", $food->getSugarUnits());
        // 2.0 ug vitamin a
        $this->assertEquals("2.0", $food->getVitaminA());
        $this->assertEquals("ug", $food->getVitaminAUnits());
        // 0.0 ug vitamin b12
        $this->assertEquals("0.0", $food->getVitaminB12());
        $this->assertEquals("ug", $food->getVitaminB12Units());
        // 0.05 mg vitamin b6
        $this->assertEquals("0.05", $food->getVitaminB6());
        $this->assertEquals("mg", $food->getVitaminB6Units());
        // 31.3 mg vitamin c
        $this->assertEquals("31.3", $food->getVitaminC());
        $this->assertEquals("mg", $food->getVitaminCUnits());
        // 0.0 ug vitamin d
        $this->assertEquals("0.0", $food->getVitaminD());
        $this->assertEquals("ug", $food->getVitaminDUnits());
        // 0.23 mg vitamin e
        $this->assertEquals("0.23", $food->getVitaminE());
        $this->assertEquals("mg", $food->getVitaminEUnits());
        // 0.6 ug vitamin k
        $this->assertEquals("0.6", $food->getVitaminK());
        $this->assertEquals("ug", $food->getVitaminKUnits());
        // 0.04 mg zinc
        $this->assertEquals("0.04", $food->getZinc());
        $this->assertEquals("mg", $food->getZincUnits());
    }

    public function testNutrients()
    {
        $protein = Nutrient::Protein();
        $carbohydrates = Nutrient::Carbohydrates();
        $fat = Nutrient::Fat();

        // Test units, ID, and all foods with protein
        $this->assertEquals("g", $protein->getUnits());
        $this->assertEquals("203", $protein->getID());
        $this->assertEquals("6607", count($protein->getFoods()));

        // Test units, ID, and all foods with carbs
        $this->assertEquals("g", $carbohydrates->getUnits());
        $this->assertEquals("205", $carbohydrates->getID());
        $this->assertEquals("5940", count($carbohydrates->getFoods()));

        // Test units, ID, and all foods with fat
        $this->assertEquals("g", $fat->getUnits());
        $this->assertEquals("204", $fat->getID());
        $this->assertEquals("6595", count($fat->getFoods()));

    }
}
