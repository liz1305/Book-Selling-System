@extends('layouts.app')

@section('content')
<h2>Sell a Book</h2>

<form method="POST" action="{{ route('seller.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label>Title</label>
        <input name="title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Author</label>
        <input name="author" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Price</label>
        <input name="price" class="form-control" type="number" step="0.01" required>
    </div>
    <div class="mb-3">
        <label>Condition</label>
        <select name="condition" class="form-control" required>
            <option value="new">New</option>
            <option value="used">Used</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Image</label>
        <input type="file" name="image" class="form-control">
    </div>
    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control"></textarea>
    </div>
    <button class="btn btn-primary">List Book</button>
</form>
@endsection
