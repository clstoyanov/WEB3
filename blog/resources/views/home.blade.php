@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h1>Profile</h1>
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            @if (auth()->user()->image)
            <img src="{{ asset(auth()->user()->image) }}" style="width: 100px; height: 100px; border-radius: 0%; margin-left: +330px; margin-bottom: +20">
            @endif
            <br></br>
            <br></br>

            <form action="{{ route('home.update') }}" method="POST" role="form" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name', auth()->user()->name) }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                    <div class="col-md-6">
                        <input id="email" type="text" class="form-control" name="email" value="{{ old('email', auth()->user()->email) }}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="profile_image" class="col-md-4 col-form-label text-md-right">Profile Image</label>
                    <div class="col-md-6">
                        <input id="profile_image" type="file" class="form-control" name="profile_image">
                        @if (auth()->user()->image)
                        <code>{{ auth()->user()->image }}</code>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="created at" class="col-md-4 col-form-label text-md-right">Created on</label>
                    <div class="col-md-6">
                        <input id="date_created" type="text" class="form-control" name="date_created" value="{{Auth::user()->created_at->format('D dS M Y')}}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="created at" class="col-md-4 col-form-label text-md-right">Last updated at</label>
                    <div class="col-md-6">
                        <input id="date_updated" type="text" class="form-control" name="date_updated" value="{{Auth::user()->updated_at->format('D dS M Y H:i')}}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                    </div>
                </div>
                <div class="form-group row mb-0 mt-5">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </div>
                </div>
            </form>

            <form action="{{ route('home.delete') }}" method="POST">
                <div class="form-group row mb-0 mt-5">
                    <div class="col-md-8 offset-md-4">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE" />
                        <button type="submit" onclick="return confirm('Are you sure you want to delete your account permanently?')" class="btn btn-danger">Delete Account</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br><br>
</div>
@endsection