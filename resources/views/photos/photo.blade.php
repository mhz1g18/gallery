@extends('layouts.app')

@section('content')
            <img src="{{ $filepath }}">
            <p> {{ $name }} </p>
            <p> {{ $description }} </p>
            <br />
@endsection('content') 