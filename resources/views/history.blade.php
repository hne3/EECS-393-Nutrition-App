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
            <td>Calories</td>
            <td>Details</td>
            </thead>
            <br>
            <?php $i = 0;?>
            @foreach($foods as $food)
                <tr>
                    <td>{{\Carbon\Carbon::Parse($food->pivot->timestamp)->toDayDateTimeString()}}</td>
                    <td>{{$food->pivot->quantity}}</td>
                    <td>{{$food->getName()}}</td>
                    <td>{{$food->actualCalories}}</td>
                    <td><a href="#" class="btn btn-primary" data-toggle="collapse" data-target="#food{{$i}}">View
                            Details</a>
                </tr>
                <tr>
                    <td colspan="5">
                        <div class="accordian-body collapse" id="food{{$i}}">
                            @foreach($nutrients->chunk(11) as $chunk)
                                <table class="table table-responsive">
                                    <thead>
                                    @foreach($chunk as $nutrient)
                                        <th>{{$nutrient->name}}</th>
                                    @endforeach
                                    </thead>
                                    <tr>
                                    @foreach($chunk as $nutrient)
                                        <td>{{$total[$nutrient->id]}}</td>
                                    @endforeach
                                    </tr>
                                </table>
                            @endforeach
                        </div>
                    </td>
                </tr>
                <?php $i++; ?>
            @endforeach
        </table>

        <table class="table">
            <thead>
            <th>Nutrient</th>
            <td>Total amount</td>
            </thead>
            <br>
            <tr>
                <td>Calories</td>
                <td>{{$totalCalories}}</td>
            </tr>
            @foreach($nutrients as $nutrient)
                <tr>
                    <td>{{$nutrient->name}}</td>
                    <td>{{$total[$nutrient->id]}} {{$nutrient->getUnits()}}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
