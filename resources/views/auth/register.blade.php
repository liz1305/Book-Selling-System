@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Register</h2>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="mb-3">
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Name" class="form-control" required>
            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="mb-3">
            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="form-control" required>
            @error('email')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="mb-3">
            <input type="password" name="password" placeholder="Password" class="form-control" required>
            @error('password')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="mb-3">
            <input type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Register</button>
        <a href="{{ route('login') }}">Login</a>
    </form>
</div>
@endsection
