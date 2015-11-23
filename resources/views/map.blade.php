@extends('app')

@section('content')
	<div class="container-fluid" align="center">
		<div class="text-center"><h3>Nearby Food</h3></div><br>
		<iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d11951.724108705379!2d-81.60666360825925!3d41.50576946025207!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sfood!5e0!3m2!1sen!2sus!4v1448144330904" width="900" height="550" frameborder="0" style="border:0" allowfullscreen></iframe>
		<!--<style>
		#map {
			width: 900px;
			height: 500px;
		}
		</style>
		<script src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>
		<script>
     	function initialize() {
        	var mapCanvas = document.getElementById('map');
        	var mapOptions = {
          		center: new google.maps.LatLng(44.5403, -78.5463),
          		zoom: 8,
          		mapTypeId: google.maps.MapTypeId.ROADMAP
        	}
        	var map = new google.maps.Map(mapCanvas, mapOptions)
      	}
      	google.maps.event.addDomListener(window, 'load', initialize);
		</script>-->
		<div id="map"></div>
	</div>

@endsection 