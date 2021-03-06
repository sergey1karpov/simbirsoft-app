<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    {!! htmlScriptTagJsApi() !!}

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
                <!-- -->
                <!-- -->
                <!-- -->
                <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <h5 class="ml-2 mt-2">Search by all parameters</h5>
                            <form action="{{route('search')}}" method="GET" class="m-2">@csrf
                                <div class="row">
                                    <div class="col-5">
                                        <div class="form-group">  
                                            <label>Choose a city</label> 
                                            <select class="selectpicker" name="sCity">
                                                <option></option>
                                                    @foreach($cities as $city)
                                                        <option value="{{$city->slug}}">{{$city->name}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="form-group"> 
                                            <label>Choose a category</label>   
                                            <select class="selectpicker" name="sCat">
                                                <option></option>
                                                    @foreach($categories as $cat)
                                                        <option value="{{$cat->slug}}">{{$cat->name}}</option>
                                                    @endforeach
                                            </select>
                                        </div>    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group"> 
                                        <label>Price from</label>   
                                            <input type="search" id="form1" class="form-control" name="ot" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group"> 
                                        <label>Price to</label>   
                                            <input type="search" id="form1" class="form-control" name="do" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary btn-sm ">Search</button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
                <!-- -->
                <!-- -->
                <!-- -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    
                    

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @if(Auth::user()->role == 'User')
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-item" href="{{ route('user.home', Auth::user()->id) }}">
                                        {{ __('Home') }}
                                    </a>
                                </li> 
                            @endif 
                            @if(Auth::user()->role == 'Moderator')
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-item" href="{{ route('moderator.home', Auth::user()->id) }}">
                                        {{ __('Home') }}
                                    </a>
                                </li> 
                            @endif  
                            @if(Auth::user()->role == 'Admin')
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-item" href="{{ route('admin.home', Auth::user()->id) }}">
                                        {{ __('Home') }}
                                    </a>
                                </li> 
                            @endif        
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                @foreach($categories as $cat)
                    <a href="{{ route('allAdInCategory', ['slug' => $cat->slug]) }}">
                        <h6>{{$cat->name}}</h6>
                    </a>
                @endforeach

                <a href="{{ route('regions') }}"><h6>Regions</h6></a>
                    
            </div>
        </nav>  
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <div class="input-group">
                    <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#searchModal">
                        Search by all parameters
                    </button>
                </div>
            </div>
        </nav>    
        @if(session('error'))
            <div class="alert alert-danger ml-5 mr-5 mt-5">
                {{session('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(session('good'))
            <div class="alert alert-success ml-5 mr-5 mt-5">
                {{session('good')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
