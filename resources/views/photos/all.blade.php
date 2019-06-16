@extends('layouts.app')

@section('content')

        @if($posts->isEmpty())
            <p> No images uploaded yet </p>
        @endif

        @foreach($posts as $post)
            <a href="img/{{ $post->id }}"><img src="{{ $post->filepath }}" class="border border-info"></a>
         @endforeach

         {{ $posts->links() }}

@endsection('content') 