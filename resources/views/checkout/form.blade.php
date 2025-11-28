@extends('layouts.app')

@section('content')
<h2>Checkout</h2>

<form method="POST" action="{{ route('checkout.place') }}">
  @csrf
  <div class="mb-3">
    <label>Full name</label>
    <input name="fullname" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Address line 1</label>
    <input name="line1" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Address line 2</label>
    <input name="line2" class="form-control">
  </div>
  <div class="mb-3">
    <label>City</label>
    <input name="city" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>State</label>
    <input name="state" class="form-control">
  </div>
  <div class="mb-3">
    <label>Postal code</label>
    <input name="postal_code" class="form-control">
  </div>
  <div class="mb-3">
    <label>Country</label>
    <input name="country" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Phone</label>
    <input name="phone" class="form-control">
  </div>

  <button class="btn btn-success">Place Order</button>
</form>
@endsection
