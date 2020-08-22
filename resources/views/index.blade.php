@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/top.css') }}" rel="stylesheet">
@endsection

@section('content')
@include('search')
<div class="row justify-content-center">
    @foreach($reviews as $review)
    <div class="col-md-4">
        <div class="card mb50">
            
            
            @if (Auth::check())
                @if (Auth::id() != $review->user_id)

            
                
                  @if (Auth::user()->is_favorite($review->id))
                        {!! Form::open(['route' => ['favorites.unfavorite', $review->id], 'method' => 'delete']) !!}
                        {!! Form::submit('いいね！を外す', ['class' => "button btn btn-warning"]) !!}
                        {!! Form::close() !!}
                        

                 @else

                        {!! Form::open(['route' => ['favorites.favorite', $review->id]]) !!}
                        {!! Form::submit('いいね！を付ける', ['class' => "button btn btn-success"]) !!}
                        {!! Form::close() !!}

               @endif
                @endif

            @endif
            <p>投稿者 <strong>{{$review->user->name}}</strong></p>
            <div class="card-body">
                @if(!empty($review->image))
              <div class='image-wrapper'><img class='movie-image' src="{{ asset( $review->image) }}"></div>
          @else
                <div class='image-wrapper'><img class='movie-image' src="{{ asset('images/dummy.png') }}"></div>
                 @endif
                <h3 class='h3 movie-title'>{{ $review->title }}</h3
                
                <p class='description'>
                    {!! nl2br(e($review->body)) !!}
                </p>
                <a href="{{ route('show', ['id' => $review->id ]) }}" class='btn btn-secondary detail-btn'>詳細を読む</a>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{ $reviews->links() }}

@endsection