@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Login</h2>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="form-control" required>
            @error('email')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="mb-3">
            <input type="password" name="password" placeholder="Password" class="form-control" required>
            @error('password')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        <a href="{{ route('register') }}">Register</a>
    </form>
</div>
@endsection
