<?php
/**
 * Created by PhpStorm.
 * User: LauraTheGreat
 * Date: 10/20/2015
 * Time: 1:59 PM
 */

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class RecommendedValue extends Model
{
    public static function GetRecommendedValues(User $user)
    {
        $age = Carbon::Parse($user->bdate)->diffInYears();
        $ageRange = AgeRange::where('min_age','<=',$age)->where('max_age','>=',$age)->first();
        $gender = ($user->gender == 0)?'M':'F';
        $results = RecommendedValue::where('age_range',$ageRange->id)->where('sex',$gender)->select('nutrient_id','daily_value','upper_limit')->get();
        return new RecommendedValues($results->toArray());
    }
}

class RecommendedValues
{
    private $dailyInfo = [];
    private $upperLimits = [];

    /**
     * RecommendedValues constructor.
     * @param $data
     */
    public function __construct($data)
    {
        foreach($data as $r){
            $this->dailyInfo[$r['nutrient_id']] = $r['daily_value'];
            $upperlimit = $r['upper_limit'];
            if($upperlimit == 10000){
                $upperlimit = null;
            }
            $this->upperLimits[$r['nutrient_id']] = $upperlimit;
        }
        //Validation
        foreach(Nutrient::all() as $nr){
            assert(array_key_exists($nr->id,$this->dailyInfo));
            assert(array_key_exists($nr->id,$this->upperLimits));
        }
    }

    public function getRecommendedCalories()
    {
        //Unknown how calorie data is stored.
        return null;
    }

    public function getRecommendedProtein()
    {
        return $this->dailyInfo[203];
    }

    public function getRecommendedFat()
    {
        return $this->dailyInfo[204];
    }

    public function getRecommendedCarbohydrates()
    {
        return $this->dailyInfo[205];
    }

    public function getRecommendedCaffeine()
    {
        return $this->dailyInfo[262];
    }

    public function getRecommendedSugar()
    {
        return $this->dailyInfo[269];
    }

    public function getRecommendedFiber()
    {
        return $this->dailyInfo[291];
    }

    public function getRecommendedCalcium()
    {
        return $this->dailyInfo[301];
    }

    public function getRecommendedIron()
    {
        return $this->dailyInfo[303];
    }

    public function getRecommendedMagnesium()
    {
        return $this->dailyInfo[304];
    }

    public function getRecommendedPhosphorus()
    {
        return $this->dailyInfo[305];
    }

    public function getRecommendedPotassium()
    {
        return $this->dailyInfo[306];
    }

    public function getRecommendedSodium()
    {
        return $this->dailyInfo[307];
    }

    public function getRecommendedZinc()
    {
        return $this->dailyInfo[309];
    }

    public function getRecommendedCopper()
    {
        return $this->dailyInfo[312];
    }

    public function getRecommendedManganese()
    {
        return $this->dailyInfo[315];
    }

    public function getRecommendedVitaminA()
    {
        return $this->dailyInfo[320];
    }

    public function getRecommendedVitaminE()
    {
        return $this->dailyInfo[323];
    }

    public function getRecommendedVitaminD()
    {
        return $this->dailyInfo[328];
    }

    public function getRecommendedVitaminC()
    {
        return $this->dailyInfo[401];
    }

    public function getRecommendedVitaminB6()
    {
        return $this->dailyInfo[415];
    }

    public function getRecommendedVitaminK()
    {
        return $this->dailyInfo[430];
    }

    public function getRecommendedVitaminB12()
    {
        return $this->dailyInfo[578];
    }

    public function getUpperLimitProtein()
    {
        return $this->upperLimits[203];
    }

    public function getUpperLimitFat()
    {
        return $this->upperLimits[204];
    }

    public function getUpperLimitCarbohydrates()
    {
        return $this->upperLimits[205];
    }

    public function getUpperLimitCaffeine()
    {
        return $this->upperLimits[262];
    }

    public function getUpperLimitSugar()
    {
        return $this->upperLimits[269];
    }

    public function getUpperLimitFiber()
    {
        return $this->upperLimits[291];
    }

    public function getUpperLimitCalcium()
    {
        return $this->upperLimits[301];
    }

    public function getUpperLimitIron()
    {
        return $this->upperLimits[303];
    }

    public function getUpperLimitMagnesium()
    {
        return $this->upperLimits[304];
    }

    public function getUpperLimitPhosphorus()
    {
        return $this->upperLimits[305];
    }

    public function getUpperLimitPotassium()
    {
        return $this->upperLimits[306];
    }

    public function getUpperLimitSodium()
    {
        return $this->upperLimits[307];
    }

    public function getUpperLimitZinc()
    {
        return $this->upperLimits[309];
    }

    public function getUpperLimitCopper()
    {
        return $this->upperLimits[312];
    }

    public function getUpperLimitManganese()
    {
        return $this->upperLimits[315];
    }

    public function getUpperLimitVitaminA()
    {
        return $this->upperLimits[320];
    }

    public function getUpperLimitVitaminE()
    {
        return $this->upperLimits[323];
    }

    public function getUpperLimitVitaminD()
    {
        return $this->upperLimits[328];
    }

    public function getUpperLimitVitaminC()
    {
        return $this->upperLimits[401];
    }

    public function getUpperLimitVitaminB6()
    {
        return $this->upperLimits[415];
    }

    public function getUpperLimitVitaminK()
    {
        return $this->upperLimits[430];
    }

    public function getUpperLimitVitaminB12()
    {
        return $this->upperLimits[578];
    }

}