@extends('layouts.app')

@section('content')
<h1 class='pagetitle'>{{ $review ->name }}編集</h1>

@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    
<div class="row justify-content-center container">
    <div class="col-md-10">
      {!! Form::model($review, ['route' => ['update', $review->id],'enctype'=>'multipart/form-data','method' => 'put']) !!}
      
        <div class="card">
            <div class="card-body">
              <div class="form-group">
                {!! Form::label('title', '映画のタイトル:') !!}
                {!! Form::text('title',null,['class' => 'form-control']) !!}
              </div>
              <div class="form-group">
              {!! Form::label('body', 'レビュー本文') !!}
              {!! Form::textarea('body',null,['class' => 'description form-control']) !!}
              </div>
              <div class="form-group">
              {!! Form::label('image', '映画のサムネイル') !!}
              {!! Form::file('image',null,['class' => 'form-control-file']) !!}
              </div>
              
              {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
      {!! Form::close() !!}
    </div>
</div>
@endsection