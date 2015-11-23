{!! Form::open(['route'=>'food_search','method'=>'GET']) !!}
<div class="container-fluid">
<div class="form-group">
    <div class="col-sm-7">
        <br>
        <div class="input-group">
            {!! Form::text('q', $query, ['class'=>'form-control','placeholder'=>'Enter a food name']) !!}
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit">Go!</button>
            </span>
        </div>
        <br><br>
    </div>
    <div class="col-sm-2">    
        <br>
        {!! Form::select('method',['search'=>'Prefix Search','name'=>'Exact Name Search','similar'=>'Similar Name Search'],$method,['class'=>'form-control']) !!}
        <br><br>
    </div>
    <div class="col-sm-3">
        <br>
        {!! Form::select('restrictions',['1'=>'Use Dietary Restrictions','0'=>'Ignore Dietary Restrictions'],$useRestrictions,['class'=>'form-control']) !!}
        <br><br>
    </div>
    <div class="col-sm-3">
        <br>
        {!! Form::select('sort',['alpha'=>'Alphabetical','cal'=>'Low to High Calories','sugar'=>'Low to High Sugar','fat'=>'Low to High Fat'],$sort,['class'=>'form-control']) !!}
        <br><br>
    </div>
</div>
</div>
{!! Form::close() !!}