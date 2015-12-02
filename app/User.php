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
    protected $fillable = ['name', 'email', 'password', 'bdate', 'gender', 'daily_calories'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

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
        $age = Carbon::Parse($this->bdate)->diffInYears();
        $ageRange = AgeRange::where('min_age','<=',$age)->where('max_age','>=',$age)->first();
        $gender = ($this->gender == 1)?'F':'M';
        if($this->getFoodHistory()->first() == null){
            $foodSuggestion = \DB::select(\DB::raw('
SELECT 
    foods.*, SUM(fn.amount_in_food / rem_nutr.remaining_val) / (2000 / foods.calories) as score
FROM
    foods
        INNER JOIN
    food_nutrient AS fn ON foods.id = fn.food_id
        INNER JOIN   
    (SELECT 
        users.id, daily_value AS remaining_val, nutrient_id
    FROM
        users
            INNER JOIN 
        recommended_values
    WHERE
        users.id = '.$this->id.' 
            AND 
        recommended_values.age_range = '.$ageRange->id.' AND recommended_values.sex = \''.$gender.'\'
    GROUP BY 
        nutrient_id) AS rem_nutr ON rem_nutr.nutrient_id = fn.nutrient_id  and foods.id not in (select food_id from food_restriction as fr inner join restriction_user as ru on ru.restriction_id = fr.restriction_id where user_id = \'.$this->id.\')
GROUP BY foods.id order by score DESC, foods.id, fn.nutrient_id;'));
        }
        else {
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
         WHERE age_range = '.$ageRange->id.' AND sex = \''.$gender.'\') AS nutr ON nutr.nutrient_id = fn.nutrient_id
    WHERE
        timestamp > DATE_SUB(NOW(), INTERVAL 24 HOUR)
            AND 
        users.id = '.$this->id.'
    GROUP BY 
        nutrient_id) AS rem_nutr ON rem_nutr.nutrient_id = fn.nutrient_id  and foods.id not in (select food_id from food_restriction as fr inner join restriction_user as ru on ru.restriction_id = fr.restriction_id where user_id = \'.$this->id.\')
GROUP BY foods.id order by score DESC, foods.id, fn.nutrient_id;'));
        }

        $random = rand(0, 200);
        $foodReturn = Food::where('name', $foodSuggestion[$random]->name)->first();
        return $foodReturn;
    }
}
