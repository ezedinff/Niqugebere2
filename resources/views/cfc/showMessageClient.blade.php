@extends('cfc.layouts.app')
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-content">
                <span> {{ucfirst($message->first_name)}}&nbsp;{{ucfirst($message->last_name)}}</span>
                <span class="right">
                    {{$message->created_at->diffForHumans()}}
                </span>
            </div>
            <div class="card-content">
                {!! $message->message !!}
               <br>        <br>        <br>
                @if($message->email != null)
                    <p><strong>Email:</strong> {{$message->email}}</p>
                @endif
                <p><strong>phone:</strong> {{$message->phone}}</p>
            </div>
        </div>
    </div>
@endsection