<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/myreset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table-form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
    <title>{{ $title }} - Renshu STORE</title>
</head>

<body>
    <div id="app" class="container">

        <header class="header">
            <div class="header-logo">
                <h1><a href="{{ route('top') }}"><img src="{{ asset('img/logo.png') }}" alt="Renshu STORE"></a></h1>
            </div>

            @auth
                <p class="header-username">
                    <a href="{{ route('user') }}">
                        <span class="username">{{ $user->name }}</span>様
                    </a>
                </p>
                <header-nav-auth
                    :routes="{{ json_encode([
                        'user_ordered' => route('user.ordered'),
                        'cart' => route('cart'),
                        'logout' => route('logout'),
                    ]) }}"></header-nav>
            @else
                <p class="header-username">
                    ゲスト様
                </p>
                <header-nav-guest
                    :routes="{{ json_encode([
                        'register' => route('register'),
                        'cart' => route('cart'),
                        'login' => route('login'),
                    ]) }}"></header-nav>
            @endauth
        </header>

        <main class="main">
            {{ $slot }}
        </main>

        <footer class="footer">
            <div class="footer-link">
                <a href="{{ route('products') }}">商品一覧へ</a>
                <a href="{{ route('top') }}">トップページへ</a>
            </div>
            <div class="footer-credit">
                <div class="footer-logo">
                    <a href="{{ route('top') }}"><img src="{{ asset('img/logo.png') }}" alt="Renshu STORE"></a>
                </div>
                <div class="footer-copyright"><small>&copy; 2021 Renshu STORE</small></div>
            </div>
        </footer>

    </div><!-- .container -->
    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
