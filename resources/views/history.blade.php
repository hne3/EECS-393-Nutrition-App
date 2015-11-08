@extends('app')

@section('content')

    <div class="container">
        <div class="jumbotron">
            <h2>Your Food History</h2>
        </div>
        <br>
        {!! Form::text(['route'=>'displayHistory', 'method'=>'GET']) !!}
            @foreach($user as $user)
                <tr>
                    <td>{{ $user->index() }}</td>
                </tr>
            @endforeach
        {!! Form::close() !!}
    </div>

@endsection
