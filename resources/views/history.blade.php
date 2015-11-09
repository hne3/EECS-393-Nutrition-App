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
            <td><a href="#" class="btn btn-primary" data-toggle="collapse" data-target="#food{{$i}}">View Details</a>
        </tr>
            <tr>
                <td colspan="5">
                    <div class="accordian-body collapse" id="food{{$i}}">
                        <table class="table">
                            <thead>
                                <td>Caffeine</td>
                                <td>Calcium</td>
                                <td>Carbohydrates</td>
                                <td>Copper</td>
                                <td>Fat</td>
                                <td>Fiber</td>
                                <td>Iron</td>
                                <td>Magnesium</td>
                                <td>Manganese</td>
                                <td>Phosphorus</td>
                                <td>Potassium</td>
                            </thead>
                            <br>
                            <tr>
                                <td>{{$data[$food->id][262]}}</td>
                                <td>{{$data[$food->id][301]}}</td>
                                <td>{{$data[$food->id][205]}}</td>
                                <td>{{$data[$food->id][312]}}</td>
                                <td>{{$data[$food->id][204]}}</td>
                                <td>{{$data[$food->id][291]}}</td>
                                <td>{{$data[$food->id][303]}}</td>
                                <td>{{$data[$food->id][304]}}</td>
                                <td>{{$data[$food->id][315]}}</td>
                                <td>{{$data[$food->id][305]}}</td>
                                <td>{{$data[$food->id][306]}}</td>
                            </tr>
                        </table>
                        <table class="table">
                            <thead>
                                <td>Protein</td>
                                <td>Sodium</td>
                                <td>Sugar</td>
                                <td>Vitamin A</td>
                                <td>Vitambin B12</td>
                                <td>Vitamin B6</td>
                                <td>Vitamin C</td>
                                <td>Vitamin D</td>
                                <td>Vitamin E</td>
                                <td>Vitamin K</td>
                                <td>Zinc</td>
                            </thead>
                            <br>
                            <tr>
                                <td>{{$data[$food->id][203]}}</td>
                                <td>{{$data[$food->id][307]}}</td>
                                <td>{{$data[$food->id][269]}}</td>
                                <td>{{$data[$food->id][320]}}</td>
                                <td>{{$data[$food->id][578]}}</td>
                                <td>{{$data[$food->id][415]}}</td>
                                <td>{{$data[$food->id][401]}}</td>
                                <td>{{$data[$food->id][328]}}</td>
                                <td>{{$data[$food->id][323]}}</td>
                                <td>{{$data[$food->id][430]}}</td>
                                <td>{{$data[$food->id][309]}}</td>
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
                                <th>Nutrient</th>
                                <td>Total amount</td>
                            </thead>
                            <br>
                            <tr>
                                <th>Calories</th>
                                <td>{{$totalCalories}}</td>
                            </tr>
                            <tr>
                                <th>Caffeine</th>
                                <td>{{$total[262]}}</td>
                            </tr>
                            <tr>
                                <th>Caffeine</th>
                                <td>{{$total[262]}}</td>
                            </tr>
                        </table>
                    </div>
                    @endsection
