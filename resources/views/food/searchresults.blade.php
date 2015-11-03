@extends('app')

@section('content')
    <div class="container">
        <div class="text-center">
            <h3>Food Search</h3>
            @include('food.searchbar')
        </div>
        <br>
        <table class="table">
            <thead>
                <td>Food</td>
                <td>Calories (per 100g)</td>
                <td>Carbohydrates ({{$carbUnits}} per 100g)</td>
                <td>Protein ({{$proteinUnits}} per 100)g</td>
                <td>Fat ({{$fatUnits}} per 100g)</td>
            </thead>
            @foreach($foods as $food)
                <tr>
                    <td>{{$food->getName()}}</td>
                    <td>{{$food->getCalories()}}</td>
                    <td>{{$food->getCarbohydrates()}}</td>
                    <td>{{$food->getProtein()}}</td>
                    <td>{{$food->getFat()}}</td>
                    <td><button class="btn btn-default" type="submit">Eat now</button></td> 
                </tr>
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