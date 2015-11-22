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

    public function getFoodSuggestion(){

$foodSuggestion = \DB::select(\DB::raw('
SELECT 
    foods.*, SUM(fn.amount_in_food / rem_nutr.remaining_val) / (2000 / foods.calories) as score
FROM
    foods
        INNER JOIN
    food_nutrient AS fn ON foods.id = fn.food_id
        INNER JOIN   
    (SELECT 
        users.id,
            fn.nutrient_id,
            nutr.daily_value - SUM((quantity * amount_in_food / 100)) AS remaining_val
    FROM
        users
            INNER JOIN 
        user_history AS uh ON users.id = uh.user_id
            INNER JOIN 
        food_nutrient AS fn ON fn.food_id = uh.food_id
            INNER JOIN 
        (SELECT nutrient_id, daily_value
         FROM recommended_values
         WHERE age_range = 2 AND sex = "F") AS nutr ON nutr.nutrient_id = fn.nutrient_id
    WHERE
        timestamp > DATE_SUB(NOW(), INTERVAL 24 HOUR)
            AND 
        users.id = 1
    GROUP BY 
        nutrient_id) AS rem_nutr ON rem_nutr.nutrient_id = fn.nutrient_id 
GROUP BY foods.id order by score DESC, foods.id, fn.nutrient_id;'));

        // $recommended = \DB::table('recommended_values')
        //         ->select('nutrient_id', 'daily_value')
        //         ->where('age_range', '=', 2)        //get user's age range
        //         ->where('sex', '=', 'F');            //get user's gender

        // $user_rec = \DB::table('users')
        //         ->join('user_history as uh', 'users.id', '=', 'uh.user_id')
        //         ->join('food_nutrient as fn', 'fn.food_id', '=', 'uh.food_id')
        //         ->join($recommended->toSql().' as nutr', 'nutr.nutrient_id', '=', 'fn.nutrient_id')
        //         ->select('users.id', 'fn.nutrient_id', 
        //             'nutr.daily_value - SUM((quantity * amount_in_food / 100)) as remaining_val')
        //         ->where('timestamp', '>', 'strtotime(date(Y-m-d) -1 day') 
        //             ->where('users.id', '=', 1)
        //             ->groupBy('nutrient_id');

        // $score = \DB::table('foods')
        //             ->join('food_nutrient as fn', 'foods.id', '=', 'fn.food_id')
        //             ->join($user_rec->toSql().' as rem_nutr', 'rem_nutr.nutrient_id', '=', 'fn.nutrient_id')
        //             ->select('foods.id as food_id', 'foods.name', 
        //                 DB::raw('SUM(fn.amount_in_food/rem_nutr.remaining_val)/(2000/foods.calories) as score'))
        //             ->groupBy('foods.id')
        //             ->groupBy('fn.nutrient_id')
        //             ->orderBy('score', 'desc');
        
        $random = rand(0, 500);
        $foodReturn = Food::where('name', $foodSuggestion[$random]->name)->first();
        return $foodReturn;
    }
}
