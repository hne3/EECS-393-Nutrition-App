<?php

namespace App\Http\Controllers;

use App\Nutrient;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Food;
use Illuminate\Support\Facades\Auth;

class FoodSearchController extends Controller
{
    /**
     * Directs you to either the initial search page or to the search results page depending on get parameters
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $method = $request->get('method');
        $sort = $request->get('sort');
        $query = $request->get('q');
        $useRestrictions = $request->get('restrictions');
        if($useRestrictions == null) {
            $useRestrictions = 1;
        }
        if($query == null){
            return view('food.index')->with(compact('method','query','useRestrictions','sort'));
        } else {
            $foods = null;
            $restrictions = [];
            if($useRestrictions == 0){
                Food::ObeyRestrictions(false);
            } else if(Auth::check()){
                $user = Auth::user();
                $restrictions = $user->getRestrictions();
            }
            if($method == 'similar'){
                $foods = Food::getNameSimilarTo($query,$restrictions);
            } else if ($method == 'search'){
                $foods = Food::SearchByName($query,$restrictions);
            } else if ($method == 'name'){
                $foods = Food::GetByName($query,$restrictions);
            } else {
                $foods = Food::SearchByName($query,$restrictions);
            }

            if($sort == 'cal'){
                $foods = $foods->sortBy('calories');
            } else if($sort == 'sugar') {
                  $foods = $foods->sortBy(function ($food) {
                      return $food->getSugar();
                  });
            } else if($sort == 'fat') {
                  $foods = $foods->sortBy(function ($food) {
                      return $food->getFat();
                  });
            }


            return view('food.searchresults')->with(compact('foods','method','query','useRestrictions','sort'));
        }
    }
}
