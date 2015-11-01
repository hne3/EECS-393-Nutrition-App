<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FoodDatabaseTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic functional test example.
     *
     * @return void
     */

    public function testFoodSearchRedirect()
    {
        $this->visit('/home')
            ->see('Welcome to Snackr!')
            ->click('Start a food search>')
            ->seePageIs('/food');
    }

    public function testFoodSearchByPrefix()
    {
        $this->visit('/food')
            ->type('Apple', 'q')
            ->select('search', 'method')
            ->press('Go!')
            ->seePageIs('/food?q=Apple&method=search')
            ->see('Apple juice, canned or bottled, unsweetened, with added ascorbic acid');
    }

    public function testFoodSearchByName()
    {
        $this->visit('/food')
        ->type('Apple juice, canned or bottled, unsweetened, with added ascorbic acid', 'q')
        ->select('name', 'method')
        ->press('Go!')
        ->seePageIs('/food?q=Apple+juice%2C+canned+or+bottled%2C+unsweetened%2C+with+added+ascorbic+acid&method=search')
        ->see('Apple juice, canned or bottled, unsweetened, with added ascorbic acid');
    }

    public function testFoodSearchBySimilarName()
    {
        $this->visit('/food')
            ->type('Apple', 'q')
            ->select('similar', 'method')
            ->press('Go!')
            ->seePageIs('/food?q=Apple&method=search')
            ->see('Apples, raw, gala, with skin');
    }
}
