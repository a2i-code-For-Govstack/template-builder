{{-- new layout for yajra datatable --}}
@extends('layouts.yajraapp')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card shadow-lg">
                    <div class="card-body table-full-width table-responsive">

                        <div class="button-list-flex">
                            <h4> <strong class="text-primary">Template Log-Info</strong></h4>

                        </div>

                        {{-- yajra datatable  --}}
                        <div class="container">
                            <table id="user-table" class="table table-bordered data-table table-hover table-striped">
                                <thead class="badge-light">
                                    <th>ID</th>
                                    <th>SID</th>
                                    <th>AID</th>

                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>View Content</th>

                                </thead>
                                <tbody>
                                    {{-- @foreach ($data as $temp_data)
                                        <tr>
                                            <td>{{ $temp_data->id }}</td>
                                            <td>{{ $temp_data->sid }}</td>
                                            <td>{{ $temp_data->aid }}</td>
                                            <td>{{ $temp_data->formID }}</td>
                                            <td>{{ $temp_data->created_at }}</td>
                                            <td>{{ $temp_data->updated_at }}</td>
                                            <td>
                                                <a  href="{{ route('log.show', $temp_data->id) }}"
                                                    class="btn btn-sm btn-outline-info "><i class="bx bx-show bx-rotate-180 bx-flashing" style="color:#2e4d96"></i></a>
                                            </td>
                                        </tr>

                                    @endforeach
                                <tr>

                                </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- <div class="d-flex justify-content-center">{{ $data->links() }}</div> --}}

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
                    url: "{{ URL::to('form/log/info') }}"
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'sid',
                        name: 'sid'
                    },
                    {
                        data: 'aid',
                        name: 'aid'
                    },
                   
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',

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


        $('body').on('click', '.view', function() {
        var userId = $(this).data("id");
        window.location.href = 'show/'+ userId;
    });
    </script>
@endsection
