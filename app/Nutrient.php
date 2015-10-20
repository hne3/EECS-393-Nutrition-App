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
        return $this->foods()->where('amount_in_food','>',0)->get();
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
}
