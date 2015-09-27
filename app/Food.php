<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{

    public function nutrients()
    {
        return $this->belongsToMany('App\Nutrient')->withPivot('amount_in_food');
    }
}
