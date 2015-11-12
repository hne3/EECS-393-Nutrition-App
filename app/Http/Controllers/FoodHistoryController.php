<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Redirector;
use App\Http\Controllers\Controller;
use App\Food;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Route;
use App\Nutrient;

class FoodHistoryController extends Controller
{
    public function addFood()
    {
        if (Auth::check()) {
            $foodid = Request::get('foodid');
            $food = Food::find($foodid);
            if ($food == null) {
                return 'Unprocessable Food.';
            }
            $quantity = Request::get('quantity');
            if ($quantity == null || $quantity == 0) {
                return 'Invalid Quantity.';
            }
            $rating = Request::get('rating');
            $user = Auth::user();
            $user->addToFoodHistory($food, $quantity, $rating);
            return Redirect::route('foodhistory');
        } else {
            return 'Please log in!';
        }
    }

    public function index()
    {
        $user = Auth::user();
        $foods = $user->getFoodHistory();
        $nutrients = Nutrient::orderBy('name', 'ASC')->get();
        $data = [];

        //for calculating individual food nutrient values scaled by quantity
        foreach($foods as $food) {
            $allNutrients1 = $food->nutrients;
            $foodid1 = $food->id;
            $quantity1 = $food->pivot->quantity;
            foreach($allNutrients1 as $nutrient) {
                $data[$foodid1][$nutrient->id] = $nutrient->pivot->amount_in_food * ($quantity1)/100;
            }
            $otherNutrients = Nutrient::whereNotIn('id', $food->nutrients()->lists('nutrient_id')->toArray())->get();
            foreach($otherNutrients as $nutrient)
                $data[$foodid1][$nutrient->id] = 0;
        }       

        //for calculating daily total
        $todayTotalCalories = 0;
        $todayData = [];
        $todayNutrientTotals = [];

        $numDays = 5;

        //Index these arrays by $dayNumber - 1 (so that 1 day ago is in index 0), $nutrient->id
        $previousTotalCalories = [];
        $previousNutrientTotals = [];

        foreach ($nutrients as $nutrient) {
            $todayNutrientTotals[$nutrient->id] = 0;
            $previousNutrientTotals[$nutrient->id] = array_pad([], $numDays, 0); 
            $previousTotalCalories = array_pad([],$numDays,0);
        }
        foreach ($foods as $food) {
            $daysSinceEaten = Carbon::Parse($food->pivot->timestamp)->diffInDays();
            $actualCalories = ($food->pivot->quantity / 100) * $food->getCalories();
            $food->actualCalories = $actualCalories;
            if ($daysSinceEaten == 0) {
                //We ate this today - it goes in a separate thing
                $todayTotalCalories += $actualCalories;
                $allNutrients = $food->nutrients;
                $foodid = $food->id;
                $quantity = $food->pivot->quantity;
                foreach ($allNutrients as $nutrient) {
                    $todayData[$foodid][$nutrient->id] = $nutrient->pivot->amount_in_food * ($quantity) / 100;
                    if (!array_key_exists($nutrient->id, $todayNutrientTotals)) {
                        $todayNutrientTotals[$nutrient->id] = $todayData[$foodid][$nutrient->id];
                    } else {
                        $todayNutrientTotals[$nutrient->id] = $todayNutrientTotals[$nutrient->id] + $todayData[$foodid][$nutrient->id];
                    }
                }
                $otherNutrients = Nutrient::whereNotIn('id', $food->nutrients()->lists('nutrient_id')->toArray())->get();
                foreach ($otherNutrients as $nutrient) {
                    $todayData[$foodid][$nutrient->id] = 0;
                }
            } else if ($daysSinceEaten <= $numDays) {
                //We want this many days worth of food data aggregated
                $previousTotalCalories[$daysSinceEaten - 1] += $actualCalories;
                $allNutrients = $food->nutrients;
                $quantity = $food->pivot->quantity;
                foreach ($allNutrients as $nutrient) {
                    $actualNutrientValue = $nutrient->pivot->amount_in_food * ($quantity) / 100;
                    $previousNutrientTotals[$nutrient->id][$daysSinceEaten-1] += $actualNutrientValue;
                }
            } else {
                //Ignore this. Ideally, we would filter the query to only return items that fall in the previous two categories.
            }
        }
        return view('history')->with(compact('foods', 'dates', 'todayTotalCalories', 'data', 'total', 'nutrients', 
            'allNutrients1', 'allNutrients', 'todayNutrientTotals', 'previousTotalCalories', 'previousNutrientTotals'));
    }
}