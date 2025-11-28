@extends('layouts.app')

@section('content')
<div class="container mt-4">

    @auth
        <div class="mb-3">
            <a href="{{ route('books.create') }}" class="btn btn-success">Add New Book</a>
        </div>
    @endauth

    <div class="row">
        @foreach($books as $book)
        <div class="col-md-3 mb-4">
            <div class="card neon-card h-100 text-center">
                @if($book->image)
                    <img src="{{ asset('storage/' . $book->image) }}" class="card-img-top" alt="{{ $book->title }}">
                @endif
                <div class="card-body">
                    <h5 class="card-title neon-text">{{ $book->title }}</h5>
                    <p class="card-text neon-text">${{ number_format($book->price, 2) }}</p>
                    <a href="{{ route('books.show', $book->id) }}" class="btn neon-button btn-sm">View</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        {{ $books->links('pagination::bootstrap-5') }}
    </div>


</div>
@endsection
