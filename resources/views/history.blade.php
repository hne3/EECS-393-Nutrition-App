

@extends('app')

@section('content')
<body onload="init()">
    <div class="container">
        <div id="Tabs">
            <div id="Content_Area">

                <div class="jumbotron">
                    <h2>Your Food History</h2>
                </div>
                <div>
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
                            <td>{{$food->actualCalories}}</td>
                            <td><a href="#" class="btn btn-default" data-toggle="collapse" data-target="#food{{$i}}">View
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
                    </div>

                    <div class="tabContent" id="dailyNutrients">
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