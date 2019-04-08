@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <span style="font-size: 20px;color:#4dc0b5;"><strong>Subscribtions</strong></span>
                        <div style="float: right;margin-top: -8px !important;margin-right: 10px;" class="row">
                            <a href="{{ route('admin.subscribtions') }}"
                               class="mx-sm-3 mb-2 btn btn-outline-info btn-sm">Back
                            </a>
                        </div>
                    </div>

                    <div class="panel-body">


                        <form method="post" action="{{ route('admin.post.email') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="message" class="form-label col-md-12">{{ __('Message Body') }}</label>

                                <div class="col-md-12">
                                    <textarea placeholder="Write message body!" id="message_area" class=" message form-control{{ $errors->has('message') ? ' is-invalid' : '' }}" name="message" required min="10" rows="20">
                                        {!! old('message') !!}
                                    </textarea>

                                    @if ($errors->has('message'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('message') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection

@section('scripts')
    <script  src="{{ asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js') }}" ></script>
    <script  src="{{ asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js') }}" ></script>
    <script type="text/javascript">
        $(document).ready(function(){
       $('#message_area').ckeditor();
       });


    </script>
@endsection


