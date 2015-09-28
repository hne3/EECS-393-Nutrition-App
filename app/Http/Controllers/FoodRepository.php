<?php

namespace App\Http\Controllers;

use App\Food;
use Illuminate\Support\Facades\DB;

class FoodRepository extends Controller {

    public function saveFood(){
        $food = NutritionAPI::Food()->get();
        dd($food);
        DB::beginTransaction();
        foreach($food as $f){
            $model = new Food();
            $model->id = $f['id'];
            $model->name = $f['name'];
            $model->save();
        }
        DB::commit();
    }
}