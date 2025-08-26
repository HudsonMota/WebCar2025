<!doctype html>
<html lang="{{ date_default_timezone_set('America/Fortaleza')}}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon" />

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>WebCar HSJ</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

  <div style="display: none;">
    Ícones feitos por <a href="https://www.flaticon.com/br/autores/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/br/" title="Flaticon"> www.flaticon.com</a>
  </div>

  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container">
        <div class="ls-brand-name">
                    <div class="container-fluid">
                        <ul>
                            <img src="{{ asset('images/logo.png') }}" class="logo3" style="width: 195px; margin-top: 5px;" />
                        </ul>
                        <ul>
                            <img src="{{ asset('images/LogoHSJ1.png') }}" class="logo2"
                                style="width: 165px; margin-top: 5px;" />
                        </ul>
                        <ul>
                            <img src="{{ asset('images/LgWC2.png') }}" class="logo1" style="width: 90px;" />
                        </ul>

                    </div>
                </div>
        </h1>
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">

        </ul>
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
          <!-- Authentication Links -->
          @guest
          <li class="nav-item col-md-12">
            <a class="nav-link btn btn-success" style="color: #fff; font-weight: bold;" href="{{ route('login') }}">{{ __('Entrar') }}</a>
          </li>
          @if (Route::has('register'))
          <li class="nav-item col-md-12">
            <a class="nav-link btn btn-primary" style="color: #fff; font-weight: bold;" href="{{ route('register') }}">{{ __('Cadastro') }}</a>
          </li>
          @endif
          @else
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
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
  </div>
  </nav>
  <main class="py-4">
    @yield('content')
  </main>
  </div>
</body>

</html>
