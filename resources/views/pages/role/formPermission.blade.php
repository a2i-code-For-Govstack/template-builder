{{-- new layout for yajra datatable --}}
@extends('layouts.yajraapp')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card shadow-lg">
                    <div class="card-body table-full-width table-responsive">

                        <div class="button-list-flex">
                            <h4> <strong class="text-primary">Form Permission LIST</strong></h4>
                        </div>
                        {{-- yajra datatable --}}
                        <div class="container">
                            <table class="table table-bordered data-table table-hover table-striped">
                                <thead class="badge-light">
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>SID</th>
                                    <th>Created By</th>
                                    <th>Updated By</th>
                                    <th>Is Editable</th>
                                    <th>Action </th>

                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.common.modalmsg')
    <script>
        // jquerey for yazra datatable

        $(document).ready(function() {
            $('.data-table').DataTable({
                processing: true,
                serverside: true,
                ajax: {
                    url: "{{ URL::to('form/form-permission/info') }}"
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'sid',
                        name: 'sid'
                    },
                    {
                        data: 'created_by',
                        name: 'created_by'
                    },
                    {
                        data: 'updated_by',
                        name: 'updated_by'
                    },
                    {
                        data: 'is_editable',
                        name: 'is_editable'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },


                ]
            })


        });


        $('body').on('click', '.edit', function() {
            var userId = $(this).data("id");
            window.location.href = '/form/form/' + userId + '/edit';
        });

        $('body').on('click', '.change_permission', function() {
            var userId = $(this).data("id");
            // window.location.href = '/form/form/' + userId + '/permission';
            $.ajax({
                type: "get",
                url: '/form/form/' + userId + '/permission',
                success: function(data) {
                    $('.data-table').DataTable().ajax.reload();
                    successModal(data.message);
                },
                error:function(data){
                    $('.data-table').DataTable().ajax.reload();
                    errorModal(data.message);
                }
            });
        });
    </script>
@endsection
