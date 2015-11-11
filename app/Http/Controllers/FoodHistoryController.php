<?php 

namespace App\Http\Controllers;

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
		if(Auth::check()){
			$foodid = Request::get('foodid');
			$food = Food::find($foodid);
			if($food == null){
				return 'Unprocessable Food.';
			}
			$quantity = Request::get('quantity');
			if($quantity == null || $quantity == 0){
				return 'Invalid Quantity.';
			}
			$user = Auth::user();
			$user->addToFoodHistory($food,$quantity);
			return Redirect::route('foodhistory');
		} else {
			return 'Please log in!';
		}
	}

//	Displays individual food history and daily nutritional requirement fulfillment.
	public function index(){
		$user = Auth::user();
		$foods = $user->getFoodHistory();
		$totalCalories = 0;
		$data = [];
		$total = [];
        $nutrients = Nutrient::orderBy('name','ASC')->get();
		$date = date('l/m/d/Y');
		foreach($nutrients as $nutrient){
			$total[$nutrient->id] = 0;
		}
		foreach($foods as $food){
			$actualCalories = ($food->pivot->quantity / 100) * $food->getCalories();
			$food->actualCalories = $actualCalories;
			$totalCalories += $actualCalories;

			$allNutrients = $food->nutrients;
			$foodid = $food->id;
			$quantity = $food->pivot->quantity;
			foreach($allNutrients as $nutrient){
				$data[$foodid][$nutrient->id] = $nutrient->pivot->amount_in_food * ($quantity)/100;
				if(!array_key_exists($nutrient->id,$total)){
					$total[$nutrient->id] = $data[$foodid][$nutrient->id];
				} else {
					$total[$nutrient->id] = $total[$nutrient->id] + $data[$foodid][$nutrient->id];
				}
			}
			$otherNutrients = Nutrient::whereNotIn('id',$food->nutrients()->lists('nutrient_id')->toArray())->get();
			foreach($otherNutrients as $nutrient){
				$data[$foodid][$nutrient->id] = 0;
				$total[$foodid][$nutrient->id] = 0;
			}
		}
		return view('history')->with(compact('foods','totalCalories', 'data', 'total','nutrients', 'date'));
	}
}