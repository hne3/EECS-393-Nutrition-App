@extends('app')

@section('content')
    <div class="container">
        <div class="text-center">
            <h3>Food Search</h3><p></p>
            @include('food.searchbar')
        </div>
        <br><br>
        <table class="table">
            <thead>
                <td><b>Food (100 g)</td>
                <td><b>Calories</td><td></td>
                <td><b>Quantity</td>
                <td></td>
            </thead>
            <?php $i = 0;?>
            @foreach($foods as $food)
                <tr>
                    <td><a href="#" data-toggle="collapse" data-target="#food{{$i}}" style="color:black; text-decoration:none">{{$food->getName()}}</a></td>
                    <td>{{$food->getCalories()}} kcal</td><td></td>
                    <td>
                        {!! Form::open(['route'=>'addFood','method'=>'POST']) !!}
                        {!! Form::hidden('foodid',$food->id)!!}
                        {!! Form::text('quantity', null, ['class'=>'form-control','required', 'id'=>'qu', 'placeholder'=>'grams']) !!}
                        <style>#qu{width:70px; height:20px;}</style></td> 
                    <td><button class="btn btn-default btn-xs" type="submit" value="addToFoodHistory">
                        Eat now</button>{!! Form::close() !!}</td> 
                </tr>
                <tr>
                    <td colspan="7">
                    <div class="accordian-body collapse" id="food{{$i}}">
                    <table class="table" style="background-color:#f6f6f6">
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
                    </div>
                    </td>
                </tr>
                <?php $i++; ?>
            @endforeach
        </table>

        <table class="table">
            <thead>
                <td>

                </td>
            </thead>
        </table>
    </div>
@endsection