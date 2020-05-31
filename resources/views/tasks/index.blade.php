<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
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
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
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
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (isset($message)):
                <p>{{ $message }}</p>
                @endif
                <a class="btn btn-primary mb-2" href="/newtask">create new task</a>
                @foreach ($tasks as $task)
                <div class="row mb-3 p-3 rounded-sm" style="background-color: #eee;">
                    <div class="col-12">
                        <div class="row">
                            <span class="col-2"><p>{{ $task->name }}</p></span><span class="col-5"><p>{{ $task->description }}</p></span>
                            @if ($task->done)
                            <span class="col-2">Status: Done</span>
                            @else
                            <span class="col-2">Status: Not done</span>
                            @endif
                            <div class="col-1">
                                <form action="/deleteTask" method="post">
                                    @csrf
                                    <button class="btn btn-primary" type="submit" name="id" value="{{ $task->id }}">delete</button>
                                </form>
                            </div>
                            <div class="col-1">
                                <input type="button" class="btn btn-primary" id="activate-update-form" value="update">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3 update-form disabled">
                        <form class="row" action="/updateTask" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $task->id }}">
                            <div class="col-1">
                                <input id="done" type="radio" name="done" value="1">
                                <label for="done">done</label>
                            </div>
                            <div class="col-2">
                                <input id="notdone" type="radio" name="done" value="0">
                                <label for="notdone">not done</label>
                            </div>
                            <input style="height: 33px;" class="col-3" type="text" name="name" value="" placeholder="task new name">
                            <input style="height: 33px;" class="col-4" type="text" name="description" value="" placeholder="task new description">
                            <button style="height: 33px;" class="col-2 btn btn-primary" type="submit" name="button">update</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>
    const updateBtn = document.querySelectorAll('#activate-update-form');
    const updateForm = document.querySelectorAll('.update-form');

    updateBtn.forEach((btn, index) => {
        btn.addEventListener("click", () => {
            updateForm[index].classList.toggle('disabled');
        });
    });
    </script>
</body>
