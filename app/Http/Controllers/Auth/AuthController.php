<?php

namespace App\Http\Controllers\Auth;

use App\Restriction;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use ThrottlesLogins, AuthenticatesAndRegistersUsers;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'bdate'=>'required|date',
            'gender'=>'required|integer|in:0,1',
            'daily_calories'=>'required|integer|min:0',
        ];
        $customMessages = [];
        foreach(Restriction::all() as $restr){
            $rules['restriction'.$restr->id] = "required|integer|in:0,1";
            $customMessages['restriction'.$restr->id.'.required'] = "A response to the ".$restr->display_name.' dietary restriction is required.';
        }

        return Validator::make($data, $rules,$customMessages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $dCopy = $data;
        $data = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'bdate' => $data['bdate'],
            'gender' => $data['gender'],
            'daily_calories' => $data['daily_calories'],
        ];
        $user = User::create($data);
        $restrictions = Restriction::all();
        //cannot eat(0); can eat(1)
        foreach($restrictions as $restr){
            if($dCopy['restriction'.$restr->id] == 1){
                $user->addRestriction($restr);
            }
        }
        return $user;
    }

    protected $redirectPath = '/home';
}
