<?php

use Illuminate\Support\Facades\Artisan;

class FoodDatabaseTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */

    protected static $dbSeeded = false;

    protected static function setupDB()
    {
        Artisan::call('migrate');
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

    public function testFoodSearchRedirect()
    {
        $this->visit('/home')
            ->see('Welcome to Snackr!')
            ->click('Start a food search>')
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
            ->press('Go!')
            ->seePageStartsWith('/food')
            ->seePageHasGetParameters(['q'=>'Apple','method'=>'similar'])
            ->see('Apples, raw, gala, with skin');
    }
}
