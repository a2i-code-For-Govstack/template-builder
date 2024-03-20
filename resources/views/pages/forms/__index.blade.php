@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card shadow-lg">
                    <div class="card-body table-full-width table-responsive">

                        <div class="button-list-flex">
                            <h4> <strong class="text-primary">Form LIST</strong></h4>

                            <a href="{{ route('form.create') }}">
                                <button class="btn btn-primary float-end" href>
                                    Create New Form
                                </button>
                            </a>
                        </div>

                        <table class="table table-hover table-striped">
                            <thead class="badge-light">
                            <th>ID</th>
                            <th>Title</th>
                            <th>SID</th>
                            <th>Action </th>

                            </thead>
                            <tbody>
                            @forelse($forms as $form)
                                <tr>
                                    <td>{{$form->id}}</td>
                                    <td>{{$form->title}}</td>
                                    <td>{{$form->sid}}</td>
                                    <td>
                                        <a href="{{ route('form.edit',[$form->id]) }}" title="Edit">
                                            <button class="btn btn-outline-primary btn-sm">
                                                <i class='bx bxs-edit-alt bx-flashing' style='color:#0a36f3'  ></i>
                                            </button>
                                        </a>
                                        <form method="POST" action="{{ route('form.destroy' ,  [$form->id]) }}"
                                              accept-charset="UTF-8" style="display:inline">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger btn-sm d-none"
                                                    title="Delete Form"
                                                {{-- onclick="return confirm(&quot;Confirm delete?&quot;)"--}}
                                            >
                                                <i class='bx bx-trash-alt bx-flashing' style='color:#f30a0a' ></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="4">No data found</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {!! $forms->links() !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
