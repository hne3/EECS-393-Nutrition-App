@extends('app')

@section('content')
<body onload="init()">
  <div class="container">

        <div>
          <div class="text-center"><h3>Your Food History</div></h3>
          <br>
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
              <a href="#individualFoods" aria-controls="individualFoods" role="tab" data-toggle="tab" style="color:black">
                Individual Foods</a></li>
            <li role="presentation">
              <a href="#dailyNutrients" aria-controls="dailyNutrients" role="tab" data-toggle="tab" style="color:black">
                Daily Nutrients</a></li>
          </ul>
        </div>

        <br>

        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="individualFoods">
          <table class="table">
            <thead>
              <td>Date</td>
              <td>Food</td>
              <td>Quantity</td>
              <td>Calories</td>
              <td></td><td></td>
              <td></td>
            </thead>
            <br>
            <?php $i = 0;?>
            @foreach($foods as $food)
            <tr>
              <td>{{\Carbon\Carbon::Parse($food->pivot->timestamp)->toDayDateTimeString()}}</td>
              <td><a data-toggle="collapse" data-target="#food{{$i}}" 
                style="color:black; text-decoration:none">{{$food->getName()}}</td>
              <td>{{$food->pivot->quantity}} g</td>
              <td>{{$food->actualCalories}} kcal</td>
              <td></td><td></td>
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
                                <td>{{$data[$food->id][262]}} mg</td>
                                <td>{{$data[$food->id][301]}} mg</td>
                                <td>{{$data[$food->id][205]}} g</td>
                                <td>{{$data[$food->id][312]}} mg</td>
                                <td>{{$data[$food->id][204]}} g</td>
                                <td>{{$data[$food->id][291]}} g</td>
                                <td>{{$data[$food->id][303]}} mg</td>
                                <td>{{$data[$food->id][304]}} mg</td>
                                <td>{{$data[$food->id][315]}} mg</td>
                                <td>{{$data[$food->id][305]}} mg</td>
                                <td>{{$data[$food->id][306]}} mg</td>
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
                                <td>{{$data[$food->id][203]}} g</td>
                                <td>{{$data[$food->id][307]}} mg</td>
                                <td>{{$data[$food->id][269]}} g</td>
                                <td>{{$data[$food->id][320]}} ug</td>
                                <td>{{$data[$food->id][578]}} ug</td>
                                <td>{{$data[$food->id][415]}} mg</td>
                                <td>{{$data[$food->id][401]}} mg</td>
                                <td>{{$data[$food->id][328]}} ug</td>
                                <td>{{$data[$food->id][323]}} mg</td>
                                <td>{{$data[$food->id][430]}} ug</td>
                                <td>{{$data[$food->id][309]}} mg</td>
                            </tr>
                        </table>
                      </div>
                    </td>
                  </tr>
              <?php $i++; ?>
              @endforeach
            </table>
          </div> 

            <div role="tabpanel" class="tab-pane" id="dailyNutrients">
            <table class="table">
              <thead>               
                <th>Nutrient</th>
                @for($a = 5; $a > 1; $a--)
                    <th>{{$a}} days ago</th>
                @endfor
                    <th>1 day ago</th>
                    <th>Today</th>
                    </thead>
                    <br>
                    <tr>
                    <td>Calories</td>
                @for($a = 4; $a >= 0; $a--)
                    <td>{{$previousTotalCalories[$a]}} kcal</td>
                @endfor
                    <td>{{$todayTotalCalories}} kcal</td>
                    </tr>
                    <tr>                                
                    @foreach($nutrients as $nutrient)
                    <td>{{$nutrient->name}}</td>
                @for($a = 4; $a >= 0; $a--)
                    <td>{{$previousNutrientTotals[$nutrient->id][$a]}} {{$nutrient->getUnits()}}</td>
                @endfor
                    <td>{{$todayNutrientTotals[$nutrient->id]}} {{$nutrient->getUnits()}}</td>
                    </tr>
                    @endforeach
              </table>
            </div> <!--ends tabpanel-->

            </div> <!--ends tab-content-->
        </div>
        <br><br><br>
    </body>
    @endsection



    