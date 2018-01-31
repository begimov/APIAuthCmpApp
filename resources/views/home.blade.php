@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Messages</div>

                <div class="panel-body">
                    @if (Auth::user()->token)
                        @foreach ($messages as $msg)
                        <p>{{ $msg->body }}</p>
                        @endforeach
                    @else
                        <p><a href="{{ url('/auth/main') }}">Authorize</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
