@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Dashboard
                        <button type="button" style="float: right;" class="btn btn-info btn-sm full-title" data-toggle="modal" data-target="#addNotification" data-toggle="tooltip" data-title="Notify Users"><i class="fa fa-phone"></i></button>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <div class="row text-center">
                                <div class="col">
                                    <div class="counter">
                                        <i class="fa fa-code fa-2x"></i>
                                        <h2 class="timer count-title count-number" data-to="{{ $quotes }}" data-speed="1500"></h2>
                                        <p class="count-text ">Quotes</p>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="counter">
                                        <i class="fa fa-user fa-2x"></i>
                                        <h2 class="timer count-title count-number" data-to="{{ $users }}" data-speed="1500"></h2>
                                        <p class="count-text ">Users</p>
                                    </div>
                                </div>
                            </div>
                           <br>
                           <br>
                           <br>
                        <div class="row text-center">

                                <table class="table table-bordered table-hover table-responsive-lg">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Quote Ar</th>
                                        <th>Quote En</th>
                                        <th>Category</th>
                                        <th>Favorites</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($fav_quotes as $quote)
                                        <tr>
                                            <th scope="row">{{ $quote->id }}</th>
                                            <td class="quote_ar full-title" data-toggle="tooltip" data-title="{{ $quote->quote_ar }}">{{ str_limit($quote->quote_ar,20) }}</td>
                                            <td class="quote_en full-title" data-toggle="tooltip" data-title="{{ $quote->quote_en }}">{{ str_limit($quote->quote_en,20) }}</td>
                                            <td class="name_ar">{{ $quote->category->name_ar }}</td>
                                            <td class="fave">{{ $quote->fave }}</td>
                                        </tr>
                                    @empty
                                        <tr>

                                            <td colspan="5">No Quotes are Provided</td>

                                        </tr>

                                    @endforelse
                                    </tbody>
                                </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="addNotification" class="modal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Send Notifications</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" enctype="multipart/form-data" action="{{ route('notify') }}">
                    <div class="modal-body">

                        @csrf
                        <div class="form-group">
                            <label for="title_ar" class="col-form-label">Title AR:</label>
                            <input dir="rtl" type="text" name="title_ar" class="form-control" id="title_ar" value="{{ old('title_ar') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="title_en" class="col-form-label">Title EN:</label>
                            <input type="text" name="title_en" class="form-control" id="title_en"  value="{{ old('title_en') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="body_ar" class="col-form-label">Body AR:</label>
                            <input  dir="rtl" type="text" name="body_ar" class="form-control" id="body_ar" value="{{ old('body_ar') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="body_en" class="col-form-label">Body EN:</label>
                            <input type="text" name="body_en" class="form-control" id="body_en"  value="{{ old('body_en') }}" required>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" >Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <link href="{{ asset('css/counter.css') }}" rel="stylesheet">
    <script  type="text/javascript" rel="script" src="{{ asset('js/counter.js') }}"></script>

@endsection
