<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Food;


class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    private $prefQueue;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'bdate', 'gender', 'weight', 'height', 'nuts', 'seafood', 'dairy', 'chocolate'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public static function InitUserQueue()
    {
        $prefQueue = new \SplPriorityQueue();
        return $prefQueue;
    }

    private function history(){
        return $this->belongsToMany('App\Food','user_history')->withPivot('timestamp','quantity', 'rating');
    }

    public function addToFoodHistory(Food $food, $quantity, $rating){
        $time = new Carbon();
        
        $this->history()->save($food,['timestamp'=>$time,'quantity'=>$quantity, 'rating'=>$rating]);
    }

    public function getFoodHistory(){
        return $this->history()->orderBy('timestamp','ASC')->get();
    }

    public function addRestriction(Restriction $r){
        $this->restrictions()->save($r);
    }

    public function getRestrictions(){
        return $this->restrictions()->get();
    }

    public function restrictions(){
        return $this->belongsToMany('App\Restriction');
    }

    public function canEatFood(Food $f){
        foreach($this->getRestrictions() as $restriction){
            if($f->isRestricted($restriction)){
                return false;
            }
        }
        return true;
    }
}
