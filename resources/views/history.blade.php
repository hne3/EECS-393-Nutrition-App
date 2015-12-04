@extends('app')

@section('content')
<body>
  <div class="container-fluid">

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
            <li role="presentation">
              <a href="#graphs" aria-controls="graphs" role="tab" data-toggle="tab" style="color:black" onclick="setTimeout(
              function(){
              lava.charts.LineChart.Calories.redraw();
              lava.charts.LineChart['Sugar and Fat'].redraw();
              lava.charts.LineChart.Minerals.redraw();
              lava.charts.LineChart.Vitamins.redraw();},2);">
                Graphs</a></li>
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
                    <td>Your Rating</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    </thead>
                    <br>
                    <?php $i = 0;?>
                    @foreach($foods as $food)
                        <tr>
                            <td>{{\Carbon\Carbon::Parse($food->pivot->timestamp)->setTimeZone("EST")->toDayDateTimeString()}}</td>
                            <td><a data-toggle="collapse" data-target="#food{{$i}}"
                                   style="color:black; text-decoration:none">{{$food->getName()}}</td>
                            <td>{{$food->pivot->quantity}} g</td>
                            <td>{{$food->actualCalories}} kcal</td>
                            <td>{{$food->pivot->rating}}</td>
                            <td></td>
                            <td></td>
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
              <td><table class="table">
                <thead>               
                  <th>Nutrient</th>
                  @for($a = 5; $a > 1; $a--)
                    <th>{{$a}} days ago</th>
                  @endfor
                  <th>1 day ago</th>
                  <th>Today</th>
                </thead>
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
                </table></td> <!-- ends left table -->

                <td><table class="table">
                  <thead>
                    <th>Recommended</th>
                  </thead>
                  <tr><td>{{$vals->getRecommendedCalories()}} kcal</td></tr>
                  <tr><td>{{$vals->getRecommendedCaffeine()}} mg</td></tr>
                  <tr><td>{{$vals->getRecommendedCalcium()}} mg</td></tr>
                  <tr><td>{{$vals->getRecommendedCarbohydrates()}} g</td></tr>
                  <tr><td>{{$vals->getRecommendedCopper()}} mg</td></tr>
                  <tr><td>{{$vals->getRecommendedFat()}} g</td></tr>
                  <tr><td>{{$vals->getRecommendedFiber()}} g</td></tr>
                  <tr><td>{{$vals->getRecommendedIron()}} mg</td></tr>
                  <tr><td>{{$vals->getRecommendedMagnesium()}} mg</td></tr>
                  <tr><td>{{$vals->getRecommendedManganese()}} mg</td></tr>
                  <tr><td>{{$vals->getRecommendedPhosphorus()}} mg</td></tr>
                  <tr><td>{{$vals->getRecommendedPotassium()}} mg</td></tr>
                  <tr><td>{{$vals->getRecommendedProtein()}} g</td></tr>
                  <tr><td>{{$vals->getRecommendedSodium()}} mg</td></tr>  
                  <tr><td>{{$vals->getRecommendedSugar()}} g</td></tr>
                  <tr><td>{{$vals->getRecommendedVitaminA()}} ug</td></tr>
                  <tr><td>{{$vals->getRecommendedVitaminB12()}} ug</td></tr>
                  <tr><td>{{$vals->getRecommendedVitaminB6()}} mg</td></tr>
                  <tr><td>{{$vals->getRecommendedVitaminC()}} mg</td></tr>
                  <tr><td>{{$vals->getRecommendedVitaminD()}} ug</td></tr>
                  <tr><td>{{$vals->getRecommendedVitaminE()}} mg</td></tr>
                  <tr><td>{{$vals->getRecommendedVitaminK()}} ug</td></tr>
                  <tr><td>{{$vals->getRecommendedZinc()}} mg</td></tr>
                </table></td> <!-- ends right table -->

              </table> <!-- ends entire table -->
            </div> <!--ends daily nutrients tabpanel-->

            <div role="tabpanel" class="tab-pane" id="graphs">
              <div id="calories_div" align="center" style="height:400px; width: 950px; padding-left: 0px">
              <?php 
                $calChart = \Lava::LineChart('Calories')
                          ->dataTable($caloriesG)
                          ->title('Percent of Daily Calories Fulfilled');
                for($a = 4; $a >= 1; $a--) 
                  $caloriesG ->addRow(array(($a+1).' days ago', $previousTotalCalories[$a] * 100/$dailyCalories));
                $caloriesG ->addRow(array('1 day ago', $previousTotalCalories[0] * 100/$dailyCalories));
                $caloriesG ->addRow(array('Today', $todayTotalCalories * 100/$dailyCalories));
                echo \Lava::render('LineChart', 'Calories', 'calories_div'); ?>
              </div>

                <div id="sugarfat_div" align="center" style="height:400px; width: 950px; padding-left: 0px">
                <?php
                  $sfChart = \Lava::LineChart('Sugar and Fat')
                           ->dataTable($sugarFatG)
                           ->title('Sugar and Fat');
                  for($a = 4; $a >= 1; $a--)
                    $sugarFatG ->addRow(array(($a+1).' days ago', $previousNutrientTotals[269][$a], $previousNutrientTotals[204][$a]));
                  $sugarFatG ->addRow(array('1 day ago', $previousNutrientTotals[269][0], $previousNutrientTotals[204][0]));
                  $sugarFatG ->addRow(array('Today', $todayNutrientTotals[269], $todayNutrientTotals[204]));
                  echo \Lava::render('LineChart', 'Sugar and Fat', 'sugarfat_div');
                ?></div>

                <div id="minerals_div" align="center" style="height:400px; width: 950px; padding-left: 0px">
                <?php
                  $mineralsChart = \Lava::LineChart('Minerals')
                                 ->dataTable($mineralsG)
                                 ->title('Percent of Daily Minerals Fulfilled');
                  for($a = 4; $a >= 1; $a--)
                    $mineralsG ->addRow(array(($a+1).' days ago', 
                      $previousNutrientTotals[301][$a] * 100/$vals->getRecommendedCalcium(),
                      $previousNutrientTotals[312][$a] * 100/$vals->getRecommendedCopper(),
                      $previousNutrientTotals[303][$a] * 100/$vals->getRecommendedIron(),
                      $previousNutrientTotals[304][$a] * 100/$vals->getRecommendedMagnesium(),
                      $previousNutrientTotals[315][$a] * 100/$vals->getRecommendedManganese(),
                      $previousNutrientTotals[305][$a] * 100/$vals->getRecommendedPhosphorus(),
                      $previousNutrientTotals[306][$a] * 100/$vals->getRecommendedPotassium(),
                      $previousNutrientTotals[307][$a] * 100/$vals->getRecommendedSodium(),
                      $previousNutrientTotals[309][$a] * 100/$vals->getRecommendedZinc()));
                  $mineralsG ->addRow(array('1 day ago', 
                      $previousNutrientTotals[301][0] * 100/$vals->getRecommendedCalcium(),
                      $previousNutrientTotals[312][0] * 100/$vals->getRecommendedCopper(),
                      $previousNutrientTotals[303][0] * 100/$vals->getRecommendedIron(),
                      $previousNutrientTotals[304][0] * 100/$vals->getRecommendedMagnesium(),
                      $previousNutrientTotals[315][0] * 100/$vals->getRecommendedManganese(),
                      $previousNutrientTotals[305][0] * 100/$vals->getRecommendedPhosphorus(),
                      $previousNutrientTotals[306][0] * 100/$vals->getRecommendedPotassium(),
                      $previousNutrientTotals[307][0] * 100/$vals->getRecommendedSodium(),
                      $previousNutrientTotals[309][0] * 100/$vals->getRecommendedZinc()));
                  $mineralsG ->addRow(array('Today', 
                      $todayNutrientTotals[301] * 100/$vals->getRecommendedCalcium(),
                      $todayNutrientTotals[312] * 100/$vals->getRecommendedCopper(),
                      $todayNutrientTotals[303] * 100/$vals->getRecommendedIron(),
                      $todayNutrientTotals[304] * 100/$vals->getRecommendedMagnesium(),
                      $todayNutrientTotals[315] * 100/$vals->getRecommendedManganese(),
                      $todayNutrientTotals[305] * 100/$vals->getRecommendedPhosphorus(),
                      $todayNutrientTotals[306] * 100/$vals->getRecommendedPotassium(),
                      $todayNutrientTotals[307] * 100/$vals->getRecommendedSodium(),
                      $todayNutrientTotals[309] * 100/$vals->getRecommendedZinc()));
                  echo \Lava::render('LineChart', 'Minerals', 'minerals_div');
                ?></div>

                <div id="vitamins_div" align="center" style="height:400px; width: 950px; padding-left: 0px">
                <?php
                  $vitaminsChart = \Lava::LineChart('Vitamins')
                                 ->dataTable($vitaminsG)
                                 ->title('Percent of Daily Vitamins Fulfilled');
                  for($a = 4; $a >= 1; $a--)
                    $vitaminsG ->addRow(array(($a+1).' days ago', 
                      $previousNutrientTotals[320][$a] * 100/$vals->getRecommendedVitaminA(),
                      $previousNutrientTotals[578][$a] * 100/$vals->getRecommendedVitaminB12(),
                      $previousNutrientTotals[415][$a] * 100/$vals->getRecommendedVitaminB6(),
                      $previousNutrientTotals[401][$a] * 100/$vals->getRecommendedVitaminC(),
                      $previousNutrientTotals[328][$a] * 100/$vals->getRecommendedVitaminD(),
                      $previousNutrientTotals[323][$a] * 100/$vals->getRecommendedVitaminE(),
                      $previousNutrientTotals[430][$a] * 100/$vals->getRecommendedVitaminK()));
                  $vitaminsG ->addRow(array('1 day ago', 
                      $previousNutrientTotals[320][0] * 100/$vals->getRecommendedVitaminA(),
                      $previousNutrientTotals[578][0] * 100/$vals->getRecommendedVitaminB12(),
                      $previousNutrientTotals[415][0] * 100/$vals->getRecommendedVitaminB6(),
                      $previousNutrientTotals[401][0] * 100/$vals->getRecommendedVitaminC(),
                      $previousNutrientTotals[328][0] * 100/$vals->getRecommendedVitaminD(),
                      $previousNutrientTotals[323][0] * 100/$vals->getRecommendedVitaminE(),
                      $previousNutrientTotals[430][0] * 100/$vals->getRecommendedVitaminK()));
                  $vitaminsG ->addRow(array('Today', 
                      $todayNutrientTotals[320] * 100/$vals->getRecommendedVitaminA(),
                      $todayNutrientTotals[578] * 100/$vals->getRecommendedVitaminB12(),
                      $todayNutrientTotals[415] * 100/$vals->getRecommendedVitaminB6(),
                      $todayNutrientTotals[401] * 100/$vals->getRecommendedVitaminC(),
                      $todayNutrientTotals[328] * 100/$vals->getRecommendedVitaminD(),
                      $todayNutrientTotals[323] * 100/$vals->getRecommendedVitaminE(),
                      $todayNutrientTotals[430] * 100/$vals->getRecommendedVitaminK()));
                  echo \Lava::render('LineChart', 'Vitamins', 'vitamins_div');
                ?></div>
            </div> <!--ends graph tabpanel-->
            </div> <!--ends tab-content-->
        </div>
        <br><br><br>
    </body>
@endsection



    