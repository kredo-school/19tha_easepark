<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.bunny.net"> --}}
    {{-- <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom-font.css') }}">
    <!-- FW -->
    <link rel ="stylesheet" href="{{ asset('css/all.min.css') }}">
</head>

<body>
    <div id="app" class="d-flex flex-column min-vh-100">
        <nav class="navbar navbar-expand-md navbar-light navbar-color shadow-sm">
            <div class="container">
                <div class="text-white navbar-brand">
                    <img src="{{ asset('images/8C8FAB4E-E713-45F0-839A-5064D27EDBAA.png') }}" alt="Logo"
                        class="logo-style">
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest('admin')
                            <div class="nav-item d-flex align-items-center">
                                <a class="nav-link text-white me-2" href="{{ route('homepage') }}">{{ __('Home') }}</a>

                                @if (Route::has('admin.login'))
                                    <a class="nav-link btn btn-blue text-white"
                                        href="{{ route('admin.login') }}">{{ __('Admin Login') }}</a>
                                @endif
                            </div>
                        @else
                            <div class="nav-item d-flex align-items-center dropdown">
                                <div class="nav-item d-flex align-items-center">
                                    <a class="nav-link text-white me-3"
                                        href="{{ route('admin.users.show') }}">{{ __('Home') }}</a>

                                    <a id="navbarDropdown"
                                        class="nav-link dropdown-toggle lato-regular text-white text-decoration-none"
                                        href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" v-pre>
                                        <span class="fs-1"><i class="fa-solid fa-user-gear"></i></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa-solid fa-right-from-bracket"></i> {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @guest('admin')
            <div class="col">
                @yield('content')
            </div>
        @endguest
        @auth('admin')
        <main class="flex-grow-1 mt-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-2">
                        <div class="list-group text-center">
                            
                            <a href="{{route('admin.users.show')}}" class="list-group-item {{ request()->is('admin/users*') ? 'active' : '' }}">
                                <i class="fa-solid fa-people-group me-1"></i>Users
                            </a>

                            <a href="{{route('admin.areas.show')}}" class="list-group-item {{ request()->is('admin/areas*') ? 'active' : '' }}">
                                <i class="fa-solid fa-map-marked-alt me-1"></i>Areas
                            </a>
                            <a href="{{route('admin.attributes.show')}}" class="list-group-item {{ request()->is('admin/attributes*') ? 'active' : '' }}">
                                <i class="fa-solid fa-wheelchair me-1"></i>Attribute
                            </a>
                            
                            <a href="{{route('admin.fees.show')}}" class="list-group-item {{ request()->is('admin/fees*') ? 'active' : '' }}">
                                <i class="fa-regular fa-credit-card me-1"></i>Fees
                            </a>

                            <a href="{{route('admin.reservations.show')}}" class="list-group-item {{ request()->is('admin/reservations*') ? 'active' : '' }}">
                                <i class="fa-solid fa-car me-1"></i>Reservations
                            </a>

                            {{-- Route name for statistics should be 'admin.statistics.show' later --}}
                            <a href="{{route('admin.statistics.show.test')}}" class="list-group-item {{ request()->is('admin/statistics*') ? 'active' : '' }}">
                                <i class="fa-solid fa-chart-simple me-1"></i>Statistics
                            </a>

                            <a href="{{route('admin.admins.show')}}" class="list-group-item {{ request()->is('admin/admins*') ? 'active' : '' }}">
                                <i class="fa-solid fa-users-gear me-1"></i>Admins
                            </a>
                        </div>
                    </div>

                    <div class="col-9">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
        @endauth
        <footer class="footer navbar-color" style="padding: 30px 0px; height: 100px">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="fs-3 col-md-3 text-center">
                        <a href="{{ asset('https://www.facebook.com/') }}"
                            class="text-decoration-none text-white mx-3"><i class="fa-brands fa-facebook"></i>
                        </a>
                        <a href="{{ asset('https://twitter.com/') }}" class="text-decoration-none text-white mx-3"><i
                                class="fa-brands fa-twitter"></i></a>
                        <a href="{{ asset('https://www.instagram.com/') }}"
                            class="text-decoration-none text-white mx-3"><i class="fa-brands fa-instagram"></i>
                        </a>
                    </div>

                    <div class="text-white col-md-9 d-flex justify-content-end align-items-center">Copyright &copy;
                        {{ now()->year }}
                        EasePark Co., Ltd. All Rights Reserved.
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
