@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="text-center">
            <h3>Food Suggestion</h3>
        </div>
        <br><br>
        <table class="table">
            <thead>
            <td><b>Food</td>
            <td><b>Calories (per 100g)</td>
            <td><b>Eat</td>
            <td></td>
            </thead>
            <br>
                <tr>
                    <td>{{$food->getName()}}</td>
                    <td>{{$food->getCalories()}} kcal</td>
                    <td>
                        {!! Form::open(['route'=>'addFood','method'=>'POST', 'class'=>'form-inline']) !!}
                        {!! Form::hidden('foodid',$food->id)!!}
                        {!! Form::select('rating', array('1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5'), 1,['class'=>'form-control', 'id'=>'rating']) !!}
                        {!! Form::text('quantity', null, ['class'=>'form-control','required', 'id'=>'qu', 'placeholder'=>'grams', 'style'=>'width:70px']) !!}
                    
                    <button class="btn btn-default" type="submit" value="addToFoodHistory">
                        Eat now</button>{!! Form::close() !!}</td>
                </tr>
                <tr>
                    <td colspan="5">
                    <table class="table">
                        <thead>
                                <td><b>Caffeine</b></td>
                                <td><b>Calcium</b></td>
                                <td><b>Carbohydrates</b></td>
                                <td><b>Copper</b></td>
                                <td><b>Fat</b></td>
                                <td><b>Fiber</b></td>
                                <td><b>Iron</b></td>
                                <td><b>Magnesium</b></td>
                                <td><b>Manganese</b></td>
                                <td><b>Phosphorus</b></td>
                                <td><b>Potassium</b></td>
                        </thead>
                        <tr>
                                <td>{{$food->getCaffeine()}} mg</td>
                                <td>{{$food->getCalcium()}} mg</td>
                                <td>{{$food->getCarbohydrates()}} g</td>
                                <td>{{$food->getCopper()}}</td>
                                <td>{{$food->getFat()}} g</td>
                                <td>{{$food->getFiber()}} g</td>
                                <td>{{$food->getIron()}} mg</td>
                                <td>{{$food->getMagnesium()}} mg</td>
                                <td>{{$food->getManganese()}} mg</td>
                                <td>{{$food->getPhosphorus()}} mg</td>
                                <td>{{$food->getPotassium()}} mg</td>
                        </tr>
                        <br>
                        <thead>
                                <td><b>Protein</b></td>
                                <td><b>Sodium</b></td>
                                <td><b>Sugar</b></td>
                                <td><b>Vitamin A</b></td>
                                <td><b>Vitamin B12</b></td>
                                <td><b>Vitamin B6</b></td>
                                <td><b>Vitamin C</b></td>
                                <td><b>Vitamin D</b></td>
                                <td><b>Vitamin E</b></td>
                                <td><b>Vitamin K</b></td>
                                <td><b>Zinc</b></td>
                        </thead>
                        <tr>
                                <td>{{$food->getProtein()}} g</td>
                                <td>{{$food->getSodium()}} mg</td>
                                <td>{{$food->getSugar()}} g</td>
                                <td>{{$food->getVitaminA()}} ug</td>
                                <td>{{$food->getVitaminB12()}} ug</td>
                                <td>{{$food->getVitaminB6()}} mg</td>
                                <td>{{$food->getVitaminC()}} mg</td>
                                <td>{{$food->getVitaminD()}} ug</td>
                                <td>{{$food->getVitaminE()}} mg</td>
                                <td>{{$food->getVitaminK()}} ug</td>
                                <td>{{$food->getZinc()}} mg</td>
                        </tr>
                    </table>
                </td>
        </table>
        <table class="table">
            <thead>
            <td>

            </td>
            </thead>
        </table>
        <div style="text-align:center">
        <a class="btn btn-snackr" href="{{route('suggestion')}}">Get another suggestion</a>
        </div> 
    </div>
@endsection