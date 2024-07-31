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
        #home-background-main{
            width:80%;
            margin:auto;
            height:550px;
            background-image:url("/img/background4.png");
            background-position:1500px center;
            display:flex;
            overflow:hidden;
            background-size:cover;
        }
        #home-tagline{
            margin-top:150px;
            margin-left:180px;
            width:400px;
            color:black;
        }
        .home-tagline-button{
            width:120px;
            height:45px;
            font-size:20px;
            font-weight:bolder;
            margin-top:20px;
            background-color:black;
            color:white;
            border:2px solid grey;
            
        }
        #home-tagline-box{
            width:100%;
            display:flex;
            align-items:center;
            justify-content:center;
            /*background-image:url("/img/background2.jpg"); */
            background-color:#bb8fce;
        }
        #home-tagline-min{
            width:300px;
            height:300px;
            display:flex;
            flex-direction:column;     
            padding: 40px 0 0 20px;
            margin:auto;
            display:none;
        }
        #home-options{
            display:flex;
            width:100%;
            overflow:hidden;
            align-items:center;
            padding:40px 0 40px 0;
            background-color:white;
        }
        .home-sliding-option{
            min-width:12.5%;
            height:240px;
            display:flex;
            justify-content:center;
            align-items:center;
            border-radius:0 20px 20px 0;
            box-shadow: 8px 8px 8px 8px #d1d1d1;
            transition: all 1s ease-in-out ;
        }
        #home-heading-templates{
            
            padding:20px;
            margin-top:50px;
            background-color:#D7BDE2 ;
            font-weight:bolder;
            font-size:20px;
        }
        #home-collection-hr{
                margin-top:50px;
                background-color:#f48fb1    ;
                margin-bottom:20px;
                display:flex;
                align-items:center;
                justify-content:center;
                flex-wrap:wrap;
        }
        #home-collection-hr span{
                padding:10px;
                margin: 20px;
                width:70px;
                height:70px;
                background-color:#fce4ec;
                font-weight:bolder;
                display:flex;
                flex-direction:column;
                align-items:center;
                justify-content:center;
                font-size:13px;
                border-radius:10px ;
        }
        #home-collection-hr img{
                width:40px;
                height:40px;
        }
        #home-collection-hr a{
                text-decoration:none;
        }
        @media(max-width:1000px ){
            #home-tagline-min{
                display:flex;
                width:400px;
            }
            #home-background-main{
                display:none;
            }
        }
        @media(max-width:500px){
            #home-tagline-min{
                width:300px;
            }
            .home-sliding-option{
                min-width:50%;
                width:50%;
            }
        }
        @media(max-width:800px) and (min-width:500px){
            .home-sliding-option{
                width:33.3%;
                min-width:33.33%;
            }
        }
        @media(max-width:1050px) and (min-width:800px){
            #home-background-main{
                width:100%;
            }
            .home-sliding-option{
                min-width:20%;
                width:20%;
                margin:0;
            }
        }
    </style>

    <div class="container">
        <div class="row justify-content-center ">
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


                        

                        {{--<div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>--}}
                </div>
                </div>
                </div>
            </div>
            </div>
            </div>
                        
                <div id="home-background-main">
                    {{--<img src="{{ asset('img/background1.jpg') }}">
                    <img src="{{ asset('img/background2.webp') }}">
                    <img src="{{ asset('img/background3.jpg') }}">--}}
                    <div id="home-tagline">
                        <div style="font-size:35px; color:black;">Building templates Made Simple and Effective!!!</div>
                            <a href="">
                            <button class="home-tagline-button">Lets Start</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div id="home-tagline-box">
                <div id="home-tagline-min">
                        <div style="font-size:35px; color:black;">Building templates Made Simple and Effective!!!</div>
                            <a href="">
                            <button class="home-tagline-button">Lets Start</button>
                            </a>
                        </div>
                </div>
                </div>

                <div id="home-collection-hr">
        
                <a href="{{ route('collection.select',['id' => 'all']) }}">
                        <span>
                        <img src="/img/all-icon.png">
                        <div>All</div>
                        </span>
                </a>
                <a href="{{ route('collection.select',['id' => 'invitation']) }}">
                        <span>
                        <img src="/img/invitation-icon.png">
                        <div>Invitations</div>
                        </span>
                </a>
                <a href="{{ route('collection.select',['id' => 'official']) }}">
                        <span>
                        <img src="/img/official-icon.png">
                        <div>Officials</div>
                        </span>
                </a>
                <a href="{{ route('collection.select',['id' => 'resume']) }}">
                        <span>
                        <img src="/img/resume-icon.png">
                        <div>Resume</div>
                        </span>
                </a>
                <a href="{{ route('collection.select',['id' => 'letter']) }}">
                        <span>
                        <img src="/img/letter-icon.png">
                        <div>Letter</div>
                        </span>
                </a>
                <a href="{{ route('collection.select',['id' => 'certificate']) }}">
                        <span>
                        <img src="/img/certificate-icon.png">
                        <div>Certificate</div>
                        </span>
                </a>
                <a href="{{ route('collection.select',['id' => 'advertisement']) }}">
                        <span>
                        <img src="/img/advertisement-icon.png">
                        <div>Advertise</div>
                        </span>
                </a>
                <a href="{{ route('collection.select',['id' => 'poster']) }}">
                        <span>
                        <img src="/img/poster-icon.png">
                        <div>Poster</div>   
                        </span>
                </a>
                <a href="{{ route('collection.select',['id' => 'media']) }}">
                        <span>
                        <img src="/img/media-icon.png">
                        <div>Media</div>   
                        </span>
                </a>
            </div>





                <div id="home-heading-templates"><center>Use any of these backgrounds and start creating.</center></div>
                
                <div id="home-options">
                    
                    @foreach ($forms as $form)
                    @if ($form->page_type=="vertical")
                    @if(substr($form->background_image, 0, 1) !== '#')
                        <div class="home-sliding-option">
                            <a href="{{ route('form.background-only',['id' => $form->sid]) }}"><x-box source="{{ $form->background_image}}" title="" size="{{$form->paper_size}}"/></a>
                        </div>
                    @endif
                    @endif
                    @endforeach
                    
                </div>
                
                <div class="w3-row w3-padding-64" id="about" style="background-color:#f5eef8;">
                    <div class="w3-col m6 w3-padding-large w3-hide-small">
                    <a href="{{route('collection')}}">
                    <img src="/img/home-page1.png" class="w3-round w3-image" style="border:1px solid black;"alt="img" width="700" height="800">
                    </a>
                    </div>

                    <div class="w3-col m6 w3-padding-large">
                    <h1 style="text-align:center;font-family:Times New Roman;background-color:#bb8fce;font-weight:bolder;">Collection</h1><br>
                    <h5 class="w3-center" style="font-family:Times New Roman;">Use variety of Templates</h5>
                    <p class="w3-large">Unleash your creativity with A2I template Builder, the perfect tool for crafting stunning templates effortlessly. Whether you're a seasoned designer or just starting out, our intuitive drag-and-drop editor, rich text formatting, and customizable templates make designing a breeze. Seamlessly integrate with popular tools like
                         TinyMCE to enhance your 
                         <span class="w3-tag w3-light-grey">creations</span>.</p>
                    <p class="w3-large w3-text-grey w3-hide-medium">Collaborate in real-time with your team, making it easy to share ideas and make instant changes together. Export your templates in various formats, including PDF, PNG, JPEG, and HTML, ensuring they meet all your needs. Join our community of satisfied users and elevate your design process today.</p>
                    </div>
                </div>
                
               
                
               
                 
                        
                  
{{--


                <ul class="list-group">

                        <li class="list-group-item">

                        </li>
                        <li class="list-group-item">

                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('form.any',['id' => 12]) }}" class="link-warning"> Form any</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('form.one') }}" class="link-warning"> Form One</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('form.two') }}" class="link-success"> Form Two</a>
                        </li>
                 </ul>
                    
        --}}

    <script>
    
    let component_option_box=document.getElementsByClassName("component-option-box")
    let option_box_cover=document.getElementsByClassName("option-box-cover")
    for (let x= 0; x<component_option_box.length; x++) {
        component_option_box[x].addEventListener('mouseover', function(){
                option_box_cover[x].style.display="none";
            }
        );
    }
    for (let w= 0; w<component_option_box.length;w++) {
        component_option_box[w].addEventListener('mouseout', function(){
            option_box_cover[w].style.display="flex";
            }
        );
    }

    let count=1;
    
    let home_sliding_option=document.getElementsByClassName("home-sliding-option");
    setInterval(func1,2000);
    
    function func1(){
        number=home_sliding_option.length-(screen.width/(home_sliding_option[0].offsetWidth))+1;
        if(count>number){
            count=0;
        }
        else{
            elementWidth=Number(home_sliding_option[0].offsetWidth);
            translate_width=(elementWidth*count).toString();
            for(let i=0;i<home_sliding_option.length;i++){
                home_sliding_option[i].style.transform="translateX(-"+translate_width+"px)";
            }
            count=count+1;
        }
    }
    </script>
    @endsection
