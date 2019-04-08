@extends('emails.layout')
@section('content')

    <tr>
        <td>
            <h2 style="font-size: 14px; font-weight: bold; margin: 20px 0 30px;">

                {!! $message !!}

            </h2>
        </td>
    </tr>

@endsection
