@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="row pt-5 pb-5">
        <a class="btn btn-primary btn-custom" href="/products/create" style="max-width:20%">New Product</a>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card profile-card">
                <div class="card-header">
                    Welcome, {{ $user->name }}
                </div>
                <div class="card-body">
                    <h5 class="card-title">Profile Details</h5>
                    <p class="card-text">
                        <strong>First Name:</strong> {{ $user->first_name }} <br>
                        <strong>Last Name:</strong> {{ $user->last_name }} <br>
                        <strong>Email:</strong> {{ $user->email }} <br>
                        <strong>Country:</strong> {{ $user->country }} <br>
                        <strong>City:</strong> {{ $user->city }} <br>
                        <strong>Postal Code:</strong> {{ $user->postalcode }} <br>
                        <strong>Address:</strong> {{ $user->address }}
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card history-card">
                <div class="card-header">
                    Order History
                </div>
                <div class="card-body">
                    <h5 class="card-title">Recent Orders</h5>
                    <p class="card-text">Here you can view the history of your orders.</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Order #1234 - <strong>Status:</strong> Shipped</li>
                        <li class="list-group-item">Order #1235 - <strong>Status:</strong> Delivered</li>
                        <li class="list-group-item">Order #1236 - <strong>Status:</strong> Processing</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection