<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserAuthTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
             ->see('Laravel 5');
    }

    public function testHomepage1()
    {
        $this->visit('/homepage1')
            ->see('You are logged out')
            ->click('Login')
            ->seePageIs('/login');
        $this->visit('/homepage1')
            ->see('You are logged out')
            ->click('Register')
            ->seePageIs('/register');
    }

    public function testHomepage2() 
    {
        $this->visit('/homepage2')
            ->see('You are logged in');
    }

    public function testRegister() 
    {
        $this->visit('/register')
            ->type('user1', 'name')
            ->type('user1@case.edu', 'email')
            ->type('useruser', 'password')
            ->type('useruser', 'password_confirmation')
            ->type('21', 'age')
            ->select('0', 'gender')
            ->type('200', 'weight')
            ->type('200', 'height')
            ->select('0', 'nuts')
            ->select('1', 'seafood')
            ->select('0', 'dairy')
            ->select('1', 'chocolate')
            ->press('Register')
            ->seePageIs('/homepage2');

        $this->seeInDatabase('users', 
            [   'name' => 'user1',
                'email' => 'user1@case.edu',
                'age' => '21',
                'gender' => '0',
                'weight' => '200',
                'height' => '200',
                'nuts' => '0',
                'seafood' => '1',
                'dairy' => '0',
                'chocolate' => '1'
            ]);
    }

    public function testLogin() 
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
            ->withSession(['in' => 'out'])
            ->visit('/homepage2')
            ->see('You are logged in');
    }

    public function testLogout() 
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
            ->withSession(['in' => 'out'])
            ->visit('/homepage2')
            ->click('Logout')
            ->seePageIs('/logout')
            ->see('You are logged out');
    }
}
