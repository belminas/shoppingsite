<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script type="text/javascript" src="Scripts/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="Scripts/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid justify-content-center">
                <div class="row justify-content-center">
                    <div class="col-1">
                        <a class="navbar-brand" href="{{ url('/') }}">
                           <img src="/pics/Logo.webp" alt="Company Logo" style="max-width:50px;">
                       </a>
                   </div>
   
                   <div class="col-8">
                       <form action="/search" method="get" class="d-flex">
                           <input type="search" name="query" class="form-control" placeholder="Search for Post">
                           <button type="submit" class="btn btn-primary btn-custom">Search</button>
                       </form>
                   </div>
   
                   <div class="col-2">
                       <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                           <span class="navbar-toggler-icon"></span>
                       </button>
                </div>

                <div class="row pt-5">
                    <nav class="navbar navbar-expand-lg navbar-light bg-white navbar-center">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item active">
                                    <a class="nav-link" href="/home">Home 
                                        @if(request()->is('home') || request()->is('/'))
                                        <span>(Current)</span>
                                        @endif
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/products">Shop
                                        @if(request()->is('products'))
                                        <span>(Current)</span>
                                        @endif
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/products">About Us
                                        @if(request()->is('about'))
                                        <span>(Current)</span>
                                        @endif
                                    </a>
                                </li>
                                <li class="nav-item d-flex justify-content-center align-items-center"> 
                                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    
                                        <!-- Right Side Of Navbar -->
                                        <ul class="navbar-nav ms-auto">
                                            <!-- Authentication Links -->
                                            @guest
                                                @if (Route::has('login'))
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                                    </li>
                                                @endif
                                    
                                                @if (Route::has('register'))
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                                    </li>
                                                @endif
                                            @else
                                                <!-- Direct link to profile for authenticated users -->
                                                <li class="nav-item profile-hover">
                                                    <a class="nav-link" href="/profile">{{ Auth::user()->name }}</a>
                                                    <div class="logout-link">
                                                        <a href="{{ route('logout') }}"
                                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                            {{ __('Logout') }}
                                                        </a>
                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                            @csrf
                                                        </form>
                                                    </div>
                                                </li>
                                            @endguest
                                        </ul>
                                    </div>
                                    @if(request()->is('profile'))
                                     <span>(current)</span>
                                    @endif
                                </li>
                                <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#cartModal">
                                    <i class="fas fa-shopping-cart"></i>
                                </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </nav>
        <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cartModalLabel">Cart Contents</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Cart items will be dynamically inserted here -->
                        @php
                            $totalPrice = 0;
                        @endphp
                        @if(session('cart') && count(session('cart')) > 0)
                            <ul class="list-group">
                                @foreach(session('cart') as $id => $details)
                                    @php
                                        $totalPrice += $details['quantity'] * $details['price'];
                                    @endphp
                                    <li class="list-group-item">
                                        {{ $details['title'] }} - {{ $details['quantity'] }} x ${{ $details['price'] }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>Your cart is empty.</p>
                        @endif
                    </div>
                    <div class="modal-footer">
                        @if($totalPrice > 0)
                        <p>Total: ${{ $totalPrice }}</p>
                        @endif
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="{{ route('cart.index') }}" class="btn btn-primary">View Full Cart</a>
                    </div>
                </div>
            </div>
        </div>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
