@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <h3 class="text-center">User Info</h3>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Birthdate</label>

                                <div class="col-md-6">
                                    <input type="date" class="form-control" name="bdate" value="{{ old('bdate') }}">
                                </div>
                            </div>

                            <p>{{old('gender')}}</p>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Gender</label>

                                <div class="col-md-6 btn-group" data-toggle="buttons" role="group">
                                    <label class="btn btn-default @if(old('gender') == 0) active @endif">
                                        <input type="radio" role="radio" name="gender" value="0"
                                               @if(old('gender') == 0) checked="checked" @endif>
                                        Male
                                    </label>
                                    <label class="btn btn-default @if(old('gender') == 1) active @endif">
                                        <input type="radio" role="radio" name="gender" value="1"
                                               @if(old('gender') == 1) checked="checked" @endif>
                                        Female
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Daily Calorie Limit (kcal)</label>

                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="daily_calories"
                                           value="{{old('daily_calories')}}">
                                </div>
                            </div>

                            <h3 class="text-center">Dietary Restrictions</h3>

                            <p class="text-center">Do the following dietary restrictions apply to you?</p>

                            @foreach(\App\Restriction::all() as $r)
                                <div class="form-group">
                                    <label class="col-md-4 control-label">{{$r->display_name}}</label>

                                    <div class="col-md-6 btn-group" data-toggle="buttons">
                                        <label class="btn btn-default @if(old('restriction'.$r->id) == 0) active @endif"><input
                                                    type="radio" role="radio " name="restriction{{$r->id}}"
                                                    value="0"
                                                    @if(old('restriction'.$r->id) == 0) checked="checked" @endif>No</label>
                                        <label class="btn btn-default @if(old('restriction'.$r->id) == 1) active @endif"><input
                                                    type="radio" role="radio" name="restriction{{$r->id}}"
                                                    value="1"
                                                    @if(old('restriction'.$r->id) == 1) checked="checked" @endif>Yes</label>
                                    </div>
                                </div>
                            @endforeach
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" value="Register">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
