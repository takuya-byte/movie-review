@extends('layouts.app')



@section('content')
<a href="{{ route('users.favorites', ['id' => Auth::id() ]) }}">イイネした作品一覧を見る</a>


<h1>{{$user->name}}のレビュー作品</h1>

@foreach($reviews as $review)

<p><a href="{{ route('show', ['id' => $review->id ]) }}">{{$review->title}}</a></p>

@endforeach



@endsection