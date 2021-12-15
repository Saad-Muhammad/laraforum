<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel-Forum') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel-Forum') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
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

            <div class="container">
                <div class="row">
                    <div class="col-md-4">

                            <a href="{{route('discussion.create')}}" class="form-control btn btn-primary">Create A New Discussion</a>
                            <br>
                            <br>
                        @if(Auth::check())
                            @if(Auth::user()->admin)
                                <div class="card">
                                    <div class="card-body">

                                            <ul class="list-group">
                                                <li class="list-group-item list-group-item-light">

                                                <a href="{{ route('channels.index')}}" style="text-decoration:none; color:gray;">All Channels</a>

                                                </li>

                                                <li class="list-group-item list-group-item-light">

                                                <a href="{{route('channels.create')}}" style="text-decoration:none; color:gray;">Create A Channel</a>

                                                </li>

                                            </ul>
                                            <br>

                                    </div>
                                </div>
                                <br>
                            @endif
                        @endif
                            <div class="card">
                                <div class="card-body">

                                        <ul class="list-group">
                                            <li class="list-group-item list-group-item-light">

                                            <a href="{{ route('forum')}}" style="text-decoration:none; color:gray;">Home</a>

                                            </li>
                                            @if(Auth::check())
                                            <li class="list-group-item list-group-item-light">

                                                    <a href="/forum?filter=me" style="text-decoration:none; color:gray;">My Discussions</a>

                                            </li>
                                            @endif
                                            <li class="list-group-item list-group-item-light">

                                                    <a href="/forum?filter=solved" style="text-decoration:none; color:gray;">Answered Discussions</a>

                                            </li>

                                            <li class="list-group-item list-group-item-light">

                                                    <a href="/forum?filter=unsolved" style="text-decoration:none; color:gray;">Unanswered Discussions</a>

                                            </li>

                                         </ul>



                                         <br>

                                </div>
                            </div>
                        <br>

                        <div class="card">

                            <div class="card-header text-center">Channels</div>

                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach($channels as $channel)
                                        <li class="list-group-item list-group-item-light">
                                        <a href="{{ route('channel' , ['slug' => $channel->slug ])}}" style="text-decoration:none; color:gray;">{{ $channel->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">

                    <!-- Alerts -->
                        @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                             <strong>{{ Session::get('success') }}</strong>
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                        </div>

                        @elseif(Session::has('info'))
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong>{{ Session::get('info') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                        @endif

                        @if($errors->count() > 0)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">

                                <ul class="list-group">
                                    @foreach($errors->all() as $error)
                                    <li class="list-group-item list-group-item-danger"><strong>{{ $error }}</strong></li>
                                    @endforeach
                                </ul>

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        @endif
                    <!-- Alerts -->
                        @yield('content')

                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
