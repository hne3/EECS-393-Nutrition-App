@extends('app')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h2>Welcome to Snackr!</h2>

            <a class="btn btn-primary" href="{{route('food_search')}}">Start a food search></a>
            <a class="btn btn-primary" href="{{route('suggestion')}}">Get a food suggestion></a>
    </div>
@endsection
