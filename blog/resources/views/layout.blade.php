    <!doctype HTML>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <title>Life hacks</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!--favicon-->
        <link rel="icon" href="{{ URL::asset('/css/favicon.png') }}" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('/css/app.css')  }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            html,
            body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 10;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links>a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 20px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .container {
                margin-top: 100px;
            }

            h1 {
                font-size: 50px;
            }

            td {
                font-size: 20px;
            }
        </style>

    </head>

    <body>
        <br>
        <div class="content">
            <div class="links">
                <a href="/">Home</a>
                <a href="/lifehacks">Your Lifehacks</a>
                <a href="/overview">Overview</a>
                @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                    <a>
                        @if (auth()->user()->image)
                        <img src="{{ asset(auth()->user()->image) }}" style="width: 40px; height: 40px; border-radius: 50%; margin-right: -30px;">
                        @endif
                    </a>
                    <a href="{{ url('home') }}">{{Auth::user()->name}}</a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                    @endif
                    @endauth
                </div>
                @endif
            </div>
        </div>
        @yield ('content')
    </body>

    </html>