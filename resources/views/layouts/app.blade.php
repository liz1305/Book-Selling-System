<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Book Selling System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">Book Selling System</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('books.index') }}">Books</a>
        </li>
        <li class="nav-item">
          <a class="nav-link position-relative" href="{{ route('cart.index') }}">
            🛒 Cart
            @if($cartCount > 0)
              <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                {{ $cartCount }}
              </span>
            @endif
          </a>
        </li>
        @auth
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-link nav-link">Logout</button>
            </form>
        </li>
    @else
        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
    @endauth
      </ul>
    </div>
  </div>
</nav>


<div class="container">
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

    @yield('content')
</div>
</body>
</html>
