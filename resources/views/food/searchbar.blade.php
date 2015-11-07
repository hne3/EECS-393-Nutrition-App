{!! Form::open(['route'=>'food_search','method'=>'GET']) !!}
<div class="form-group">
    <div class="col-sm-9">
        <div class="input-group">
            {!! Form::text('q', $query, ['class'=>'form-control','placeholder'=>'Enter a food name']) !!}
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit">Go!</button>
            </span>
        </div>
    </div>
    <div class="col-sm-3">
        {!! Form::select('method',['search'=>'Prefix Search','name'=>'Exact Name Search','similar'=>'Similar Name Search'],$method,['class'=>'form-control']) !!}
    </div>
</div>
{!! Form::close() !!}