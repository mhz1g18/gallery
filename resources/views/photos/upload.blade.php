@extends('layouts.app')

@section('content')

@if (Auth::guest())
    <script>window.location.replace("../login");</script> 
@endif

<div class="container">

   

    <div class="panel panel-primary">

      <div class="panel-heading"><h2>Upload an image</h2></div>

      <div class="panel-body">

        @if ($message = Session::get('success'))

        <div class="alert alert-success alert-block">

            <button type="button" class="close" data-dismiss="alert">×</button>

                <strong>{{ $message }}</strong>

        </div>

        <img src="images/{{ Session::get('image') }}">

        @endif

  

        @if (count($errors) > 0)

            <div class="alert alert-danger">

                <strong>Whoops!</strong> There were some problems with your input.

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

  

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="row">

                <div class="col-md-6">

                    <input type="file" name="image" class="form-control">

                    <p> Name </p>
                    <input type="text" name="name" class="form-control">

                    <p> Description </p>
                    <input type="text" name="description" class="form-control">

                    <p> Category </p>
                    <input type="text" name="category" class="form-control">

                    <button type="submit" class="btn btn-success">Upload</button>

                </div>

   

            </div>

        </form>

  

      </div>

    </div>

</div>
@endsection
