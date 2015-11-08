<?php 

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use App\Food;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Route;
use App\Http\Requests;

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
			return view('/history');
		} else {
			return 'Please log in!';
		}
	}

	public function index()
	{
		if(Auth::check()) {
			$user = Auth::user();
			$user->getFoodHistory(); 
		}
	}
}