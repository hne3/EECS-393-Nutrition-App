<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nutrient extends Model
{
    public $timestamps = false;
    public function foods()
    {
        return $this->belongsToMany('App\Nutrient')->withPivot('amount_in_food');
    }
}
