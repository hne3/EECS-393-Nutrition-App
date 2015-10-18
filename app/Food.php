<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    public $timestamps = false;
    private $liked = false;
    private $disliked = false;
    private $score = 0;

    public static function GetByName($name)
    {
        return Food::where('name', $name)->get();
    }

    public static function GetNameSimilarTo($name)
    {
        return Food::where('name', 'LIKE', '%' . $name . '%')->get();
    }

    public static function SearchByName($name)
    {
        return Food::where('name', 'LIKE', $name . '%')->get();
    }

    public static function Recommend()
    {

    }

    protected function nutrients()
    {
        return $this->belongsToMany('App\Nutrient')->withPivot('amount_in_food');
    }


    public function flagAsLiked()
    {
        $GLOBALS['liked'] = true;
        $GLOBALS['disliked'] = false;
        $GLOBALS['score'] += 1;
    }


    public function flagAsDisliked()
    {
        $GLOBALS['liked'] = false;
        $GLOBALS['disliked'] = true;
        $GLOBALS['score'] -= 1;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCalories()
    {
        return $this->calories;
    }

    public function getCaffiene()
    {
        //Caffiene's Nutrient ID is 262
        return $this->nutrients()->whereNutrientId(262)->first()->pivot->amount_in_food;
    }

    public function getCaffieneUnits()
    {
        return Nutrient::find(262)->getUnits();
    }

    public function getCalcium()
    {
        //Calcium's Nutrient ID is 301
        return $this->nutrients()->whereNutrientId(301)->first()->pivot->amount_in_food;
    }

    public function getCalciumUnits()
    {
        return Nutrient::find(301)->getUnits();
    }

    public function getCarbohydrates()
    {
        //Carbohydrates's Nutrient ID is 205
        return $this->nutrients()->whereNutrientId(205)->first()->pivot->amount_in_food;
    }

    public function getCarbohydratesUnits()
    {
        return Nutrient::find(205)->getUnits();
    }

    public function getCopper()
    {
        //Copper's Nutrient ID is 213
        return $this->nutrients()->whereNutrientId(213)->first()->pivot->amount_in_food;
    }

    public function getCopperUnits()
    {
        return Nutrient::find(213)->getUnits();
    }

    public function getFat()
    {
        //Fat's Nutrient ID is 204
        return $this->nutrients()->whereNutrientId(204)->first()->pivot->amount_in_food;
    }

    public function getFatUnits()
    {
        return Nutrient::find(204)->getUnits();
    }

    public function getFiber()
    {
        //Fiber's Nutrient ID is 291
        return $this->nutrients()->whereNutrientId(291)->first()->pivot->amount_in_food;
    }

    public function getFiberUnits()
    {
        return Nutrient::find(291)->getUnits();
    }

    public function getIron()
    {
        //Iron's Nutrient ID is 303
        return $this->nutrients()->whereNutrientId(303)->first()->pivot->amount_in_food;
    }

    public function getIronUnits()
    {
        return Nutrient::find(303)->getUnits();
    }

    public function getMagnesium()
    {
        //Magnesium's Nutrient ID is 304
        return $this->nutrients()->whereNutrientId(304)->first()->pivot->amount_in_food;
    }

    public function getMagnesiumUnits()
    {
        return Nutrient::find(304)->getUnits();
    }

    public function getManganese()
    {
        //Manganese's Nutrient ID is 315
        return $this->nutrients()->whereNutrientId(315)->first()->pivot->amount_in_food;
    }

    public function getManganeseUnits()
    {
        return Nutrient::find(315)->getUnits();
    }

    public function getPhosphorus()
    {
        //Phosphorus's Nutrient ID is 305
        return $this->nutrients()->whereNutrientId(305)->first()->pivot->amount_in_food;
    }

    public function getPhosphorusUnits()
    {
        return Nutrient::find(305)->getUnits();
    }

    public function getPotassium()
    {
        //Potassium's Nutrient ID is 306
        return $this->nutrients()->whereNutrientId(306)->first()->pivot->amount_in_food;
    }

    public function getPotassiumUnits()
    {
        return Nutrient::find(306)->getUnits();
    }

    public function getProtein()
    {
        //Protein's Nutrient ID is 203
        return $this->nutrients()->whereNutrientId(203)->first()->pivot->amount_in_food;
    }

    public function getProteinUnits()
    {
        return Nutrient::find(203)->getUnits();
    }

    public function getSodium()
    {
        //Sodium's Nutrient ID is 307
        return $this->nutrients()->whereNutrientId(307)->first()->pivot->amount_in_food;
    }

    public function getSodiumUnits()
    {
        return Nutrient::find(307)->getUnits();
    }

    public function getSugar()
    {
        //Sugar's Nutrient ID is 269
        return $this->nutrients()->whereNutrientId(269)->first()->pivot->amount_in_food;
    }

    public function getSugarUnits()
    {
        return Nutrient::find(269)->getUnits();
    }

    public function getVitaminA()
    {
        //VitaminA's Nutrient ID is 320
        return $this->nutrients()->whereNutrientId(320)->first()->pivot->amount_in_food;
    }

    public function getVitaminAUnits()
    {
        return Nutrient::find(320)->getUnits();
    }

    public function getVitaminB12()
    {
        //VitaminB12's Nutrient ID is 578
        return $this->nutrients()->whereNutrientId(578)->first()->pivot->amount_in_food;
    }

    public function getVitaminB12Units()
    {
        return Nutrient::find(578)->getUnits();
    }

    public function getVitaminB6()
    {
        //VitaminB6's Nutrient ID is 415
        return $this->nutrients()->whereNutrientId(415)->first()->pivot->amount_in_food;
    }

    public function getVitaminB6Units()
    {
        return Nutrient::find(415)->getUnits();
    }

    public function getVitaminC()
    {
        //VitaminC's Nutrient ID is 401
        return $this->nutrients()->whereNutrientId(401)->first()->pivot->amount_in_food;
    }

    public function getVitaminCUnits()
    {
        return Nutrient::find(401)->getUnits();
    }

    public function getVitaminD()
    {
        //VitaminD's Nutrient ID is 328
        return $this->nutrients()->whereNutrientId(328)->first()->pivot->amount_in_food;
    }

    public function getVitaminDUnits()
    {
        return Nutrient::find(328)->getUnits();
    }

    public function getVitaminE()
    {
        //VitaminE's Nutrient ID is 323
        return $this->nutrients()->whereNutrientId(323)->first()->pivot->amount_in_food;
    }

    public function getVitaminEUnits()
    {
        return Nutrient::find(323)->getUnits();
    }

    public function getVitaminK()
    {
        //VitaminK's Nutrient ID is 430
        return $this->nutrients()->whereNutrientId(430)->first()->pivot->amount_in_food;
    }

    public function getVitaminKUnits()
    {
        return Nutrient::find(430)->getUnits();
    }

    public function getZinc()
    {
        //Zinc's Nutrient ID is 309
        return $this->nutrients()->whereNutrientId(309)->first()->pivot->amount_in_food;
    }

    public function getZincUnits()
    {
        return Nutrient::find(309)->getUnits();
    }

}
