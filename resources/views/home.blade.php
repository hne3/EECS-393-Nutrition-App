@extends('app')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <div class="text-center">
                <img src="img/altlogo.png" class="img-rounded" alt="Welcome to Snackr" width="700">
                <br>
                <img src="img/subtext.png" class="img-rounded" alt="Welcome to Snackr" width="450">
                <br>
                <br>
                <a class="btn btn-snackr" href="{{route('food_search')}}">Start a food search></a>
                <br>
                <br>
                <a class="btn btn-snackr" href="{{route('suggestion')}}">Get a food suggestion></a>
                <br>
                <br>
                <img src="img/aubergine.png" class="img-rounded" alt="Welcome to Snackr" width="155" height="236">
            </div>
        </div>
    </div>
@endsection

