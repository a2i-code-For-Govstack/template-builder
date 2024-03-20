@extends('layouts.app')
@push('styles')
    <style>
        footer {
            position: relative !important;
        }



        /* Sidebar styles */
        .sidebar1 {
            height: 100vh;
            width: 0;
            position: fixed;
            top: 0px;
            right: 0;
            background: rgb(192, 189, 201);
            background: linear-gradient(81deg, rgba(192, 189, 201, 1) 2%, rgba(170, 205, 202, 1) 36%, rgba(154, 215, 227, 1) 75%, rgba(0, 212, 255, 1) 100%);
            padding-top: 20px;
            transition: 0.3s;
            color: black;
            z-index: 2000;
            overflow-y: auto;
            /* Make the sidebar scrollable */

        }

        .sidebar1 a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 20px;
            color: white;
            display: block;
            transition: 0.3s;
        }

        .sidebar1 a:hover {
            color: #f1f1f1;
        }

        .closebtn1 {
            position: absolute;
            top: 20px;
            right: 25px;
            font-size: 30px;
            margin-left: 50px;

        }

        .my-button {
            background-color: #2472d1;
            /* Green background */
            border: none;
            /* No border */
            color: white;
            /* White text color */
            padding: 10px
                /* Padding inside the button */
                text-align: center;
            /* Center text horizontally */
            text-decoration: none;
            /* No text decoration (e.g., underline) */
            display: inline-block;
            /* Display as an inline element */
            font-size: 16px;
            /* Font size */
            margin: 25px 0 0 -10px;
            /* 100px top margin, -10px right margin */
            /* Show a hand cursor on hover */

            position: absolute;
            /* Position the button absolutely */
            right: -5px;
            /* Move the button 150px to the right (equal to the button's width) */
            transition: right 0.5s;
            /* Add a smooth transition for the right property */
            position: fixed;
            z-index: 999;

        }

        /* Change button style on hover */
        .my-button:hover {
            background-color: #1dade6c5;
        }

        /* Animate the button to the right side */
        .my-button.active {
            right: -10px;
            /* Move the button to the right with a -10px right margin */
        }

        body {
            overflow-x: hidden;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <button class="my-button py-2" id="moveButton" onclick="toggleSidebar1()">see Instructions</button>

        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card shadow-lg">
                    <div class="m-3">

                        <a href="{{ route('form.index') }}" class="float-end">
                            <button class="btn btn-primary" href>
                                Form List
                            </button>
                        </a>

                        <div class="button-list-flex mt-0">
                            <h4>Create Form</h4>
                        </div>


                        <form class="row" id="create_form" action="{{ route('form.store') }}" method="POST"
                            enctype="multipart/form-data">

                            @csrf

                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="title">Form Title:</label>
                                    <input type="text" name="title" class="form-control mb-2 fw-bold"
                                        placeholder="Write Your Title" value="{{ old('title') }}" />
                                    @if ($errors->has('title'))
                                        <div class="error text-danger fw-bold">{{ $errors->first('title') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">


                                <div class="form-group ">
                                    <label for="select2Input" class="control-label">Form Sid</label>
                                    {{-- <input type="number" name="sid" class="form-control mb-2 fw-bold"
                                        placeholder="Write Your Title" value="{{ old('sid') }}" /> --}}
                                    <select id="select2Input" class="js-example-basic-single border" data-control="select2"
                                        style="width: 100%" name="sid" placeholder="Select SID">

                                        @foreach ($jsonData as $sid)
                                            <option value="{{ $sid['id'] }}">{{ $sid['name'] }} [{{ $sid['id'] }}]
                                            </option>
                                        @endforeach

                                    </select>

                                    @if ($errors->has('sid'))
                                        <div class="error text-danger fw-bold">{{ $errors->first('sid') }}</div>
                                    @endif

                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="template_type">Template Type</label>
                                    <select class="form-control mb-2 fw-bold" name="template_type">

                                        <option value="English">English</option>
                                        <option value="Bangla">Bangla</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="font_type">Font Type</label>
                                    <select class="form-control mb-2 fw-bold" name="font_type">

                                        <option value="Times New Roman">Times New Roman</option>
                                        <option value="Bangla">Bangla</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="paper_size">Paper Size</label>
                                    <select class="form-control mb-2 fw-bold" name="paper_size">

                                        <option value="A4">A4</option>
                                        <option value="A3">A3</option>
                                        <option value="Letter">Letter</option>
                                        <option value="Legal">Legal</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="page_type">Page Type</label>
                                    <select class="form-control mb-2 fw-bold" name="page_type">

                                        <option value="landscape">Landscape</option>
                                        <option value="portrait">Portrait</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select class="form-control mb-2 fw-bold" name="category" id="template">
                                        @foreach ($category as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="category">Background Image</label>
                                    <input id="background_image" type="file" name="background_image"
                                        class="form-control mb-2 fw-bold" placeholder="Upload image">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="category">Image Transparacy Rate</label>
                                    <input type="number" name="image_transparacy"
                                        class="form-control mb-2 fw-bold image_transparacy"
                                        placeholder="set any number from 0.1 to 1" min="0" max="1"
                                        step="0.1">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group mt-2">
                                    <label for="" class=""> </label>
                                    <button type="button" class="btn btn-sm btn-secondary mt-4 seePreview"
                                        data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        Preview Image
                                    </button>
                                </div>
                            </div>

                            {{-- <div class="col-sm-12 col-md-6">

                                <div class="container mt-1">
                                    <a class="btn btn-primary text-white" onclick="toggleSidebar1()">See Instructions</a>
                                </div>
                            </div> --}}
                            {{-- <button class="getInstructionValue">Set Value 1</button>
                            <button class="getInstructionValue">Set Value 2</button>
                            <button class="getInstructionValue">Set Value 2</button> --}}
                            <div class="card-body ps-0">
                                <label for="content" class="form-control-label fw-bold">Form Content: </label>
                                <textarea name="content" id="content">
                                    </textarea>

                                @if ($errors->has('content'))
                                    <div class="error text-danger fw-bold">{{ $errors->first('content') }}</div>
                                @endif
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <button id="create_form" class="btn btn-success mt-2" type="submit">Submit Info</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pages.forms.imagepreview')
    @include('layouts.common.modalmsg')
    @include('pages.forms.details-info')


    <script>
        $(document).ready(function() {
            $('#select2Input').select2();
            $('#create_form').ajaxForm({
                success: function(data) {
                    $('#create_form')[0].reset();

                    successModal(data.message);
                },
                error: function(data) {
                    console.log(data);
                    errorModal(data);
                }

            })
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.getInstructionValue').on('click', function() {
                const editor = tinymce.get('content');

                // Replace 'Your value here' with the value you want to insert.
                const valueToInsert = $(this).val();

                if (editor) {
                    const selectedText = editor.selection.getContent();
                    const content = selectedText ? selectedText + valueToInsert : valueToInsert;

                    editor.selection.setContent(content);
                }
            });
        });
    </script>
    <script>
        // Add JavaScript to trigger the animation
        document.getElementById("moveButton").addEventListener("click", function() {
            this.classList.toggle("active");
        });
    </script>
    <script>
        $(document).ready(() => {

            $('.seePreview').addClass('disabled');
            $("#background_image").change(function() {

                const file = this.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        $("#preview_image")
                            .attr("src", event.target.result);
                    };
                    reader.readAsDataURL(file);
                }

            });
        });
        $('.seePreview').addClass('disabled');
        $(".image_transparacy").change(function() {
            if ($('#background_image').val() != '' && $('.image_transparacy').val() != '') {
                $('.seePreview').removeClass('disabled');
            } else {
                $('.seePreview').addClass('disabled');
            }
        });
        $("#background_image").change(function() {
            if ($('#background_image').val() != '' && $('.image_transparacy').val() != '') {
                $('.seePreview').removeClass('disabled');
            } else {
                $('.seePreview').addClass('disabled');
            }
        });
        var image_transparacy;
        $(".seePreview").click(function() {
            image_transparacy = $("input[name='image_transparacy']").val();

            $('#preview_image').css('opacity', image_transparacy);
             console.log(image_transparacy);
        });

        $('#downloadButton').on('click', function() {

            var image = $('#preview_image')[0]; // Get the

            var canvas = document.createElement('canvas');
            var ctx = canvas.getContext('2d');
            canvas.width = image.width;
            canvas.height = image.height;
            ctx.globalAlpha = image_transparacy;
            ctx.drawImage(image, 0, 0);
            ctx.globalAlpha = 1.0;
            var link = $('<a>').attr('download', 'downloaded_img.jpg');
            link.attr('href', canvas.toDataURL('image/jpeg'));
            $('body').append(link);
            link[0].click();
            link.remove();
        });
    </script>
@endsection
