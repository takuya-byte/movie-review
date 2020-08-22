@extends('layouts.app')



@section('content')
<a href="{{ route('users.show', ['id' => Auth::id() ]) }}">レビューした作品一覧を見る</a>


<h1>{{$user->name}}のイイネしたレビュー</h1>


@foreach($reviews as $review)

<p><a href="{{ route('show', ['id' => $review->id ]) }}">{{$review->title}}</a></p>

@endforeach



@endsection