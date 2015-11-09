<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Food;
use App\Nutrient;
use App\Restriction;

class UserAuthTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic functional test example.
     *
     * @return void
     */

    public function testWelcome()
    {
        $this->visit('/')
            ->see('Snackr')
            ->click('Register')
            ->seePageIs('/auth/register');
        $this->visit('/')
            ->click('Login')
            ->seePageIs('/auth/login');
    }

    public function testHome() 
    {
        $this->visit('/home')
            ->see('Welcome to Snackr!');
    }

    public function testRegister() 
    {
        $this->visit('/auth/register')
            ->type('user1', 'name')
            ->type('user1@case.edu', 'email')
            ->type('useruser', 'password')
            ->type('useruser', 'password_confirmation')
            ->type('21', 'age')
            ->select('0', 'gender')
            ->type('200', 'weight')
            ->type('200', 'height');
            $map = [];
        $restrictions = Restriction::all();
            foreach($restrictions as $restriction){
                $val = round(mt_rand() / mt_getrandmax());
                $map[$restriction->id] = $val;
                $this->type($val,'restriction'.($restriction->id+1));
            }
            $this->press('Register')
            ->seePageIs('/home');

        $this->seeInDatabase('users', 
            [   'name' => 'user1',
                'email' => 'user1@case.edu',
                'age' => '21',
                'gender' => '0',
                'weight' => '200',
                'height' => '200',
            ]);
        $user = \App\User::whereEmail('user1@case.edu')->first();
        foreach($restrictions as $restriction){
            if($map[$restriction->id] == 1){
                $this->seeInDatabase('restriction_user',[
                    'user_id'=>$user->id,
                    'restriction_id'=>$restriction->id
                ]);
            }
        }
    }

    public function testLogin() 
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
            ->withSession(['in' => 'out'])
            ->visit('/home')
            ->see('Welcome to Snackr!');
    }

    public function testLogout() 
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
            ->withSession(['in' => 'out'])
            ->visit('/home')
            ->click('Logout')
            ->seePageIs('/');
    }
}
