@extends('layouts.app')

@section('content')
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
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card shadow-lg">
                    <div class="card-body table-full-width table-responsive">
                        <div class="row">
                            <div class="button-list-flex">
                                <h4> <strong class="text-primary">Create New user</strong></h4>

                                <a href="{{ route('usersrole') }}">
                                    <button class="btn btn-primary mb-2 float-end" href>
                                        User list
                                    </button>
                                </a>
                            </div>
                        </div>
                        {{-- yajra datatable --}}

                        <div class="container">
                            <div class="row">
                                <div class="col-8">
                                    <form id="create_user_form" action="{{ route('user.store') }}" method="post"
                                        enctype="multipart/form">
                                        @csrf

                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">user Name : </label>
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Enter Name"><br>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">user Email : </label>
                                                <input type="email" class="form-control" name="email"
                                                    placeholder="Enter Email"><br>
                                            </div>
                                            <div class="form-group">

                                                <label for="name">Select Role : </label>
                                                <select class="form-control mb-2 fw-bold" name="roles[]" multiple>
                                                    <option selected>--select Role--</option>
                                                    @foreach ($roles as $r)
                                                        <option value="{{ $r->name }}">{{ $r->name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div class="form-group">
                                                <label for="name">Password : </label>
                                                {{-- <input type="password" class="form-control" name="password"
                                                    placeholder="Enter Password"><br> --}}
                                                <input id="password-field" type="password" class="form-control"
                                                    name="password">
                                                <span toggle="#password-field"
                                                    class="fa fa-fw fa-eye field-icon toggle-password"></span> <br>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Confirmation Password : </label>
                                                <input id="password-field1" type="password" class="form-control" name="password_confirmation"
                                                    placeholder="Retype Password"><span toggle="#password-field1"
                                                    class="fa fa-fw fa-eye field-icon toggle-password"></span> <br>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Save
                                                User</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.common.modalmsg')
    <script>
        $(document).ready(function() {

            $('#create_user_form').ajaxForm({
                success: function(data) {
                    $('#create_user_form')[0].reset();
                    successModal(data.message);
                },
                error: function(data) {
                    errorModal(data);
                }

            })
        });
    </script>
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
        $(".toggle-password1").click(function() {

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
