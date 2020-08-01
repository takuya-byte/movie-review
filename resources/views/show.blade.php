@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/show.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
  <h1 class='pagetitle'>レビュー詳細ページ</h1>
  <div class="card">
    <div class="card-body d-flex">
      <section class='review-main'>
        <h2 class='h2'></h2>
        <p class='h2 mb20'>{{ $review->title }}</p>
        <h2 class='h2'></h2>
        <p>{!! nl2br(e($review->body)) !!}</p>
      </section>  
      <aside class='review-image'>
@if(!empty($review->image))
        <img class='movie-image' src="{{ asset( $review->image) }}">
@else
        <img class='movie-image' src="{{ asset('images/dummy.png') }}">
@endif
      </aside>
    </div>
    
    <a href="{{ route('index') }}" class='btn btn-info btn-back mb20'>一覧へ</a>
    @if($review->user_id === Auth::id() )
    <div class="text-center">
     {!! Form::model($review, ['route' => ['edit', $review->id], 'method' => 'get']) !!}
        {!! Form::submit('編集', ['class' => 'btn btn-info  mb20']) !!}
    {!! Form::close() !!}
     </div>
     <div class="text-center">
    {!! Form::model($review, ['route' => ['destroy', $review->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
    @endif
    
  </div>
  
</div>
@endsection