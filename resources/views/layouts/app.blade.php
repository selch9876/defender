<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        
        <title>{{ config('app.name') }}</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" />
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!--Bootstrap, Popper, JQuery-->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

    </head>
    <body>
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
                <div class="container-fluid">
                  <a class="navbar-brand" href="/">Defender</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('game.index') }}">Game</a>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Dropdown
                        </a>
                        <ul class="dropdown-menu">
                          @if (Route::has('login'))
                            <li>
                                @auth
                                <form method="POST" action="{{ route('logout') }}">
                                  @csrf
            
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                              </li>
                              <li><a class="dropdown-item" href="{{ url('/character') }}" class="text-sm">Characters</a></li>
                              <li><a class="dropdown-item" href="{{ url('/player-class') }}" class="text-sm">Classes</a></li>
                              <li><a class="dropdown-item" href="{{ url('/mage-spell') }}" class="text-sm">Mage Spells</a></li>
                            @else
                              <a href="{{ route('login') }}" class="text-sm">Log in</a>
      
                              @if (Route::has('register'))
                                  <a href="{{ route('register') }}" class="ml-4 text-sm">Register</a>
                              @endif
                                @endauth
                              </li>
                            @endif
                              
                        </ul>
                      </li>
                      <li class="nav-item">
                        
                                
                          
                        
                      </li>
                    </ul>
                    <form class="d-flex" role="search">
                      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                      <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>

                    
                  </div>
                </div>
              </nav>

              
        </div>

        <div class="main">
          <div class="container mt-4 mb-4">
            <div class="row justify-content-center">
                <div class="col text-center">
                    <img src="{{ asset('storage/images/adnd_logo.png') }}" alt="" class="img-fluid">
                </div>
            </div>
          </div>
            @yield('content')
        </div>


    </body>
</html>
