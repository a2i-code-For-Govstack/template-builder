@extends('layouts.app')
@push('styles')
    <style>
        footer {
            position: relative !important;
        }

        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali&display=swap');
    </style>
@endpush

@section('content')
    <div class="container" style="font-family: 'Noto Sans Bengali', sans-serif;
    ">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card shadow-lg">
                    <div class="card-body table-full-width table-responsive">

                        <div class="button-list-flex">
                            <h4> <strong class="text-primary">Template Content</strong></h4>
                        </div>
                        {!! $pdfImage !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
