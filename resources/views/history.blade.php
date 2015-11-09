@extends('app')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h2>Your Food History</h2>
        </div>
        <br>
<!--        <table>
        	<thead>
        		<td>Date</td>
        		<td>Food</td>
        		<td>Calories (per 100g)</td>
        		<td>Carbohydrates ({{$cardUnits}} per 100g)</td>
        		<td>Protein ({{$proteinUnits}} per 100g)</td>
        		<td>Fat ({{$fatUnits}} per 100g)</td>
	       	</thead>
        		<tr>
        			<td>{{$user_history->getDate()}}</td>
        			<td>{{$user_history->getFood()}}</td>
                    <td>{{$food->getCalories()}}</td>
                    <td>{{$food->getCarbohydrates()}}</td>
                    <td>{{$food->getProtein()}}</td>
                    <td>{{$food->getFat()}}</td>
        		</tr>
        </table>-->
    </div>
@endsection