<?php

use App\Restriction;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;

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
            ->see('Snackr');
    }

    public function testRegister()
    {
        $birthday = new Carbon();
        $birthday->addYear(-23);
        $this->visit('/auth/register')
            ->type('user1', 'name')
            ->type('user1@case.edu', 'email')
            ->type('useruser', 'password')
            ->type('useruser', 'password_confirmation')
            ->type($birthday->toDateTimeString(), 'bdate')
            ->select('1', 'gender')
            ->type('2000', 'daily_calories');
        $map = [];
        $restrictions = Restriction::all();
        foreach ($restrictions as $restriction) {
            $val = round(mt_rand() / mt_getrandmax());
            $map[$restriction->id] = $val;
            $this->type($val + 1, 'restriction' . ($restriction->id + 1));
        }
        $this->press('Register')
            ->seePageIs('/home');

        $this->seeInDatabase('users',
            [
                'name' => 'user1',
                'email' => 'user1@case.edu',
                'bdate' =>  $birthday->toDateString(),
                'gender' => '0',
                'daily_calories' => '2000',
            ]);
        $user = \App\User::whereEmail('user1@case.edu')->first();
        foreach ($restrictions as $restriction) {
            if ($map[$restriction->id] == 1) {
                $this->seeInDatabase('restriction_user', [
                    'user_id' => $user->id,
                    'restriction_id' => $restriction->id
                ]);
            }
        }
    }

    public function testLogin()
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
            ->withSession(['in' => 'out'])
            ->visit('/')
            ->see($user->name);
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
