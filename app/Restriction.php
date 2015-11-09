<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restriction extends Model
{
    protected $fillable = ['display_name'];

    public function getDisplayName(){
        return $this->display_name;
    }
}
