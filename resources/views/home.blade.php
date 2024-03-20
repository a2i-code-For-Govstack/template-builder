@extends('layouts.app')

@section('content')
    <style>
        .main_card1 {
            height: 130px;
            width: 100%;
            border-radius: 10px;
            background-color: #ffead8;
            transition: all 0.3s ease-in-out;
            border: 1px solid #ff915ee4;
            border-top: 10px solid #ff915ee4;

        }

        .deco1 {
            text-decoration: none;
            border-bottom: 1px solid #ff915ee4;
            color: black;
        }

        .deco1:hover {
            text-decoration: none;
            color: black;
        }

        .deco2:hover {
            text-decoration: none;
            color: black;
        }

        .deco3:hover {
            text-decoration: none;
            color: black;
        }

        .deco4:hover {
            text-decoration: none;
            color: black;
        }
        .deco5:hover {
            text-decoration: none;
            color: black;
        }
        .dash-icon1 {
            margin-top: 35px;
            margin-left: 30px;
            font-size: 40px;
            color: #ff915ee4;
            opacity: 0.6;
            transform: translate(-50%, -50%);
            transition: all 0.3s ease-in-out;
        }

        .dash-text1 {
            margin-top: 35px;
            font-size: 30px;
            color: #ed7e03;

            transform: translate(-50%, -50%);
            transition: all 0.3s ease-in-out;
        }


        .main_card2 {
            height: 130px;
            width: 100%;
            border-radius: 10px;
            background-color: #dcfff9;
            transition: all 0.3s ease-in-out;
            border: 1px solid #5efff2e4;
            border-top: 10px solid #5efff2e4;

        }

        .deco2 {
            text-decoration: none;
            border-bottom: 1px solid #5efff2e4;
            color: black;

        }

        .dash-icon2 {
            margin-top: 35px;
            margin-left: 30px;
            font-size: 40px;
            color: #37d7c7e4;
            opacity: 0.6;
            transform: translate(-50%, -50%);
            transition: all 0.3s ease-in-out;
        }

        .dash-text2 {
            margin-top: 35px;
            font-size: 30px;
            color: #03e1ed;

            transform: translate(-50%, -50%);
            transition: all 0.3s ease-in-out;
        }

        .main_card3 {
            height: 130px;
            width: 100%;
            border-radius: 10px;
            background-color: #d2f8ca;
            transition: all 0.3s ease-in-out;
            border: 1px solid #5eff76e4;
            border-top: 10px solid #5eff76e4;

        }

        .deco3 {
            text-decoration: none;
            border-bottom: 1px solid #5eff76e4;
            color: black;

        }

        .dash-icon3 {
            margin-top: 35px;
            margin-left: 30px;
            font-size: 40px;
            color: #37d737e4;
            opacity: 0.6;
            transform: translate(-50%, -50%);
            transition: all 0.3s ease-in-out;
        }

        .dash-text3 {
            margin-top: 35px;
            font-size: 30px;
            color: #03ed1a;

            transform: translate(-50%, -50%);
            transition: all 0.3s ease-in-out;
        }

        .main_card4 {
            height: 130px;
            width: 100%;
            border-radius: 10px;
            background-color: #e4caf8;
            transition: all 0.3s ease-in-out;
            border: 1px solid #bc5effe4;
            border-top: 10px solid #bc5effe4;

        }

        .deco4 {
            text-decoration: none;
            border-bottom: 1px solid #c95effe4;
            color: black;

        }

        .dash-icon4 {
            margin-top: 35px;
            margin-left: 30px;
            font-size: 40px;
            color: #9237d7e4;
            opacity: 0.6;
            transform: translate(-50%, -50%);
            transition: all 0.3s ease-in-out;
        }

        .dash-text4 {
            margin-top: 35px;
            font-size: 30px;
            color: #8f03ed;

            transform: translate(-50%, -50%);
            transition: all 0.3s ease-in-out;
        }

        .main_card5 {
            height: 130px;
            width: 100%;
            border-radius: 10px;
            background-color: #f8cae4;
            transition: all 0.3s ease-in-out;
            border: 1px solid #ff5ec9e4;
            border-top: 10px solid #ff5ec9e4;

        }

        .deco5 {
            text-decoration: none;
            border-bottom: 1px solid #ff5ec9e4;
            color: black;

        }

        .dash-icon5 {
            margin-top: 35px;
            margin-left: 30px;
            font-size: 40px;
            color: #d7379ce4;
            opacity: 0.6;
            transform: translate(-50%, -50%);
            transition: all 0.3s ease-in-out;
        }

        .dash-text5 {
            margin-top: 35px;
            font-size: 30px;
            color: #ed03a3;

            transform: translate(-50%, -50%);
            transition: all 0.3s ease-in-out;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="">

                    <div class="container">
                        <div class="row">
                            @canany(['form-list', 'form-create', 'form-edit', 'form-delete'])
                                <div class="col-3 ">
                                    <div class=" m-3 main_card1">
                                        <div class="p-2 h-100">
                                            <a href="{{ route('form.index') }}" class="deco1 fs-5 d-flex  my-1"> Form
                                                List</a>
                                            <div class="d-flex justify-content-between">
                                                <div><i class="fa-solid fa-newspaper dash-icon1"></i></div>
                                                <div class="dash-text1">{{ $total_form }}</div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            @endcanany
                            @canany(['log-index', 'log-show', 'log-update', 'log-edit'])
                                <div class="col-3 ">
                                    <div class=" m-3 main_card2">
                                        <div class="p-2 h-100">
                                            <a href="{{ route('log.info') }}" class="deco2 fs-5 d-flex  my-1">Template
                                                Log-Info</a>
                                            <div class="d-flex justify-content-between">
                                                <div><i class="fa-solid fa-hourglass-start dash-icon2"></i></div>
                                                <div class="dash-text2">{{ $total_template_log }}</div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            @endcanany
                            @canany(['category-list', 'category-create', 'category-edit', 'category-delete'])
                                <div class="col-3 ">
                                    <div class=" m-3 main_card3">
                                        <div class="p-2 h-100">
                                            <a href="{{ route('category.list') }}" class="deco3 fs-5 d-flex  my-1">Category
                                                Type</a>
                                            <div class="d-flex justify-content-between">
                                                <div><i class="fab fa-buffer dash-icon3"></i></div>
                                                <div class="dash-text3">{{ $total_category }}</div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            @endcanany
                            @canany(['home-index', 'role-list', 'role-create', 'role-edit', 'role-delete', 'user-list',
                                'user-create', 'user-edit', 'user-delete'])
                                <div class="col-3 ">
                                    <div class=" m-3 main_card4">
                                        <div class="p-2 h-100">
                                            <a href="{{ route('usersrole') }}" class="deco4 fs-5 d-flex  my-1">Role &
                                                Permission</a>
                                            <div class="d-flex justify-content-between">
                                                <div><i class="fa-solid fa-user-shield dash-icon4"></i></div>
                                                <div class="dash-text4">{{ $total_user }}</div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endcanany

                            @canany(['form-permission-change','form-permission-index'])
                                <div class="col-3 ">
                                    <div class=" m-3 main_card5">
                                        <div class="p-2 h-100">
                                            <a href="{{ route('form-permission.info') }}" class="deco5 fs-5 d-flex  my-1">Form
                                                Permission</a>
                                            <div class="d-flex justify-content-between">
                                                <div><i class="fa-regular fa-file-zipper dash-icon5"></i></div>
                                                <div class="dash-text5">{{ $total_form }}</div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endcanany


                        </div>

                        {{-- <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div> --}}

                        {{-- <ul class="list-group">

                        <li class="list-group-item">

                        </li>
                        <li class="list-group-item">

                        </li>
                        <li class="list-group-item">

                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('form.one') }}" class="link-warning"> Form One</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('form.two') }}" class="link-success"> Form Two</a>
                        </li>
                    </ul> --}}
                    </div>
                </div>
            </div>
        </div>
    @endsection
