@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h1>{{ $lifehack->name }} Lifehack</h1>
    </div>
    <br>
    <div class="jumbotron text-center">
        <h3> {{ $lifehack->description }}</h3>
    </div>

    <div class="jumbotron text-center">
        <img src="{{ asset('/uploads/images/' . $lifehack->image)}}" style="height: 500px"/>
    </div>
</div>

@endsection