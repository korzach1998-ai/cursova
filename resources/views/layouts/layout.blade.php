<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5.3 CDN for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <link rel="icon" href="{{ asset('images/icons/shoes.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
    <link rel="stylesheet" href="{{ asset('css/category.css') }}">
    <link rel="stylesheet" href="{{ asset('css/paginateNav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    <title>@yield('title', 'RunFlow')</title>
    <style>
        body {
            min-height: 100vh;
        }
        #nav-bar {
            min-height: 100%;
        }
        main {
            margin-left: 30px;
        }
    </style>
</head>
<body class="d-flex">
    <nav id="nav-bar" class="{{ Auth::check() ? 'authenticated' : '' }} d-flex flex-column gap-3 p-3" style="width: 300px; background-color: #212121;">
        <a href="/" class="d-flex align-items-center mb-3" style="width: 100px; border: none">
            <img src="{{ asset('images/icons/shoes.png') }}" alt="Shoes Icon" class="img-fluid" />
        </a>

        @guest
        <div id="auth-container" class="d-flex flex-column gap-2 mb-4">
            <a href="{{ route('login') }}" class="text-decoration-none btn btn-sm">Вхід</a>
            <a href="{{ route('register') }}" class="text-decoration-none btn btn-sm">Реєстрація</a>
        </div>
        @endguest

        <a href="/">Головна</a>
        <a href="{{ route('products.index') }}">Товари</a>
        @auth
            <a href="{{ route('categories.index') }}">Категорії</a>
        @endauth

        <div class="mt-auto d-flex flex-column gap-2 pt-3 border-top">
            @auth
                <div id="logout-container" class="d-flex flex-column gap-2 pt-2">
                    <span>Вітаємо, {{ Auth::user()->username }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Вийти</button>
                    </form>
                </div>
            @endauth
        </div>
    </nav>

    <main class="flex-grow-1 container-sm justify-content-center mt-4">
        @yield('content')
    </main>
</body>
</html>
