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
    <script src="{{ asset('dist/js/demo-theme.min.js') }}"></script>

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

        <div class="container">
            <header class="navbar-expand-md">
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <div class="navbar">
                        <div class="container-xl">
                            <ul class="navbar-nav">
                                <li class="nav-item {{ request()->is('dashboard*') ? 'active' : null }}">
                                    <a class="nav-link" href="{{ route('home') }}">
                                        <span
                                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('Dashboard') }}
                                        </span>
                                    </a>
                                </li>


                                <li class="nav-item {{ request()->is('products*') ? 'active' : null }}">
                                    <a class="nav-link" href="{{ route('product') }}">
                                        <span
                                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-packages" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M7 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                                                <path d="M2 13.5v5.5l5 3" />
                                                <path d="M7 16.545l5 -3.03" />
                                                <path d="M17 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                                                <path d="M12 19l5 3" />
                                                <path d="M17 16.5l5 -3" />
                                                <path d="M12 13.5v-5.5l-5 -3l5 -3l5 3v5.5" />
                                                <path d="M7 5.03v5.455" />
                                                <path d="M12 8l5 -3" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('Products') }}
                                        </span>
                                    </a>
                                </li>


                                <li class="nav-item dropdown {{ request()->is('orders*') ? 'active' : null }}">
                                    <a class="nav-link dropdown-toggle" href="{{route('order_issue.create')}}" data-bs-toggle="dropdown"
                                        data-bs-auto-close="outside" role="button" aria-expanded="false">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-package-export" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 21l-8 -4.5v-9l8 -4.5l8 4.5v4.5" />
                                                <path d="M12 12l8 -4.5" />
                                                <path d="M12 12v9" />
                                                <path d="M12 12l-8 -4.5" />
                                                <path d="M15 18h7" />
                                                <path d="M19 15l3 3l-3 3" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('Orders') }}
                                        </span>
                                    </a>
                                </li>


                                <li class="nav-item dropdown {{ request()->is('purchases*') ? 'active' : null }}">
                                    <a class="nav-link dropdown-toggle" href="{{route('receiver.index')}}" data-bs-toggle="dropdown"
                                        data-bs-auto-close="outside" role="button" aria-expanded="false">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-package-import" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 21l-8 -4.5v-9l8 -4.5l8 4.5v4.5" />
                                                <path d="M12 12l8 -4.5" />
                                                <path d="M12 12v9" />
                                                <path d="M12 12l-8 -4.5" />
                                                <path d="M22 18h-7" />
                                                <path d="M18 15l-3 3l3 3" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('Receiver') }}
                                        </span>
                                    </a>
                                </li>



                                <li class="nav-item {{ request()->is('quotations*') ? 'active' : null }}">
                                    <a class="nav-link" href="{{route('report.index')}}">
                                        <span
                                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-file" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                <path
                                                    d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('Report') }}
                                        </span>
                                    </a>
                                </li>



                                <li
                                    class="nav-item dropdown {{ request()->is('suppliers*', 'customers*') ? 'active' : null }}">
                                    <a class="nav-link dropdown-toggle" href="{{route('return_order.index')}}" data-bs-toggle="dropdown"
                                        data-bs-auto-close="outside" role="button" aria-expanded="false">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-layers-subtract" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M8 4m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z" />
                                                <path d="M16 16v2a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2v-8a2 2 0 0 1 2 -2h2" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('Return Order') }}
                                        </span>
                                    </a>
                                
                                </li>
                            </ul>

                            
                        </div>
                    </div>
                </div>
            </header>
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
