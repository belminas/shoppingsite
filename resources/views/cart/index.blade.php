@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Cart</h1>
    @if(!empty($cart) && count($cart) > 0)
        @php $totalPrice = 0; @endphp
        <div class="row">
            @foreach ($cart as $id => $item)
                @php
                $subtotal = $item['price'] * $item['quantity'];
                $totalPrice += $subtotal;
                @endphp
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $item['image']) }}" class="card-img-top zoom-in-effect p-5" alt="{{ $item['title'] }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item['title'] }}</h5>
                            <p class="card-text">Price: ${{ number_format($item['price'], 2) }} x {{ $item['quantity'] }} = ${{ number_format($subtotal, 2) }}</p>
                            <a href="{{ route('cart.remove', $id) }}" class="btn btn-danger">Remove</a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-12">
                <h4>Total: ${{ number_format($totalPrice, 2) }}</h4>
            </div>
        </div>
        <div class="col-12 mb-3">
            <form action="{{ route('cart.confirmPurchase') }}" method="POST">
                @csrf <!-- CSRF token for security -->
                <button type="submit" class="btn btn-success">Confirm Purchase</button>
            </form>
        </div>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection
