@extends('pages.forms.ifarem-template.iframe-template')
@section('content')

                        <!--begin::Form-->
                        <form action="{{route('log.update',$logdata->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            <div class="card-body ps-0">
                                <label for="content" class="form-control-label fw-bold">Form Content: </label>
                                <textarea name="content" id="content">
                                      {{old('content', $logdata->content)}}
                                    </textarea>

                                @if ($errors->has('content'))
                                    <div class="error text-danger fw-bold">{{ $errors->first('content') }}</div>
                                @endif

                            </div>

                            <div class="col-sm-12 col-md-6">
                                <button type="submit" class="btn btn-success btn-flex"><i class="fa fa-save"></i>
                                    Save</button>
                            </div>

                        </form>
                        <!--end::Form-->

@endsection
