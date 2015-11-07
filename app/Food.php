<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    public $timestamps = false;

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

    protected function nutrients()
    {
        return $this->belongsToMany('App\Nutrient')->withPivot('amount_in_food');
    }

    public function addToQueue($queue)
    {
        $queue->insert(this, 0);
    }
    public function flagAsLiked($queue)
    {
        $queue->insert(this, 1);
    }

    public function flagAsDisliked($queue)
    {
        $queue->insert(this, 1);
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
        return $this->nutrients()->whereNutrientId(Nutrient::Caffeine()->getID())->first()->pivot->amount_in_food;
    }

    public function getCaffieneUnits()
    {
        return Nutrient::Caffeine()->getUnits();
    }

    public function getCalcium()
    {
        //Calcium's Nutrient ID is 301
        return $this->nutrients()->whereNutrientId(Nutrient::Calcium()->getID())->first()->pivot->amount_in_food;
    }

    public function getCalciumUnits()
    {
        return Nutrient::Calcium()->getUnits();
    }

    public function getCarbohydrates()
    {
        //Carbohydrates's Nutrient ID is 205
        return $this->nutrients()->whereNutrientId(Nutrient::Carbohydrates()->getID())->first()->pivot->amount_in_food;
    }

    public function getCarbohydratesUnits()
    {
        return Nutrient::Carbohydrates()->getUnits();
    }

    public function getCopper()
    {
        //Copper's Nutrient ID is 213
        return $this->nutrients()->whereNutrientId(Nutrient::Copper()->getID())->first()->pivot->amount_in_food;
    }

    public function getCopperUnits()
    {
        return Nutrient::Copper()->getUnits();
    }

    public function getFat()
    {
        //Fat's Nutrient ID is 204
        return $this->nutrients()->whereNutrientId(Nutrient::Fat()->getID())->first()->pivot->amount_in_food;
    }

    public function getFatUnits()
    {
        return Nutrient::Fat()->getUnits();
    }

    public function getFiber()
    {
        //Fiber's Nutrient ID is 291
        return $this->nutrients()->whereNutrientId(Nutrient::Fiber()->getID())->first()->pivot->amount_in_food;
    }

    public function getFiberUnits()
    {
        return Nutrient::Fiber()->getUnits();
    }

    public function getIron()
    {
        //Iron's Nutrient ID is 303
        return $this->nutrients()->whereNutrientId(Nutrient::Iron()->getID())->first()->pivot->amount_in_food;
    }

    public function getIronUnits()
    {
        return Nutrient::Iron()->getUnits();
    }

    public function getMagnesium()
    {
        //Magnesium's Nutrient ID is 304
        return $this->nutrients()->whereNutrientId(Nutrient::Magnesium()->getID())->first()->pivot->amount_in_food;
    }

    public function getMagnesiumUnits()
    {
        return Nutrient::Magnesium()->getUnits();
    }

    public function getManganese()
    {
        //Manganese's Nutrient ID is 315
        return $this->nutrients()->whereNutrientId(Nutrient::Manganese()->getID())->first()->pivot->amount_in_food;
    }

    public function getManganeseUnits()
    {
        return Nutrient::Manganese()->getUnits();
    }

    public function getPhosphorus()
    {
        //Phosphorus's Nutrient ID is 305
        return $this->nutrients()->whereNutrientId(Nutrient::Phosphorus()->getID())->first()->pivot->amount_in_food;
    }

    public function getPhosphorusUnits()
    {
        return Nutrient::Phosphorus()->getUnits();
    }

    public function getPotassium()
    {
        //Potassium's Nutrient ID is 306
        return $this->nutrients()->whereNutrientId(Nutrient::Potassium()->getID())->first()->pivot->amount_in_food;
    }

    public function getPotassiumUnits()
    {
        return Nutrient::Potassium()->getUnits();
    }

    public function getProtein()
    {
        //Protein's Nutrient ID is 203
        return $this->nutrients()->whereNutrientId(Nutrient::Protein()->getID())->first()->pivot->amount_in_food;
    }

    public function getProteinUnits()
    {
        return Nutrient::Protein()->getUnits();
    }

    public function getSodium()
    {
        //Sodium's Nutrient ID is 307
        return $this->nutrients()->whereNutrientId(Nutrient::Sodium()->getID())->first()->pivot->amount_in_food;
    }

    public function getSodiumUnits()
    {
        return Nutrient::Sodium()->getUnits();
    }

    public function getSugar()
    {
        //Sugar's Nutrient ID is 269
        return $this->nutrients()->whereNutrientId(Nutrient::Sugar()->getID())->first()->pivot->amount_in_food;
    }

    public function getSugarUnits()
    {
        return Nutrient::Sugar()->getUnits();
    }

    public function getVitaminA()
    {
        //VitaminA's Nutrient ID is 320
        return $this->nutrients()->whereNutrientId(Nutrient::VitaminA()->getID())->first()->pivot->amount_in_food;
    }

    public function getVitaminAUnits()
    {
        return Nutrient::VitaminA()->getUnits();
    }

    public function getVitaminB12()
    {
        //VitaminB12's Nutrient ID is 578
        return $this->nutrients()->whereNutrientId(Nutrient::VitaminB12()->getID())->first()->pivot->amount_in_food;
    }

    public function getVitaminB12Units()
    {
        return Nutrient::VitaminB12()->getUnits();
    }

    public function getVitaminB6()
    {
        //VitaminB6's Nutrient ID is 415
        return $this->nutrients()->whereNutrientId(Nutrient::VitaminB6()->getID())->first()->pivot->amount_in_food;
    }

    public function getVitaminB6Units()
    {
        return Nutrient::VitaminB6()->getUnits();
    }

    public function getVitaminC()
    {
        //VitaminC's Nutrient ID is 401
        return $this->nutrients()->whereNutrientId(Nutrient::VitaminC()->getID())->first()->pivot->amount_in_food;
    }

    public function getVitaminCUnits()
    {
        return Nutrient::VitaminC()->getUnits();
    }

    public function getVitaminD()
    {
        //VitaminD's Nutrient ID is 328
        return $this->nutrients()->whereNutrientId(Nutrient::VitaminD()->getID())->first()->pivot->amount_in_food;
    }

    public function getVitaminDUnits()
    {
        return Nutrient::VitaminD()->getUnits();
    }

    public function getVitaminE()
    {
        //VitaminE's Nutrient ID is 323
        return $this->nutrients()->whereNutrientId(Nutrient::VitaminE()->getID())->first()->pivot->amount_in_food;
    }

    public function getVitaminEUnits()
    {
        return Nutrient::VitaminE()->getUnits();
    }

    public function getVitaminK()
    {
        //VitaminK's Nutrient ID is 430
        return $this->nutrients()->whereNutrientId(Nutrient::VitaminK()->getID())->first()->pivot->amount_in_food;
    }

    public function getVitaminKUnits()
    {
        return Nutrient::VitaminK()->getUnits();
    }

    public function getZinc()
    {
        //Zinc's Nutrient ID is 309
        return $this->nutrients()->whereNutrientId(Nutrient::Zinc()->getID())->first()->pivot->amount_in_food;
    }

    public function getZincUnits()
    {
        return Nutrient::Zinc()->getUnits();
    }

}
