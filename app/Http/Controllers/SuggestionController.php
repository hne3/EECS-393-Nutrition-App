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

class SuggestionController extends Controller
{
    /**
     * Directs you to either the initial search page or to the search results page depending on get parameters
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $food = $user->getFoodSuggestion();
        return view('suggestion.index')->with(compact('food'));
    }
}
