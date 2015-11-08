@extends('app')

@section('content')
<div class="container">
    <div class="jumbotron">
        <h2>Your Food History</h2>
    </div>
    <br>
    <table class="table">
        <thead>
            <td>Date</td>
            <td>Quantity</td>
            <td>Food</td>
            <td>Calories (per 100g)</td>
        </thead>
        <br>
        @foreach($user as $users)
        <tr>
            <td>{{$user->getDateTime()}}</td>
            <td>{{$user->getQuantity()}}</td> 
            <td>{{$user->getFoodName()}}</td>
            <td>{{$user->getCalories()}}</td>
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
