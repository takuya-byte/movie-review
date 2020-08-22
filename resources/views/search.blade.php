<div class='container'>

    
{{ Form::open(['method' => 'get']) }}
    {{ csrf_field() }}
    
    <div class='form-group row'>
        
        {{ Form::label('keyword','タイトル名: ',['class' => 'col-sm-2']) }}
        <div class="col-sm-10">
        {{ Form::text('keyword',null,['class' => 'form-control'])}}
        </div>
        
    </div>
     <div class='form-group'>
        {{ Form::submit('検索',['class' =>'btn btn-outline-primary']) }}
        <a href={{ route('index') }}>クリア</a>
    </div>
{{ Form::close() }}
</div>