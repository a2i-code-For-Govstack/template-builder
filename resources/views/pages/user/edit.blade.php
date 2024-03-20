@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card shadow-lg">
                    <div class="card-body table-full-width table-responsive">
                        <div class="row">
                            <div class="button-list-flex">
                                <h4> <strong class="text-primary">Edit User Info</strong></h4>

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
                                    <form id="edit_user_form" action="{{ route('user.update' , $user->id) }}" method="post" enctype="multipart/form">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">user Name : </label>
                                                <input type="text" class="form-control" name="name"
                                                   value="{{ $user->name }}" placeholder="Enter Name"><br>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">user Email : </label>
                                                <input type="email" class="form-control" name="email"
                                                   value="{{ $user->email }}" placeholder="Enter Email"><br>
                                            </div>
                                            <div class="form-group">

                                                <label for="name">Select Role : </label>
                                                <select class="form-control mb-2 fw-bold" name="roles[]" multiple>

                                                    @foreach ($roles as $r)
                                                    @if ($user->getRoleNames()->contains($r->name))
                                                        <option value="{{ $r->name }}" disabled selected>{{ $r->name }}</option>
                                                    @endif
                                                    <option value="{{ $r->name }}">{{ $r->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success"
                                                >update
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

            $('#edit_user_form').ajaxForm({
                success: function(data) {
                    successModal(data.message);
                },
                error: function(data) {
                    errorModal(data);
                }

            })
        });
    </script>
@endsection
