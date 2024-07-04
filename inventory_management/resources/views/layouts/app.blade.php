<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->

    <link rel="stylesheet" href="{{asset('asset/css/bootstrap.min.css')}}">


    <script src="{{asset('asset/js/bootstrap.bundle.min.js')}}"></script>

    <link rel="stylesheet" href="{{asset('asset/css/style.css')}}">

    <script src="{{asset('asset/js/bootstrap.bundle.min.js')}}"></script>
    
    <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-flags.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-payments.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/demo.min.css') }}" rel="stylesheet" />
</head>
<body>

    <div id="app">

        <nav class="navbar navbar-expand-md navbar-dark bg-hd shadow-sm">

            <div class="container">

                <a class="navbar-brand" href="{{ url('/home') }}">

                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

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
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <!-- <a href=""  onclick="document.getElementById('logout-form').submit();" hidden>

                                {{ __('Logout') }}
                            </a>
                            <form action="{{route('logout')}}" method="post" id="logout-form"> @csrf
                                <input type="submit" value="logout"> -->

                            </form>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div id="menubar">
        <!-- Menu Bar -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="menu">
                        <li class="menu-bar bg-hd"><a class=" menu-hv-1" href="{{route('home')}}">Dashboard</a></li>
                        <li class="menu-bar bg-light"><a class=" menu-hv-2" href="{{route('product')}}">Products</a></li>
                        <li class="menu-bar bg-hd"><a class=" menu-hv-1" href="{{route('order_issue.create')}}">Order issue</a></li>
                        <li class="menu-bar bg-light"><a class=" menu-hv-2" href="{{route('receiver.index')}}">Receiver</a></li>
                        <li class="menu-bar bg-hd"><a class=" menu-hv-1" href="{{route('category')}}">Category</a></li>
                        <li class="menu-bar bg-light"><a class=" menu-hv-2" href="{{route('report.index')}}">Report</a></li>
                        <li class="menu-bar bg-hd"><a class="menu-hv-1" href="{{route('return_order.index')}}">Return order</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>



        <main class="py-4">

           
        </main>
    </div>
    
    @yield('content')
    
    <script src="{{asset('asset/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('asset/js/jquery-3.7.1.min.js')}}"></script>

    <script src="https://kit.fontawesome.com/f6dce9b617.js" crossorigin="anonymous"></script>


</body>

</html>
