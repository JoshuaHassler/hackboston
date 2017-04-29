<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GoVentr - Home</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
                background-image: url("/img/mt_wash_good-compressor.jpg");
                background-position: center top;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
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
                margin-top: 120px;
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links, .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

        @font-face {
            font-family: 'Pacifico';
            font-style: normal;
            font-weight: normal;
            src: local('Pacifico'), url('http://themes.googleusercontent.com/font?kit=fKnfV28XkldRW297cFLeqfesZW2xOQ-xsNqO47m55DA') format('truetype');
        }

        #button {
            display: inline-block;
            margin-top: 20%;
            -webkit-border-radius: 8px;
            -moz-border-radius: 8px;
            border-radius: 8px;
            -webkit-box-shadow:    0 8px 0 #c5376d, 0 15px 20px rgba(0, 0, 0, .35);
            -moz-box-shadow: 0 8px 0 #c5376d, 0 15px 20px rgba(0, 0, 0, .35);
            box-shadow: 0 8px 0 #c5376d, 0 15px 20px rgba(0, 0, 0, .35);
            -webkit-transition: -webkit-box-shadow .1s ease-in-out;
            -moz-transition: -moz-box-shadow .1s ease-in-out;
            -o-transition: -o-box-shadow .1s ease-in-out;
            transition: box-shadow .1s ease-in-out;
            font-size: 50px;
            color: #fff;
        }

        #button span {
            display: inline-block;
            padding: 20px 30px;
            background-color: #ec528d;
            background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(hsla(338, 90%, 80%, .8)), to(hsla(338, 90%, 70%, .2)));
            background-image: -webkit-linear-gradient(hsla(338, 90%, 80%, .8), hsla(338, 90%, 70%, .2));
            background-image: -moz-linear-gradient(hsla(338, 90%, 80%, .8), hsla(338, 90%, 70%, .2));
            background-image: -o-linear-gradient(hsla(338, 90%, 80%, .8), hsla(338, 90%, 70%, .2));
            -webkit-border-radius: 8px;
            -moz-border-radius: 8px;
            border-radius: 8px;
            -webkit-box-shadow: inset 0 -1px 1px rgba(255, 255, 255, .15);
            -moz-box-shadow: inset 0 -1px 1px rgba(255, 255, 255, .15);
            box-shadow: inset 0 -1px 1px rgba(255, 255, 255, .15);
            font-family: 'Pacifico', Arial, sans-serif;
            line-height: 1;
            text-shadow: 0 -1px 1px rgba(175, 49, 95, .7);
            -webkit-transition: background-color .2s ease-in-out, -webkit-transform .1s ease-in-out;
            -moz-transition: background-color .2s ease-in-out, -moz-transform .1s ease-in-out;
            -o-transition: background-color .2s ease-in-out, -o-transform .1s ease-in-out;
            transition: background-color .2s ease-in-out, transform .1s ease-in-out;
        }

        #button:hover span {
            background-color: #ec6a9c;
            text-shadow: 0 -1px 1px rgba(175, 49, 95, .9), 0 0 5px rgba(255, 255, 255, .8);
        }

        #button:active, #button:focus {
            -webkit-box-shadow:    0 8px 0 #c5376d, 0 12px 10px rgba(0, 0, 0, .3);
            -moz-box-shadow: 0 8px 0 #c5376d, 0 12px 10px rgba(0, 0, 0, .3);
            box-shadow:    0 8px 0 #c5376d, 0 12px 10px rgba(0, 0, 0, .3);
        }

        #button:active span {
            -webkit-transform: translate(0, 4px);
            -moz-transform: translate(0, 4px);
            -o-transform: translate(0, 4px);
            transform: translate(0, 4px);
        }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Go Ventr
                </div>
                <div class="links">
                    Finding fun so you don't have to
                </div>

                <a href="{{ url('/go') }}" id="button">
                    <span>Go Adventuring!</span>
                </a>
            </div>
        </div>
    </body>
</html>
