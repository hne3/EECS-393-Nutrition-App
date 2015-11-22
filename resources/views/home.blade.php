@extends('app')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <div class="text-center">
                <h2><b>Welcome to Snackr!</b></h2>
                <small><i>Effortless nutrition, every day</i></small>
                <br>
                <br>
                <a class="btn btn-primary" href="{{route('food_search')}}">Start a food search></a>
                <br>
                <br>
                <a class="btn btn-primary" href="{{route('suggestion')}}">Get a food suggestion></a>
                <br>
                <br>
                <img src="img/aubergine.png" class="img-rounded" alt="Welcome to Snackr" width="155" height="236">
            </div>
        </div>
    </div>
@endsection