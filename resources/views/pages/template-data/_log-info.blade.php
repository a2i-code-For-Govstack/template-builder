@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card shadow-lg">
                    <div class="card-body table-full-width table-responsive">

                        <div class="button-list-flex">
                            <h4> <strong class="text-primary">Template Log-Info</strong></h4>

                        </div>

                        <table class="table table-hover table-striped">
                            <thead class="badge-light">
                            <th  >ID</th>
                            <th>SID</th>
                            <th>AID</th>
                            <th>FID</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>View Content</th>

                            </thead>
                            <tbody>
                            @forelse($logs as $log)
                                <tr>
                                    <td>{{$log->id}}</td>
                                    <td>{{$log->sid}}</td>
                                    <td>{{$log->aid}}</td>
                                    <td>{{$log->fid}}</td>
                                    <td>{{$log->created_at}}</td>
                                    <td>{{$log->updated_at}}</td>
                                    <td>
                                        <a href="{{ route('log.show',[$log->id]) }}" title="View Content">
                                            <button class="btn btn-outline-primary btn-sm">
                                                <i class='bx bx-show bx-rotate-180 bx-flashing' style='color:#2e4d96'></i></button>
                                        </a>
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="7">No data found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {!! $logs->links() !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
