{{-- new layout for yajra datatable --}}
@extends('layouts.yajraapp')

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card shadow-lg">
                    <div class="card-body table-full-width table-responsive">

                        <div class="button-list-flex">
                            <h4> <strong class="text-primary">Form LIST</strong></h4>
                            @canany(['form-create'])
                            <a href="{{ route('form.create') }}">
                                <button class="btn btn-primary mb-2 float-end" href>
                                    Create New Form
                                </button>
                            </a>
                            @endcanany
                        </div>
                        {{-- yajra datatable --}}
                        <div class="container">
                            <table id="user-table" class="table table-bordered data-table table-hover table-striped">
                                <thead class="badge-light">
                                    <th>ID</th>
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
    <script>
        // jquerey for yazra datatable

        $(document).ready(function() {
            $('.data-table').DataTable({
                processing: true,
                serverside: true,
                ajax: {
                    url: "{{ URL::to('/form/form') }}"
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'form_log',
                        name: 'form_log'
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
            var userId = $(this).data("id");
            window.location.href = 'form/'+ userId+'/edit';
        });
        $('body').on('click', '.see_logs', function() {
            var userId = $(this).data("id");
            window.location.href = 'form-update-log-list/'+ userId;

        });

        $('body').on('click', '.preview', function() {
            var userId = $(this).data("id");
            window.location.href = '/form/pdf/show/'+ userId;

        });
    </script>
    {{-- <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    
            // delete category data
    
            $('body').on('click', '.preview', function() {
                
                var userId = $(this).data("id");
                
                $.ajax({
                    type: 'post',
                    url: "{{ url('api/form/log/update-api/') }}",
                    data: {
                        id: userId,
                        previewContent:true
                    },
                    dataType: "json",
                    success: function(response) {
                       return response;
                    }
                });
    
            })
    
        });
    </script> --}}
@endsection

