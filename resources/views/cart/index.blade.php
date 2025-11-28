@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Shopping Cart</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(count($items) > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Book</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $item['book']->title }}</td>
                    <td>${{ number_format($item['book']->price, 2) }}</td>
                    <td class="d-flex align-items-center">
                        <!-- Decrement button -->
                        <form action="{{ route('cart.decrement', $item['book']->id) }}" method="POST" class="me-1">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">-</button>
                        </form>

                        <!-- Quantity display -->
                        <span class="mx-2">{{ $item['quantity'] }}</span>

                        <!-- Increment button -->
                        <form action="{{ route('cart.increment', $item['book']->id) }}" method="POST" class="ms-1">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">+</button>
                        </form>
                    </td>
                    <td>${{ number_format($item['subtotal'], 2) }}</td>
                    <td>
                        <form action="{{ route('cart.remove', $item['book']->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h4>Total: ${{ number_format($total, 2) }}</h4>
        <a href="{{ route('checkout.form') }}" class="btn btn-success">Proceed to Checkout</a>
    @else
        <p>Your cart is empty.</p>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Continue Shopping</a>
    @endif
</div>
@endsection
