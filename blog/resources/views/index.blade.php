@extends('layout')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <h1>Your Lifehacks</h1>
    </div>
    <br>


    <!-- will be used to show any messages -->
    @if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Description</td>
                <td>User</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>


            @foreach($lifehacks as $key => $value)
            @if(Auth::user()->isAdmin == '1')

            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->description }}</td>
                <td>{{ $value->user }}</td>


                <!-- we will also add show, edit, and delete buttons -->
                <td>



                    <!-- delete the life hack (uses the destroy method DESTROY /lifehacks/{id} -->
                    <!-- we will add this later since its a little more complicated than the other two buttons -->

                    {{ Form::open(array('url' => 'lifehacks/' . $value->id, 'class' => 'pull-right')) }}

                    <!-- show the life hack (uses the show method found at GET /lifehacks/{id} -->
                    <a class="btn btn-small btn-success" href="{{ URL::to('lifehacks/' . $value->id) }}">View</a>

                    <!-- edit this lifehack (uses the edit method found at GET /lifehacks/{id}/edit -->
                    <a class="btn btn-small btn-info" href="{{ URL::to('lifehacks/' . $value->id . '/edit') }}">Edit</a>

                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete', array('class' => 'btn btn-warning', 'onclick'=> "return confirm('Are you sure you want to delete this lifehack permanently?')")) }}
                    {{ Form::close() }}


                </td>
            </tr>
            @elseif(Auth::user()->name == $value->user)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->description }}</td>
                <td>{{ $value->user }}</td>


                <!-- we will also add show, edit, and delete buttons -->
                <td>



                    <!-- delete the life hack (uses the destroy method DESTROY /lifehacks/{id} -->
                    <!-- we will add this later since its a little more complicated than the other two buttons -->

                    {{ Form::open(array('url' => 'lifehacks/' . $value->id, 'class' => 'pull-right')) }}

                    <!-- show the life hack (uses the show method found at GET /lifehacks/{id} -->
                    <a class="btn btn-small btn-success" href="{{ URL::to('lifehacks/' . $value->id) }}">View</a>

                    <!-- edit this lifehack (uses the edit method found at GET /lifehacks/{id}/edit -->
                    <a class="btn btn-small btn-info" href="{{ URL::to('lifehacks/' . $value->id . '/edit') }}">Edit</a>

                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
                    {{ Form::close() }}


                </td>
            </tr>
            @endif
            @endforeach

        </tbody>
    </table>
    <a href="{{ URL::to('/lifehacks/create') }}" class="btn btn-primary">Add Life hack</a>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
@if(Auth::user()->isAdmin == '1')
{
<div align="center">
    <a href="{{ URL::to('index/export/') }}" class="btn btn-success">Export Users to Excel</a>
</div>
}
@endif
@endsection