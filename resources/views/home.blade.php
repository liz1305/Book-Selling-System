@extends('layouts.app')

@section('content')
<h1 class="mb-4">Latest Books</h1>
<div class="row">
@foreach($books as $book)
  <div class="col-md-3 mb-4">
    <div class="card h-100">
      @if($book->image)
        <img src="{{ asset('storage/'.$book->image) }}" class="card-img-top" style="height:200px; object-fit:cover;">
      @else
        <div class="bg-secondary text-white text-center py-5">No Image</div>
      @endif
      <div class="card-body">
        <h5 class="card-title">{{ $book->title }}</h5>
        <p class="card-text text-muted">{{ $book->author }}</p>
        <p><strong>${{ number_format($book->price,2) }}</strong></p>
        <a href="{{ route('books.show', $book) }}" class="btn btn-primary btn-sm">View</a>
      </div>
    </div>
  </div>
@endforeach
</div>
@endsection
