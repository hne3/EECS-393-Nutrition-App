@extends('app')

@section('content')
<body onload="init()">
  <div class="container">
    <div id="Tabs">
      <div id="Content_Area">

        <div>
          <br>
          <h2>Your Food History</h2>
          <br>
          <ul id="tabs">
            <li><a href="#individualFoods">Individual Foods</a></li>
            <li><a href="#dailyNutrients">Daily Nutrients</a></li>
          </ul>
        </div>

        <br>

        <div class="tabContent" id="individualFoods">
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
              <td>{{$food->actualCalories}} kcal</td>
              <td><a href="#" class="btn btn-default" data-toggle="collapse" data-target="#food{{$i}}">View
                Details</a>
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

          <div class="tabContent" id="dailyNutrients">
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
            </div>
          </div>
        </div>
        <br><br><br>
      </div>
    </body>
    @endsection


    <style type="text/css">
    ul#tabs { list-style-type: none; margin: 20px 0 0 0; padding: 0 0 -10px 0; }
    ul#tabs li { display: inline; }
    ul#tabs li a { color: #d3d3d3; background-color: #ffffff; border: 1px solid #c9c3ba; padding: 0.3em; text-decoration: none; }
    ul#tabs li a:hover { background-color: #f1f0ee; }
    ul#tabs li a.selected { color: #000; background-color: #f1f0ee; font-weight: bold;}
    div.tabContent { border: 0 0 10px 0 solid #c9c3ba; padding: 0.5em; background-color: #f1f0ee;}
    div.tabContent.hide { display: none; }
    </style>

    <script type="text/javascript">
    var tabLinks = new Array();
    var contentDivs = new Array();

    function init() {

      // Grab the tab links and content divs from the page
      var tabListItems = document.getElementById('tabs').childNodes;
      for ( var i = 0; i < tabListItems.length; i++ ) {
        if ( tabListItems[i].nodeName == "LI" ) {
          var tabLink = getFirstChildWithTagName( tabListItems[i], 'A' );
          var id = getHash( tabLink.getAttribute('href') );
          tabLinks[id] = tabLink;
          contentDivs[id] = document.getElementById( id );
      }
  }

      // Assign onclick events to the tab links, and
      // highlight the first tab
      var i = 0;

      for ( var id in tabLinks ) {
        tabLinks[id].onclick = showTab;
        tabLinks[id].onfocus = function() { this.blur() };
        if ( i == 0 ) tabLinks[id].className = 'selected';
        i++;
    }

      // Hide all content divs except the first
      var i = 0;

      for ( var id in contentDivs ) {
        if ( i != 0 ) contentDivs[id].className = 'tabContent hide';
        i++;
    }
}

function showTab() {
  var selectedId = getHash( this.getAttribute('href') );

      // Highlight the selected tab, and dim all others.
      // Also show the selected content div, and hide all others.
      for ( var id in contentDivs ) {
        if ( id == selectedId ) {
          tabLinks[id].className = 'selected';
          contentDivs[id].className = 'tabContent';
      } else {
          tabLinks[id].className = '';
          contentDivs[id].className = 'tabContent hide';
      }
  }

      // Stop the browser following the link
      return false;
  }

  function getFirstChildWithTagName( element, tagName ) {
      for ( var i = 0; i < element.childNodes.length; i++ ) {
        if ( element.childNodes[i].nodeName == tagName ) return element.childNodes[i];
    }
}

function getHash( url ) {
  var hashPos = url.lastIndexOf ( '#' );
  return url.substring( hashPos + 1 );
}
    </script>