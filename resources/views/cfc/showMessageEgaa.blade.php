@extends('cfc.layouts.app')
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-title blue white-text" style="padding: 2%;">
                {{$message->subject}}
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                {!! $message->message !!}
            </div>
        </div>
    </div>
@endsection