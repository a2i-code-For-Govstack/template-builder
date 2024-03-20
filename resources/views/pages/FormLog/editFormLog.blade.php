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

            /* Rounded corners */
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
                        <a href="{{ route('form.index') }}">
                            <button class="btn btn-primary float-end" href>
                                Form List
                            </button>
                        </a>
                        <div class="button-list-flex">
                            <h4>Edit Form</h4>
                        </div>

                        <!--begin::Form-->
                        <form class="row" id="update_form" action="{{ route('updateformUpdateLogList',$data->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="title"><span class="text-danger">*</span>Form Title: </label>

                                    <input type="text" class="form-control mb-2 fw-bold" id="title" name="title"
                                        value="{{ old('title', $data->title) }}">

                                </div>
                            </div>
                            {{-- <div class="col-sm-12 col-md-6"> --}}
                                {{-- <div class="form-group">
                                    <label for="select2Input" class="control-label">Form Sid</label> --}}
                                    {{-- <input type="number" name="sid" class="form-control mb-2 fw-bold"
                                        placeholder="Write Your Title" value="{{ old('sid') }}" /> --}}
                                    {{-- <select id="select2Input" class="js-example-basic-single border" data-control="select2"
                                        style="width: 100%" name="sid" placeholder="Select SID">
                                        @foreach ($jsonData as $old_value)
                                            @if ($old_value['id'] == $data->sid)
                                                <option value="{{ $old_value['id'] }}" selected>{{ $old_value['name'] }}
                                                    [{{ $old_value['id'] }}]</option>
                                            @endif
                                        @endforeach
                                        <option value="0">Letter Template [0]</option>
                                        @foreach ($jsonData as $sid)
                                            <option value="{{ $sid['id'] }}">{{ $sid['name'] }} [{{ $sid['id'] }}]
                                            </option>
                                        @endforeach
                                    </select> --}}



                                {{-- </div> --}}
                            {{-- </div> --}}

                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="template_type">Template Type</label>
                                    <select class="form-control mb-2 fw-bold" name="template_type">
                                        @if ($data->template_type == 'English')
                                            <option value="English">English</option>
                                        @endif
                                        @if ($data->template_type == 'Bangla')
                                            <option value="Bangla">Bangla</option>
                                        @endif
                                        @if ($data->template_type != 'English')
                                            <option value="English">English</option>
                                        @endif
                                        @if ($data->template_type != 'Bangla')
                                            <option value="Bangla">Bangla</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="font_type">Font Type</label>
                                    <select class="form-control mb-2 fw-bold" name="font_type">
                                        @if ($data->font_type == 'Times New Roman')
                                            <option value="Times New Roman">Times New Roman</option>
                                        @endif
                                        @if ($data->font_type == 'Bangla')
                                            <option value="Bangla">Bangla</option>
                                        @endif
                                        @if ($data->font_type != 'Times New Roman')
                                            <option value="Times New Roman">Times New Roman</option>
                                        @endif
                                        @if ($data->font_type != 'Bangla')
                                            <option value="Bangla">Bangla</option>
                                        @endif

                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="paper_size">Paper Size</label>
                                    <select class="form-control mb-2 fw-bold" name="paper_size">
                                        @if ($data->paper_size == 'A4')
                                            <option value="A4">A4</option>
                                        @endif
                                        @if ($data->paper_size == 'A3')
                                            <option value="A3">A3</option>
                                        @endif
                                        @if ($data->paper_size == 'Letter')
                                            <option value="Letter">Letter</option>
                                        @endif
                                        @if ($data->paper_size == 'Legal')
                                            <option value="Legal">Legal</option>
                                        @endif
                                        @if ($data->paper_size != 'A4')
                                            <option value="A4">A4</option>
                                        @endif
                                        @if ($data->paper_size != 'A3')
                                            <option value="A3">A3</option>
                                        @endif
                                        @if ($data->paper_size != 'Letter')
                                            <option value="Letter">Letter</option>
                                        @endif
                                        @if ($data->paper_size != 'Legal')
                                            <option value="Legal">Legal</option>
                                        @endif

                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="page_type">Page Type</label>
                                    <select class="form-control mb-2 fw-bold" name="page_type">
                                        @if ($data->page_type == 'Landscape')
                                            <option value="Landscape">Landscape</option>
                                        @endif
                                        @if ($data->page_type == 'Portrait')
                                            <option value="Portrait">Portrait</option>
                                        @endif
                                        @if ($data->page_type != 'Landscape')
                                            <option value="Landscape">Landscape</option>
                                        @endif
                                        @if ($data->page_type != 'Portrait')
                                            <option value="Portrait">Portrait</option>
                                        @endif

                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="sid">Category</label>
                                    <select class="form-control mb-2 fw-bold" name="category" id="template">
                                        @isset($data->category_type->id)
                                            <option value="{{ $data->category_type->id }}" default>
                                                {{ $data->category_type->name }}
                                            </option>
                                            @foreach ($category as $c)
                                                @if ($c->id != $data->category_type->id)
                                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                                @endif
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="category">Image Transparacy Rate</label>
                                    <input value="{{ $data->image_transparacy }}" type="number" name="image_transparacy"
                                        class="form-control mb-2 fw-bold image_transparacy"
                                        placeholder="set any number from 0.1 to 1" min="0" max="1"
                                        step="0.1">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="category">Background Image</label>
                                    <input id="background_image" type="file" name="background_image"
                                        class="form-control mb-2 fw-bold" placeholder="Upload image">
                                    <img class="img-responsive" height="50" width="50"
                                        src="/storage/{{ $data->background_image }}" alt="image" />
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
                            <div class="card-body ps-0">
                                <label for="content" class="form-control-label fw-bold">Form Content: </label>
                                <textarea name="content" id="content">

                                      {{ old('content', $data->content) }}

                                    </textarea>

                                @if ($errors->has('content'))
                                    <div class="error text-danger fw-bold">{{ $errors->first('content') }}</div>
                                @endif

                            </div>

                            <div class="col-sm-12 col-md-6">
                                <a href="{{ route('form.index') }}" class="btn btn-danger btn-flex"><i
                                        class="fa fa-times"></i> Cancel
                                </a>
                                @if ($data->is_editable == 0 || auth()->user()->hasRole('SuperAdmin'))
                                    <button type="submit" class="btn btn-success btn-flex"><i class="fa fa-save"></i>
                                        Save Changes</button>
                                @endif
                            </div>

                        </form>
                        <!--end::Form-->

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
        });
    </script>
    <script>
        $(document).ready(function() {

            $('#update_form').ajaxForm({
                success: function(data) {
                    // $('#update_form')[0].reset();
                    successModal(data.message);
                },
                error: function(data) {
                    errorModal(data);
                }
            })
        });
        //
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
            const image_transparacy = $("input[name='image_transparacy']").val();
            console.log(image_transparacy);
            $('#preview_image').css('opacity', image_transparacy);
        });
        $('#downloadButton').on('click', function() {
            var image = $('#preview_image')[0]; // Get the DOM element from jQuery object

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
