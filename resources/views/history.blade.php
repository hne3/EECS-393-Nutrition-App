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
                <td>Food
        @foreach($user as $users)
            {{$user->getFoodHistory()}};
        @endforeach
    </div>
@endsection
