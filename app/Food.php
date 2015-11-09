<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    public $timestamps = false;
    public $respectRestrictions = true;

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

    protected function restrictions()
    {
        return $this->belongsToMany('App\Restriction');
    }

    public function addRestriction(Restriction $r)
    {
        $this->restrictions()->attach($r);
    }

    public function removeRestriction(Restriction $r)
    {
        $this->restrictions()->detach($r);
    }

    public function isRestricted(Restriction $r)
    {
        return $this->restrictions()->whereId($r->id)->count() > 0;
    }

    public static function ObeyRestrictions($shouldObey)
    {

    }

    protected function nutrients()
    {
        return $this->belongsToMany('App\Nutrient')->withPivot('amount_in_food');
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

    public function getCaffieneUnits()
    {
        return Nutrient::Caffeine()->getUnits();
    }

    public function getCalciumUnits()
    {
        return Nutrient::Calcium()->getUnits();
    }

    public function getCarbohydratesUnits()
    {
        return Nutrient::Carbohydrates()->getUnits();
    }

    public function getCopperUnits()
    {
        return Nutrient::Copper()->getUnits();
    }

    public function getFatUnits()
    {
        return Nutrient::Fat()->getUnits();
    }

    public function getFiberUnits()
    {
        return Nutrient::Fiber()->getUnits();
    }

    public function getIronUnits()
    {
        return Nutrient::Iron()->getUnits();
    }

    public function getMagnesiumUnits()
    {
        return Nutrient::Magnesium()->getUnits();
    }

    public function getManganeseUnits()
    {
        return Nutrient::Manganese()->getUnits();
    }

    public function getPhosphorusUnits()
    {
        return Nutrient::Phosphorus()->getUnits();
    }

    public function getPotassiumUnits()
    {
        return Nutrient::Potassium()->getUnits();
    }

    public function getProteinUnits()
    {
        return Nutrient::Protein()->getUnits();
    }

    public function getSodiumUnits()
    {
        return Nutrient::Sodium()->getUnits();
    }

    public function getSugarUnits()
    {
        return Nutrient::Sugar()->getUnits();
    }

    public function getVitaminAUnits()
    {
        return Nutrient::VitaminA()->getUnits();
    }

    public function getVitaminB12Units()
    {
        return Nutrient::VitaminB12()->getUnits();
    }

    public function getVitaminB6Units()
    {
        return Nutrient::VitaminB6()->getUnits();
    }

    public function getVitaminCUnits()
    {
        return Nutrient::VitaminC()->getUnits();
    }

    public function getVitaminDUnits()
    {
        return Nutrient::VitaminD()->getUnits();
    }

    public function getVitaminEUnits()
    {
        return Nutrient::VitaminE()->getUnits();
    }

    public function getVitaminKUnits()
    {
        return Nutrient::VitaminK()->getUnits();
    }

    public function getZincUnits()
    {
        return Nutrient::Zinc()->getUnits();
    }

    public function getProtein()
    {
        $nutrient = $this->nutrients()->whereNutrientId(Nutrient::Protein()->getID())->first();
        return ($nutrient != null) ? $nutrient->pivot->amount_in_food : 0;
    }

    public function getFat()
    {
        $nutrient = $this->nutrients()->whereNutrientId(Nutrient::Fat()->getID())->first();
        return ($nutrient != null) ? $nutrient->pivot->amount_in_food : 0;
    }

    public function getCarbohydrates()
    {
        $nutrient = $this->nutrients()->whereNutrientId(Nutrient::Carbohydrates()->getID())->first();
        return ($nutrient != null) ? $nutrient->pivot->amount_in_food : 0;
    }

    public function getCaffeine()
    {
        $nutrient = $this->nutrients()->whereNutrientId(Nutrient::Caffeine()->getID())->first();
        return ($nutrient != null) ? $nutrient->pivot->amount_in_food : 0;
    }

    public function getSugar()
    {
        $nutrient = $this->nutrients()->whereNutrientId(Nutrient::Sugar()->getID())->first();
        return ($nutrient != null) ? $nutrient->pivot->amount_in_food : 0;
    }

    public function getFiber()
    {
        $nutrient = $this->nutrients()->whereNutrientId(Nutrient::Fiber()->getID())->first();
        return ($nutrient != null) ? $nutrient->pivot->amount_in_food : 0;
    }

    public function getCalcium()
    {
        $nutrient = $this->nutrients()->whereNutrientId(Nutrient::Calcium()->getID())->first();
        return ($nutrient != null) ? $nutrient->pivot->amount_in_food : 0;
    }

    public function getIron()
    {
        $nutrient = $this->nutrients()->whereNutrientId(Nutrient::Iron()->getID())->first();
        return ($nutrient != null) ? $nutrient->pivot->amount_in_food : 0;
    }

    public function getMagnesium()
    {
        $nutrient = $this->nutrients()->whereNutrientId(Nutrient::Magnesium()->getID())->first();
        return ($nutrient != null) ? $nutrient->pivot->amount_in_food : 0;
    }

    public function getPhosphorus()
    {
        $nutrient = $this->nutrients()->whereNutrientId(Nutrient::Phosphorus()->getID())->first();
        return ($nutrient != null) ? $nutrient->pivot->amount_in_food : 0;
    }

    public function getPotassium()
    {
        $nutrient = $this->nutrients()->whereNutrientId(Nutrient::Potassium()->getID())->first();
        return ($nutrient != null) ? $nutrient->pivot->amount_in_food : 0;
    }

    public function getSodium()
    {
        $nutrient = $this->nutrients()->whereNutrientId(Nutrient::Sodium()->getID())->first();
        return ($nutrient != null) ? $nutrient->pivot->amount_in_food : 0;
    }

    public function getZinc()
    {
        $nutrient = $this->nutrients()->whereNutrientId(Nutrient::Zinc()->getID())->first();
        return ($nutrient != null) ? $nutrient->pivot->amount_in_food : 0;
    }

    public function getCopper()
    {
        $nutrient = $this->nutrients()->whereNutrientId(Nutrient::Copper()->getID())->first();
        return ($nutrient != null) ? $nutrient->pivot->amount_in_food : 0;
    }

    public function getManganese()
    {
        $nutrient = $this->nutrients()->whereNutrientId(Nutrient::Manganese()->getID())->first();
        return ($nutrient != null) ? $nutrient->pivot->amount_in_food : 0;
    }

    public function getVitaminA()
    {
        $nutrient = $this->nutrients()->whereNutrientId(Nutrient::VitaminA()->getID())->first();
        return ($nutrient != null) ? $nutrient->pivot->amount_in_food : 0;
    }

    public function getVitaminE()
    {
        $nutrient = $this->nutrients()->whereNutrientId(Nutrient::VitaminE()->getID())->first();
        return ($nutrient != null) ? $nutrient->pivot->amount_in_food : 0;
    }

    public function getVitaminD()
    {
        $nutrient = $this->nutrients()->whereNutrientId(Nutrient::VitaminD()->getID())->first();
        return ($nutrient != null) ? $nutrient->pivot->amount_in_food : 0;
    }

    public function getVitaminC()
    {
        $nutrient = $this->nutrients()->whereNutrientId(Nutrient::VitaminC()->getID())->first();
        return ($nutrient != null) ? $nutrient->pivot->amount_in_food : 0;
    }

    public function getVitaminB6()
    {
        $nutrient = $this->nutrients()->whereNutrientId(Nutrient::VitaminB6()->getID())->first();
        return ($nutrient != null) ? $nutrient->pivot->amount_in_food : 0;
    }

    public function getVitaminK()
    {
        $nutrient = $this->nutrients()->whereNutrientId(Nutrient::VitaminK()->getID())->first();
        return ($nutrient != null) ? $nutrient->pivot->amount_in_food : 0;
    }

    public function getVitaminB12()
    {
        $nutrient = $this->nutrients()->whereNutrientId(Nutrient::VitaminB12()->getID())->first();
        return ($nutrient != null) ? $nutrient->pivot->amount_in_food : 0;
    }
}
