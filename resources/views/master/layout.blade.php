<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <meta name="description" content="Demo of Material design portfolio template by TemplateFlip.com."/>
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;amp;lang=en"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="/source/styles/material.indigo-pink.min.css" rel="stylesheet">
    <link href="/source/styles/main.css" rel="stylesheet">
    <link href="/source/styles/nomain.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

    <script src="http://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/vue" type="text/javascript"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js" type="text/javascript"></script>
    <script src="https://unpkg.com/vue-router/dist/vue-router.js"></script>

</head>
<div id="top">
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">

    <header class="mdl-layout__header mdl-layout__header--waterfall site-header">
        <div class="mdl-layout__header-row site-logo-row"><span class="mdl-layout__title">
            {{--<div class="site-logo"></div><span class="site-description">Just LOGO</span>--}}</span></div>
        <div class="mdl-layout__header-row site-navigation-row mdl-layout--large-screen-only">
            <nav class="mdl-navigation mdl-typography--body-1-force-preferred-font">
                <a class="{{ \App\Helpers\Helper::ActiveMenu('/')  }}" href="{{ route('index') }}">Главная</a>
                <a class="{{ \App\Helpers\Helper::ActiveMenu('news')  }}" href="{{ route('news') }}">Новости</a>
        @auth() <a class="mdl-navigation__link" href="{{ route('logout') }}">Выйти</a> @endauth
        @guest()<a class="mdl-navigation__link" href="{{ route('login') }}">Войти</a>
                <a class="mdl-navigation__link" href="{{ route('register') }}">Регистрация</a>@endguest

{{--                <a class="{{ \App\Helpers\Helper::ActiveMenu('about') }}" href="{{ route('about') }}">О нас</a>--}}
{{--                <a class="{{ \App\Helpers\Helper::ActiveMenu('reviews') }}" href="{{ route('reviews') }}">Отзывы</a>--}}
{{--                <a class="{{ \App\Helpers\Helper::ActiveMenu('contacts') }}" href="{{ route('contacts') }}">Контакты</a>--}}
{{--                <a class="{{ \App\Helpers\Helper::ActiveMenu('request')  }}" href="{{ route('request') }}">Заявка</a>--}}
            </nav>
        </div>
    </header>



    <div class="mdl-layout__drawer mdl-layout--small-screen-only">
        <nav class="mdl-navigation mdl-typography--body-1-force-preferred-font">
            <a class="{{ \App\Helpers\Helper::ActiveMenu('/')  }}" href="{{ route('index') }}">Главная</a>
{{--            <a class="{{ \App\Helpers\Helper::ActiveMenu('servises')  }}" href="{{ route('servises') }}">Услуги</a>--}}
{{--            <a class="{{ \App\Helpers\Helper::ActiveMenu('about') }}" href="{{ route('about') }}">О нас</a>--}}
{{--            <a class="{{ \App\Helpers\Helper::ActiveMenu('reviews') }}" href="{{ route('reviews') }}">Отзывы</a>--}}
{{--            <a class="{{ \App\Helpers\Helper::ActiveMenu('contacts') }}" href="{{ route('contacts') }}">Контакты</a>--}}
{{--            <a class="{{ \App\Helpers\Helper::ActiveMenu('request')  }}" href="{{ route('request') }}">Заявка</a>--}}
        </nav>
    </div>

    <main class="mdl-layout__content">
        <div class="site-content">
            <div class="container">

                @yield("container")

            </div>
        </div>
        {{--<footer class="mdl-mini-footer">
            <div class="footer-container">
            </div>
            <ul class="mdl-mini-footer__link-list">
                <li><a href="#">Jeep Incorporations</a></li>
            </ul>

        </footer>--}}
    </main>

    <div class="row">
        <div class="col-2 offset-10">


        </div>
    </div>

</div>
<script src="/source/scripts/material.min.js" defer></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

</div>
</body>
</html>
