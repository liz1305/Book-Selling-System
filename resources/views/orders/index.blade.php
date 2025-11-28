@extends('layouts.app')

@section('content')
<h2>Orders</h2>

<table class="table">
  <thead><tr><th>ID</th><th>Total</th><th>Status</th><th>Created</th></tr></thead>
  <tbody>
    @foreach($orders as $o)
      <tr>
        <td>{{ $o->id }}</td>
        <td>${{ number_format($o->total,2) }}</td>
        <td>{{ $o->status }}</td>
        <td>{{ $o->created_at }}</td>
      </tr>
    @endforeach
  </tbody>
</table>

{{ $orders->links() }}
@endsection
