@extends('auth.auth-layout')

@section('auth-content')
    <style>
        .field-icon {
            float: right;
            margin-left: -25px;
            margin-top: -25px;
            position: relative;
            z-index: 2;
        }

        .container {
            padding-top: 50px;
            margin: auto;
        }
        
    </style>
    <div class="container mt-5 pb-3"style="background-color:#aed581;">
        <div class=" row justify-content-center shadow  rounded mt-3 mb-3 d-md-flex">
            <div class="col-md-6 p-3">
                <div class="col-md-12 card mb-3 shadow p-0">
                    <div class="card-header border-none login-instruction p-1">
                        <div class="col-md-12 fw-bold" style="background-color:#4caf50;">
                            <i class='bx bx-clipboard bx-tada' style='color:#f19b16'></i> <span> নিয়মাবলি </span>
                        </div>

                    </div>
                    <div class="card-body text-success">
                        <div class="col-md-12 border-bottom px-0 my-2">
                            <label class="my-2 border-left-info login-text-instruction ps-2">
                                আপনি আইডি পাসওয়ার্ড দিয়ে লগইন বাটনে ক্লিক করুন।
                            </label>
                        </div>
                        <div class="col-md-12 border-bottom px-0 my-2">
                            <label class="my-2 border-left-info login-text-instruction ps-2">
                                আপনাকে মেইন হোম পেজে নিয়ে যাওয়া হবে ।</label>
                        </div>

                        {{-- <div class="com-md-12 text-right px-0 mt-2">
                        <a href="#" class="btn btn-outline-info btn-sm rounded-pill">+ আরও</a>
                    </div> --}}
                    </div>
                </div>

                <div class="col-md-12 card mb-3 shadow p-0">
                    <div class="card-header border-none login-help-desk p-1">
                        <div class="col-md-12 fw-bold"style="background-color:#4caf50;">
                            <span><i class='bx bx-help-circle bx-tada' style='color:#f19b16'></i> হেল্প ডেস্ক | মাইগভ
                                সংক্রান্ত যেকোনো জিজ্ঞাসা
                        </div>
                    </div>

                    <div class="card-body help-desk-text p-2">
                        <div class="col-md-12 p-0 d-flex login-text-instruction border-bottom my-3">
                            <div class="col-md-10 pb-3"><span><i class='bx bxs-phone bx-tada'
                                        style='color:#16f134'></i></span>
                                ফোন করুনঃ
                                +৮৮০ ১৫৫০-০৬০০৬০, +৮৮০ ১৫৭২-০৫১৯৫২ </div>
                            <div class="col-md-4 p-0">
                                {{-- <span><i class="fas fa-file mr-1"></i></span>
                            <a href=""> ব্যবহার সহায়িকা </a> --}}
                            </div>
                        </div>
                        <div class="col-md-12 p-0 d-flex login-text-instruction my-3">
                            <div class="col-md-8"><span><i class='bx bx-envelope bx-tada' style='color:#16f134'></i></span>
                                ই-মেইল করুনঃ
                                support@mygov.bd</div>
                            <div class="col-md-4 p-0">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6  p-3">

                <div class="col-md-12 d-flex justify-content-center">
                    <div class="col-md-6 my-4">
                        <img class="img-fluid" src="{{ asset('assets/images/logo.png') }}" alt="workflow-logo">
                    </div>
                </div>

                <div class="card shadow">
                    <div class="card-header"style="background-color:#4caf50;">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                     <input id="name" type="text"
                                        class="form-control @error('password') is-invalid @enderror" name="name"
                                        required autocomplete="current-name" value="{{ old('name') }}" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    {{-- <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password"> --}}

                                    <input id="password-field" type="password" class="form-control" name="password"
                                        >

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{--
                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            --}}
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary" style="background-color:#4caf50;">
                                        {{ __('Register') }}
                                    </button>
                                    
                                    <a class="btn btn-link p-0" href="{{ route('login') }}" ml=0 pl=0>
                                            {{ __("Already have an account?") }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <footer class="row bg-white shadow rounded">
            <div class="container-fluid my-auto">
                <div class="content-wrapper container p-0">
                    <div class="row">
                        <!-- copyright -->
                        <div id="copyright" class=" d-flex justify-content-start col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="d-inline"><a class="d-inline text-decoration-none" target="_blank"
                                                href="https://a2i.gov.bd/">পরিকল্পনা ও বাস্তবায়নে:
                                            </a></td>
                                        <td class="d-inline"><a class="d-inline" target="_blank" href="https://a2i.gov.bd/">
                                                <img src="{{ asset('assets/images/logo-set.png') }}" height="50"
                                                    alt="a2i"></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="doel" class="d-flex justify-content-end col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="pl-3 d-inline td-sub"><a class="d-inline text-decoration-none"
                                                target="_blank" href="https://www.orangebd.com/">কারিগরি
                                                সহযোগিতায়:</a></td>
                                        <td class="d-inline"><a class="d-inline" target="_blank"
                                                href="https://www.orangebd.com/"><img
                                                    src="{{ asset('assets/images/logo_orangebd_small.png') }}"
                                                    height="35" alt="a2i"></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script>
        $(".toggle-password").click(function() {

            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
@endsection
