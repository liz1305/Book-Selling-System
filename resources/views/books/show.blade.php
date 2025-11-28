@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card neon-card h-100 text-center">
                @if($book->image)
                <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="img-fluid">
            @else
                <img src="{{ asset('images/no-image.png') }}" alt="No Image" class="img-fluid">
            @endif
        </div>
        <div class="col-md-8">
            <h2>{{ $book->title }}</h2>
            <h4>Author: {{ $book->author }}</h4>
            <h5>Price: ${{ number_format($book->price, 2) }}</h5>
            <p>{{ $book->description }}</p>

            <form method="POST" action="{{ route('cart.add') }}">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <button type="submit" class="btn btn-success">Add to Cart</button>
            </form>
        </div>
    </div>
@endsection
</div>
            