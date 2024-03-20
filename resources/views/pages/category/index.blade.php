{{--  list for category data --}}
{{-- yajra datatable layout --}}
@extends('layouts.yajraapp')

@section('content')

    {{-- add tostr mgs into the home page --}}
    <div class="errmsg"></div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card shadow-lg">
                    <div class="card-body table-full-width table-responsive">

                        <div class="button-list-flex">
                            <h4> <strong class="text-primary">Category LIST</strong></h4>

                            @canany(['category-create'])
                            <button class="btn btn-primary mb-2 float-end" data-bs-toggle="modal" data-bs-target="#addModal">
                                Create New Category
                            </button>
                            @endcanany

                        </div>
                        {{-- yajra datatable --}}
                        <div class="container">

                            <table id="user-table" class="table table-bordered data-table table-hover table-striped">
                                <thead class="badge-light">
                                    <th>ID</th>
                                    <th>Title</th>
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
    {{-- create category modal --}}
    @include('pages.category.modal')
    {{-- update category modal --}}
    @include('pages.category.update')
    {{-- alert modal msg modal and js --}}
    @include('layouts.common.modalmsg')



    <script>
        // jquerey for yazra datatable

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // yajra datatable

            $('.data-table').DataTable({
                processing: true,
                serverside: true,
                ajax: {
                    url: "{{ URL::to('/category/list') }}"
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
            })

            // add category data

            $('.add_category').click(function(e) {
                e.preventDefault();
                let name = $('#name').val();


                $.ajax({
                    type: "post",
                    url: "{{ url('/category/create') }}",
                    data: {
                        name: name,
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        if (response.status == 'success') {
                            $('#addModal').modal('hide');

                            $('.data-table').DataTable().ajax.reload();
                        }
                        $('#exampleModal')[0].reset();
                        successModal(response.message);
                        $('.data-table').DataTable().ajax.reload();
                    },
                    error: function(err) {
                        if (err) {
                            let message = "The title field is required"
                            customErrorModal(message);
                        }
                        // let error = err.responseJSON;
                        // $.each(error.errors, function(index, value) {
                        //     $('.errmsg').append('<span class="text-danger">' + value +
                        //         '</span>' + '<br>');
                        // })
                    }
                });

            });

            // delete category data

            // $('body').on('click', '.delete_category', function() {

            //     let category_id = $(this).data('id');

            //     $.ajax({
            //         type: 'get',
            //         url: "{{ url('/category/delete') }}",
            //         data: {
            //             category_id: category_id
            //         },
            //         dataType: "json",
            //         success: function(response) {
            //             console.log(response);
            //             if (response.status == 'success') {
            //                 $('.data-table').DataTable().ajax.reload();

            //             }
            //         }
            //     });

            // })


            // edit category form data

            $('body').on('click', '.edit_category', function() {

                let category_id = $(this).data('id');

                $.ajax({
                    type: 'get',
                    url: "{{ url('/category/edit') }}",
                    data: {
                        category_id: category_id
                    },
                    dataType: "json",
                    success: function(response) {
                        $('#up_id').val(response.id);
                        $('#up_name').val(response.name);
                    }
                });

            })

            // update the selected data

            $('body').on('click', '.up_category', function(e) {
                e.preventDefault();
                let id = $('#up_id').val();
                let name = $('#up_name').val();

                $.ajax({
                    type: "post",
                    url: "{{ url('/category/update') }}",
                    data: {
                        id: id,
                        name: name,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 'success') {
                            $('#updateModal').modal('hide');
                            $('#updatemodelform')[0].reset();
                            $('.data-table').DataTable().ajax.reload();
                        }
                        successModal(response.message);
                        $('.data-table').DataTable().ajax.reload();
                    },

                });

            });



        });
    </script>
@endsection
