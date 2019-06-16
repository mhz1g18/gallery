@extends('layouts.app')

@section('content')

        <h1 class="display-4" align="center">Last 6 images</h1>

        <div>
        @foreach($posts as $post)
            <a  href="img/{{ $post->id }}" ><img src="{{ $post->filepath }}" class="border border-info"></a>
         @endforeach
        </div>
         
        
       
@endsection('content') 