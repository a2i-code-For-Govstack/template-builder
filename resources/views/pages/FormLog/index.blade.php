{{-- new layout for yajra datatable --}}
@extends('layouts.yajraapp')

@section('content')
    <input type="hidden" value="{{ $id }}" id="form_val">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card shadow-lg">
                    <div class="card-body table-full-width table-responsive">

                        <div class="button-list-flex">
                            <div class="container">
                                <h4> <strong class="text-primary">Form Update Log</strong></h4>

                            </div>

                        </div>
                        {{-- yajra datatable --}}
                        <div class="container">
                            <table id="user-table" class="table table-bordered data-table table-hover table-striped">
                                <thead class="badge-light">
                                    <th>ID</th>
                                    <th>VERSION</th>
                                    <th>Title</th>
                                    <th>SID</th>
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
            var form_id = $('#form_val').val();
            $('.data-table').DataTable({
                processing: true,
                serverside: true,

                ajax: {
                    url: `/form/form-update-log-list/${form_id}`,
                    type: 'GET',
                },

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'id',
                        name: 'id'
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
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },


                ]
            })



        });

        $('body').on('click', '.edit', function() {

            var formlogId = $(this).data("id");
            window.location.href = '/form/edit-form-update-log-list/'+formlogId;
        });

        $('body').on('click', '.set_to_live', function() {
            var formlogId = $(this).data("id");

            $.ajax({
                type: "get",
                url: '/form/form-update-log-set-live/'+formlogId,
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
    <script>

    </script>
@endsection
