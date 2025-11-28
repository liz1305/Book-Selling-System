@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Add New Book</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <input type="text" name="title" placeholder="Book Title" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="text" name="author" placeholder="Author" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="number" step="0.01" name="price" placeholder="Price" class="form-control" required>
        </div>
        <div class="mb-3">
            <textarea name="description" placeholder="Description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Add Book</button>
    </form>
</div>
@endsection
