<?php

namespace App\Http\Controllers;

use App\Nutrient;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Food;

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
        $query = $request->get('q');
        if($query == null){
            return view('food.index')->with(compact('method','query'));
        } else {
            $foods = null;
            $carbUnits = Nutrient::Carbohydrates()->getUnits();
            $proteinUnits = Nutrient::Protein()->getUnits();
            $fatUnits = Nutrient::Fat()->getUnits();
            if($method == 'similar'){
                $foods = Food::getNameSimilarTo($query);
            } else if ($method == 'search'){
                $foods = Food::SearchByName($query);
            } else if ($method == 'name'){
                $foods = Food::GetByName($query);
            } else {
                $foods = Food::SearchByName($query);
            }
            return view('food.searchresults')->with(compact('foods','method','query','fatUnits','carbUnits','proteinUnits'));
        }
    }

}
