@extends('layout')

@section('content')
<div class="container">

    <h1>Edit {{ $lifehack->name }}</h1>

    <!-- if there are creation errors, they will show here -->
    {{ HTML::ul($errors->all()) }}

    {{ Form::model($lifehack, array('route' => array('lifehacks.update', $lifehack->id), 'method' => 'put', 'files' => true)) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('description', 'Description') }}
        {{ Form::text('description', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('image', 'Image') }}
        <br>
        {{ Form::file('image', null, array('class' => 'form-control')) }}
    </div>
    <br></br>

    {{ Form::submit('Update!', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>
@endsection