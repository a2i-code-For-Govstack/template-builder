<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.common.head')
    @stack('styles')
</head>


<body>

<div id="app">

    <main >

        @yield('content')
    </main>
</div>


@stack('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>



<script>
    function toggleNav() {
        var sidebar = document.getElementById("mySidebar");
        var app = document.getElementById("app");
        var menuIcon = document.getElementById("menu-icon");
        if (sidebar.style.width === "220px") {
            // Sidebar is open, so close it
            sidebar.style.width = "0";
            app.style.marginLeft = "0";
            menuIcon.classList.remove("bx-collapse-horizontal");
            menuIcon.classList.add("bx-menu");
            menuIcon.style.color = "#0a0af3";
        } else {
            // Sidebar is closed, so open it
            sidebar.style.width = "220px";
            app.style.marginLeft = "220px";
            menuIcon.classList.remove("bx-menu");
            menuIcon.classList.add("bx-collapse-horizontal");
            menuIcon.style.color = "#f30a0e";
        }
    }

</script>

{{--<script type="text/script" src="{{asset('assets/js/sidebar.js')}}"></script>--}}



</body>
</html>
