<style>
    *{
        box-sizing:border-box;
    }
    #navbar{
        background-color:white ;
    }
    li:hover{
        background-color:none ;
    }
    #navbar-main{
        background-color:white ;
        display:flex;
        justify-content:space-between;
        align-items:center;
        height: 80px;
    }
    #navbar-dropdown{
        margin-right:25px;
    }
    #navbar-logo{
        margin-left:25px;
    }
</style>
<!--
<nav id="navbar"class="navbar navbar-expand-md navbar-light">
    <div class="container">
        
        <a class="navbar-brand" href="{{ url('/home') }}">
{{--            {{ config('app.name', 'tinymce') }}--}}
            <img src="{{ asset('assets/images/logo.png') }}" alt="Image" class="img-fluid w-75">
        </a>
        
            
            <ul class="navbar-nav me-auto">

            </ul>

            
            <ul class="navbar-nav ms-auto">
                
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
                            <div class="dropdown">
                            <button class="btn btn-secondary me-auto bg-transparent" style="color:black"type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                                <i class='bx bxs-user-circle' style='color:#33AFFF;font-size: 27px' ></i>
                            </button>
                            <div class="dropdown-menu me-auto" aria-labelledby="dropdownMenuButton">
                                <span class="dropdown-item">
                                <strong>Name:</strong> {{ Auth::user()->name }}
                                </span>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                                </form>

                            </div>
                            </div>
                            <div class="dropdown">
                                <a class="nav2-a dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown">
                                    <span >
                                    <i class='bx bxs-user-circle' style='color:#33AFFF;font-size: 27px' ></i>
                                    </span>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-custom " style="background-color:#ECF6FD;" aria-labelledby="formsDropdown1">
                                    <li><span class="dropdown-item">
                                            <strong>Name:</strong> {{ Auth::user()->name }}
                                            </span></li>
                                    
                                    <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                        </form>
                                    </li>
                                    
                                </ul>
                            </div>
                @endguest
            </ul>
        </div>
    
</nav>-->
<div id="navbar-main">
        <a id="navbar-logo"class="navbar-brand" href="{{ url('/home') }}">
        {{--            {{ config('app.name', 'tinymce') }}--}}
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Image" class="img-fluid w-75">
                </a>

                <div id="navbar-dropdown"class="dropdown">
                                <a class="nav2-a " href="#" role="button"
                                data-bs-toggle="dropdown">
                                    <span >
                                    <i class='bx bxs-user-circle' style='color:#4caf50 ;font-size: 40px' ></i>
                                    </span>
                                </a>

                                <ul class="dropdown-menu" style="background-color:#ECF6FD;" aria-labelledby="formsDropdown1">
                                    <li><span class="dropdown-item">
                                            <strong>Name:</strong> {{ Auth::user()->name }}
                                            </span></li>
                                    
                                    <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                        </form>
                                    </li>
                                    
                                </ul>
                            </div>
</div>



