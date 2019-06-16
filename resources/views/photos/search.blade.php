@extends('layouts.app')

@section('content')


<form action="/search" method="POST" role="search">
    {{ csrf_field() }}
    <div class="input-group">
        <input type="text" class="form-control" name="byAuthor"
            placeholder="Search by username">
    </div>
</form>

<form action="/search" method="POST" role="search">
    {{ csrf_field() }}
    <div class="input-group">
        <input type="text" class="form-control" name="byCategory"
            placeholder="Search by category">
         <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
                Search
            </button>
        </span>
    </div>
</form>


@isset($posts)
    <div>
            @if($posts->isEmpty())
                <p> No results found </p>
            @endif

            @foreach($posts as $post)
                <a href="img/{{ $post->id }}"><img src="{{ $post->filepath }}"></a>
                <p> {{ $post->title }} </p>
                <p> {{ $post->category }} </p>
                <br />
            @endforeach
    </div>
@endisset



@endsection('content') 