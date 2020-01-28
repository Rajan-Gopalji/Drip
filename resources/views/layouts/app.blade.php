<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Drip.</title>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main_styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('css/search.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/bootstrap-image-checkbox/dist/css/bootstrap-image-checkbox.css.css') }}" rel="stylesheet">


    <!-- Scripts -->
    <script src="{{ asset('plugins/greensock/TweenMax.min.js')}}"></script>
{{--    <script src="{{ asset('plugins/greensock/TweenMax.min.js')}}"></script>--}}
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}" defer></script>
    <script src="{{ asset('js/product.js') }}" defer></script>
    @yield('scripts')
</head>
<body>
    <div id="app">
        <div class="header_container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="header_content d-flex flex-row align-items-center justify-content-start">
                            <div class="logo"><a href="{{ url('/') }}">Drip</a>&#128167;</div>
                            <nav class="main_nav">
                                <ul>
                                @auth
                                    <!-- <li class="hassubs active"><a href="home.php">Home</a></li> -->
                                    <li><a href="/men">Men</a></li>
                                    <li><a href="/women">Women</a></li>
                                    <li><a href="/p/create">Sell Your Own</a></li>
                                    <li><a href="/profile/{{Auth::user()->id}}/manage">Manage Your Stock</a></li>
                                    <li class="hassubs">
                                        <a href="/profile/{{Auth::user()->id}}">{{ Auth::user()->username }}</a>
                                        <ul>
                                            <li><a href="/{{Auth::user()->id}}/myTrades">Trade</a></li>
                                            <br>
                                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{ __('Logout') }}</a></li>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </ul>
                                    </li>
                                    @endauth
                                    @guest
                                    <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                                        @if (Route::has('register'))
                                            <li><a href="{{ route('register') }}">REGISTER</a></li>
                                        @endif
                                        @endguest
                                </ul>
                            </nav>
                            @auth
                            <div class="header_extra ml-auto">
                                <div class="shopping_cart">
                                    <a href="/profile/{{Auth::user()->id}}/cart">
                                        <div>Cart <span>({{\App\Cart::where('user_id', Auth::user()->id)->count()}})</span></div>
                                    </a>
                                </div>
                                <div class="search pr-5">
                                    <div class="search_box">
                                        <form action="/search" method="POST" role="search">
                                            @csrf
                                            <input type="text" placeholder="Search Item" name="search">
                                        </form>
                                    </div>
                                </div>
                                <div class="hamburger"><i class="fa fa-bars" aria-hidden="true"></i></div>
                            </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu -->
        <div class="menu menu_mm trans_300">
            <div class="menu_container menu_mm">
                <div class="page_menu_content">
                    <div class="page_menu_item has-children menu_mm pb-2">
                        <ul>
                            <li>

                            </li>
                        </ul>
                        <form action="/search" method="POST" role="search">
                            @csrf
                            <input type="text" placeholder="Search Item" name="search">
                        </form>
                    </div>
                    <ul class="page_menu_nav menu_mm">
                        @auth
                        <li class="page_menu_item has-children menu_mm">
                            <a href="men.php">Men<i class="fa fa-angle-down"></i></a>
                            <ul class="page_menu_selection menu_mm">
                                <li class="page_menu_item menu_mm"><a href="/men">All Products<i class="fa fa-angle-down"></i></a></li>
{{--                                <li class="page_menu_item menu_mm"><a href="product.html">Jackets<i class="fa fa-angle-down"></i></a></li>--}}
{{--                                <li class="page_menu_item menu_mm"><a href="categories.html">Trousers<i class="fa fa-angle-down"></i></a></li>--}}
                            </ul>
                        </li>
                        <li class="page_menu_item has-children menu_mm">
                            <a href="index.html">Women<i class="fa fa-angle-down"></i></a>
                            <ul class="page_menu_selection menu_mm">
                                <li class="page_menu_item menu_mm"><a href="/women">All Products<i class="fa fa-angle-down"></i></a></li>
{{--                                <li class="page_menu_item menu_mm"><a href="product.html">Jackets<i class="fa fa-angle-down"></i></a></li>--}}
{{--                                <li class="page_menu_item menu_mm"><a href="categories.html">Trousers<i class="fa fa-angle-down"></i></a></li>--}}
                            </ul>
                        </li>
{{--                        <li class="page_menu_item has-children menu_mm">--}}
{{--                            <a href="categories.html">Categories<i class="fa fa-angle-down"></i></a>--}}
{{--                            <ul class="page_menu_selection menu_mm">--}}
{{--                                <li class="page_menu_item menu_mm"><a href="categories.html">Jackets<i class="fa fa-angle-down"></i></a></li>--}}
{{--                                <li class="page_menu_item menu_mm"><a href="categories.html">Trousers<i class="fa fa-angle-down"></i></a></li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
                        <li class="page_menu_item menu_mm"><a href="/p/create">Sell Your Own<i class="fa fa-angle-down"></i></a></li>
                        <li class="page_menu_item menu_mm"><a href="/profile/{{Auth::user()->id}}/manage">Manage Stock<i class="fa fa-angle-down"></i></a></li>
                        <li class="page_menu_item has-children menu_mm">
                            <a href="#">My Profile<i class="fa fa-angle-down"></i></a>
                            <ul class="page_menu_selection menu_mm">
                                <li class="page_menu_item menu_mm"><a href="/profile/{{Auth::user()->id}}">Profile<i class="fa fa-angle-down"></i></a></li>
                                <li class="page_menu_item menu_mm"><a href="/{{Auth::user()->id}}/myTrades">Trade<i class="fa fa-angle-down"></i></a></li>
                                <li class="page_menu_item menu_mm"><a href="/profile/{{Auth::user()->id}}/edit">Update Details<i class="fa fa-angle-down"></i></a></li>
                                <li class="page_menu_item menu_mm"><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{ __('Log Out') }}<i class="fa fa-angle-down"></i></a></li>
                            </ul>
                        </li>
                        @endauth
                        @guest
                        <li class="page_menu_item menu_mm"><a href="signin.php">Sign In<i class="fa fa-angle-down"></i></a></li>
                        <li class="page_menu_item menu_mm"><a href="register.php">Reigster<i class="fa fa-angle-down"></i></a></li>
                        @endguest
                    </ul>
                </div>
            </div>

            <div class="menu_close"><i class="fa fa-times" aria-hidden="true"></i></div>

            <!-- <div class="menu_social">
              <ul>
                <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
              </ul>
            </div> -->
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>

