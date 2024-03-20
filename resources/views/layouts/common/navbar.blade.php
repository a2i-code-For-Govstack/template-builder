<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/home') }}">
{{--            {{ config('app.name', 'tinymce') }}--}}
            <img src="{{ asset('assets/images/logo.png') }}" alt="Image" class="img-fluid w-75">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
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

                    <li class="nav-item ms-auto me-2">
                        <a class="btn btn-outline-primary" href="{{ url()->previous() }}">
                            <i class='bx bx-left-top-arrow-circle bx-fade-left' style='color:#213398;font-size: 20px' ></i>Go Back
                        </a>
                    </li>

                    <li class="nav-item dropdown nav-item ms-auto me-2">
                        <a id="navbarDropdown" class="nav-link " href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{--{{ Auth::user()->name }}--}}
                            <i class='bx bxs-user-circle' style='color:#289821;font-size: 27px'  ></i>
                            <i class='bx bx-chevron-down' style='color:#000000;font-size: 27px'></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item border-bottom" href="">
                                <strong>Name:</strong> {{ Auth::user()->name }}
                            </a>
                            <a class="dropdown-item border-bottom" href="">
                                <strong>Designation:</strong>
                            </a>

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
