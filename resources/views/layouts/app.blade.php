<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.common.head')
    @stack('styles')
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('nikosh.css') }}">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Roboto:wght@400;700&family=Lobster&family=Merriweather:wght@400;700&family=Oswald:wght@400;700&family=Raleway:wght@400;700&family=Montserrat:wght@400;700&family=Pacifico&family=Lora:wght@400;700&family=Quicksand:wght@400;700&family=Poppins:wght@400;700&family=Nunito:wght@400;700&family=Dancing+Script&family=Bebas+Neue&family=Cabin:wght@400;700&family=Josefin+Sans:wght@400;700&family=Great+Vibes&family=Ubuntu:wght@400;700&family=Crimson+Text:wght@400;700&family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Bengali:wght@400;700&display=swap" rel="stylesheet">

</head>


<body>

@include('layouts.common.navbar')
@include('layouts.common.navbar2')
<div id="app">

    <main>
        
        {{--@include('layouts.common.sidebar')
        <button class="openbtn" id="toggle-btn"onclick="toggleNav()">
            <i id="menu-icon" class="bx bx-menu bx-tada" style="color:#0a0af3"></i>
        </button>
        --}}
        

        @yield('content')
    </main>
</div>

@include('layouts.common.footer')

@stack('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Include html2canvas and jsPDF libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>


<script src="{{ asset('js/app.js') }}"></script>
{{--
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <!-- Include html-docx-js from CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html-docx-js/0.8.2/html-docx.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <!-- Include jsPDF from CDN -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>--}}

<script>
    function toggleNav() {
        var sidebar = document.getElementById("mySidebar");
        var app = document.getElementById("app");
        var menuIcon = document.getElementById("menu-icon");
        var toggle=document.getElementById("toggle-btn");
        if (sidebar.style.width === "220px") {
            // Sidebar is open, so close it
            sidebar.style.width = "0";
            app.style.marginLeft= "0";
            menuIcon.classList.remove("bx-collapse-horizontal");
            menuIcon.classList.add("bx-menu");
            menuIcon.style.color = "#0a0af3";
        } else {
            // Sidebar is closed, so open it
            sidebar.style.width = "220px";
            app.style.marginLeft="220px"
            menuIcon.classList.remove("bx-menu");
            menuIcon.classList.add("bx-collapse-horizontal");
            menuIcon.style.color = "#f30a0e";
        }
    }

</script>

{{--<script type="text/script" src="{{asset('assets/js/sidebar.js')}}"></script>--}}



</body>
</html>
