<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nutrient extends Model
{
    public $timestamps = false;

    protected function foods()
    {
        return $this->belongsToMany('App\Food')->withPivot('amount_in_food');
    }

    public function getFoods()
    {
        return $this->foods()->where('amount_in_food', '>', 0)->get();
    }

    public function getUnits()
    {
        return $this->unit;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->getName();
    }

    public static function Protein()
    {
        return static::find(203);
    }

    public static function Fat()
    {
        return static::find(204);
    }

    public static function Carbohydrates()
    {
        return static::find(205);
    }

    public static function Caffeine()
    {
        return static::find(262);
    }

    public static function Sugar()
    {
        return static::find(269);
    }

    public static function Fiber()
    {
        return static::find(291);
    }

    public static function Calcium()
    {
        return static::find(301);
    }

    public static function Iron()
    {
        return static::find(303);
    }

    public static function Magnesium()
    {
        return static::find(304);
    }

    public static function Phosphorus()
    {
        return static::find(305);
    }

    public static function Potassium()
    {
        return static::find(306);
    }

    public static function Sodium()
    {
        return static::find(307);
    }

    public static function Zinc()
    {
        return static::find(309);
    }

    public static function Copper()
    {
        return static::find(312);
    }

    public static function Manganese()
    {
        return static::find(315);
    }

    public static function VitaminA()
    {
        return static::find(320);
    }

    public static function VitaminE()
    {
        return static::find(323);
    }

    public static function VitaminD()
    {
        return static::find(328);
    }

    public static function VitaminC()
    {
        return static::find(401);
    }

    public static function VitaminB6()
    {
        return static::find(415);
    }

    public static function VitaminK()
    {
        return static::find(430);
    }

    public static function VitaminB12()
    {
        return static::find(578);
    }


}
