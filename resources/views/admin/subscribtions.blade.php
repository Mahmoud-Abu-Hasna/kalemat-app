@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <span style="font-size: 20px;color:#4dc0b5;"><strong>Subscribtions</strong></span>
                        <div style="float: right;margin-top: -8px !important;margin-right: 10px;" class="row">
                            <a href="{{ route('admin.send.email') }}"
                               class="mx-sm-3 mb-2 btn btn-outline-info btn-sm">Send Emails To Subscribers
                            </a>
                            <form class="mx-sm-3 mb-2 form-inline">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-search"></i></div>
                                        </div>
                                        <input type="text" name="name" id="name" placeholder="Search"
                                               class="form-control form-control-sm"></div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="panel-body">


                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>E-Mail</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($subscribtions as $subscribtion)
                                <tr>
                                    <th scope="row">{{ $subscribtion->id }}</th>
                                    <td class="email">{{ $subscribtion->email }}</td>
                                </tr>
                            @empty
                                <tr>

                                    <td colspan="2">No Subscriptions are Provided</td>

                                </tr>

                            @endforelse
                            </tbody>
                        </table>
                        @if(count($subscribtions))
                            {{ $subscribtions->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection

