@extends('layouts.yajraapp')

@section('content')
    <div class="mx-5">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-role-tab" data-bs-toggle="tab" data-bs-target="#nav-role" type="button"
                    role="tab" aria-controls="nav-role" aria-selected="true">Role</button>
                <button class="nav-link" id="nav-permission-tab" data-bs-toggle="tab" data-bs-target="#nav-permission"
                    type="button" role="tab" aria-controls="nav-permission" aria-selected="false">Permission</button>
                <button class="nav-link" id="nav-role_permission-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-role_permission" type="button" role="tab" aria-controls="nav-role_permission"
                    aria-selected="false">Pole & Permission
                    Connection</button>
            </div>
        </nav>

        <div class="tab-content p-3" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-role" role="tabpanel" aria-labelledby="nav-role-tab">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-5">
                            <div id="role_create_form" class="card" style="width: 25rem;">
                                <div class="card-body">
                                    <form action="{{ route('create-role') }}" method="post" enctype="multipart/form"
                                        id="create_role_form">
                                        @csrf
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label for="name">Role Name : </label>
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Enter Name"><br>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary add_category">Save
                                                Role</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div id="role_edit_form" class="card d-none" style="width: 25rem;">
                                <div class="card-body">
                                    <form action="{{ route('role-update') }}" method="post" enctype="multipart/form"
                                        id="edit_role_form">
                                        @csrf
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label for="name">Role Name : </label>
                                                <input id="edit_role_input" type="text" class="form-control"
                                                    name="name" placeholder="Enter Name"><br>
                                                <input name="role_id" type="hidden" id="edit_role_id" value="">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <span id="role_cancel" class="btn btn-danger ">cancel
                                            </span>
                                            <button type="submit" class="btn btn-primary">Update
                                                Role</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">

                            <table class="table table-bordered data-table  table-striped data_table_role">
                                <thead class="badge-light">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
            <div class="tab-pane fade" id="nav-permission" role="tabpanel" aria-labelledby="nav-permission-tab">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-5">
                            <div id="permission_create_form" class="card" style="width: 25rem;">
                                <div class="card-body">
                                    <form action="{{ route('create-permission') }}" method="post" enctype="multipart/form"
                                        id="create_permission_form">
                                        @csrf
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label for="name">Permission Name : </label>
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Enter Name"><br>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary add_category">Save
                                                Role</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div id="permission_edit_form" class="card d-none" style="width: 25rem;">
                                <div class="card-body">
                                    <form action="{{ route('permission-update') }}" method="post"
                                        enctype="multipart/form" id="edit_permission_form">
                                        @csrf
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label for="name">Permission Name : </label>
                                                <input id="edit_permission_input" type="text" class="form-control"
                                                    name="name" placeholder="Enter Name"><br>
                                                <input name="permission_id" type="hidden" id="edit_permission_id"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <span id="permission_cancel" class="btn btn-danger ">cancel
                                            </span>
                                            <button type="submit" class="btn btn-primary">Update
                                                Permission</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">

                            <table class="table table-bordered data-table  table-striped data_table_permission"
                                style="width:100%;">
                                <thead class="badge-light">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-role_permission" role="tabpanel"
                aria-labelledby="nav-role_permission-tab">
                <div class="container-fluid">
                    <div class="row">
                        <form action="{{ route('roles.update', 3) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="d-flex flex-row ">
                                <div class="p-2 ">
                                    <div class="">
                                        <div class="card" style="width: 25rem;">
                                            <div class="card-body">
                                                <label for="name">user Name : </label>
                                                <select id="roleSelect" class="form-control mb-2 fw-bold" name="role_id">
                                                    <option value="" selected>--select role-- </option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select>

                                                {{-- @foreach ($roles as $role)

                                                    <a href="{{ route('roles.edit',$role->id) }}" class="btn btn-outline-primary">{{ $role->name }}</a>
                                                @endforeach --}}


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container px-5 mx-5 ">
                                    <div class="row">
                                        @foreach ($permissions as $permission)
                                            <div class="col-4">
                                                <input id="permission{{ $permission->id }}" class="form-check-input"
                                                    type="checkbox" name="permission[]" value="{{ $permission->id }}">
                                                <label class="form-check-label">{{ $permission->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary add_category">Save
                                Role permissions</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.common.modalmsg')
    <script>
        $(document).ready(function() {
            $('.data_table_role').DataTable({
                processing: true,
                serverside: true,
                ajax: {
                    url: "{{ route('role-table') }}"
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },


                ]
            });


           
            $('body').on('click', '#edit_role', function() {
                $('#edit_role_form')[0].reset();
                var userId = $(this).data("id");
                $('#role_edit_form').removeClass('d-none');
                $('#role_create_form').addClass('d-none');
                $.ajax({
                    type: 'get',
                    url: '/role-edit/' + userId,
                    success: function(data) {
                        console.log(data);
                        $('#edit_role_input').val(data.role.name);
                        $('#edit_role_id').val(userId);
                    },
                    error: function(error) {}
                });

            });

            $("#role_cancel").click(function() {
                $('#role_edit_form').addClass('d-none');
                $('#role_create_form').removeClass('d-none');
            });

            $('body').on('click', '#delete_role', function() {
                var userId = $(this).data("id");
                // window.location.href = '/role-delete/' + userId;
                $.ajax({
                    type: 'get',
                    url: '/role-delete/' + userId,
                    success: function(data) {
                        $('.data_table_role').DataTable().ajax.reload();
                        successModal(data.message);

                    },
                    error: function(error) {}
                });
            });

            $('.form-check-input').prop('checked', false);
            $('#roleSelect').change(function() {
                $('.form-check-input').prop('checked', false);

                var role_id = $(this).val();

                $.ajax({
                    type: 'get',
                    url: '/role_permission',
                    data: {
                        role_id: role_id
                    },
                    success: function(data) {


                        $(data.rolePermissions).each(function(id, permission) {

                            $('#permission' + permission).prop('checked', true);

                        });

                    },
                    error: function(error) {}
                });
            })

        });
    </script>
    <script>
        $(document).ready(function() {

            $('#create_role_form').ajaxForm({
                success: function(data) {
                    $('#create_role_form')[0].reset();
                    $('.data_table_role').DataTable().ajax.reload();
                    successModal(data.message);
                },
                error: function(data) {
                    errorModal(data);

                }

            })

            $('#create_permission_form').ajaxForm({
                success: function(data) {

                    $('#create_permission_form')[0].reset();
                    $('.data_table_permission').DataTable().ajax.reload();
                    successModal(data.message);
                },
                error: function(data) {
                    errorModal(data);

                }

            })
        });
    </script>
    <script>
        $('.data_table_permission').DataTable({
            processing: true,
            serverside: true,
            ajax: {
                url: "{{ route('permission-table') }}"
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },


            ]
        });
        $('body').on('click', '#edit_permission', function() {
            $('#edit_permission_form')[0].reset();
            var userId = $(this).data("id");
            $('#permission_edit_form').removeClass('d-none');
            $('#permission_create_form').addClass('d-none');
            $.ajax({
                type: 'get',
                url: '/permission-edit/' + userId,
                success: function(data) {
                    console.log(data);
                    $('#edit_permission_input').val(data.permission.name);
                    $('#edit_permission_id').val(userId);
                },
                error: function(error) {}
            });

        });

        $("#permission_cancel").click(function() {
            $('#permission_edit_form').addClass('d-none');
            $('#permission_create_form').removeClass('d-none');
        });

        $('body').on('click', '#delete_permission', function() {
            var userId = $(this).data("id");
            $.ajax({
                type: 'get',
                url: '/permission-delete/' + userId,
                success: function(data) {
                    $('.data_table_permission').DataTable().ajax.reload();
                    successModal(data.message);
                },
                error: function(error) {}
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            $('#edit_role_form').ajaxForm({
                success: function(data) {
                    $('#edit_role_form')[0].reset();
                    $('.data_table_role').DataTable().ajax.reload();
                    successModal(data.message);
                    $('#role_edit_form').addClass('d-none');
                    $('#role_create_form').removeClass('d-none');
                },
                error: function(data) {
                    errorModal(data);

                }

            })

            $('#edit_permission_form').ajaxForm({
                success: function(data) {

                    $('#edit_permission_form')[0].reset();
                    $('.data_table_permission').DataTable().ajax.reload();
                    successModal(data.message);
                    $('#permission_edit_form').addClass('d-none');
                    $('#permission_create_form').removeClass('d-none');
                },
                error: function(data) {
                    errorModal(data);

                }

            })
        });
    </script>
@endsection
