<html>
  <head>
    <title>Snackr >(E    )</title>
    {!! HTML::style("css/main.css") !!}
  </head>
  <body>
    
    <div id="bar">
      <div id="logo">Snackr</div>

      <div id="usersquare">
        <a href="#">{{ $username }}</a>
      </div>
    </div>

    <div id="content">
      <div id="foodlist-title">Food Eaten Today</div>
      <div id="foodlist">
        @if( isset($foodlist) )
          You ate food today :D
        @else
          No food eaten today!
        @endif
      </div>
    </div>

  </body>
</html>
