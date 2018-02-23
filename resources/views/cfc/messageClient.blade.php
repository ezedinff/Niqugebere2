@extends('cfc.layouts.app')
@section('content')
    <style>
        a{
            text-decoration: none;

        }
        .collection-item:hover{
            background-color: #bbdefb !important;
        }
        .truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
    <div class="row">
        <div class="collection with-header">
            <div class="card">
                <div class="card-title blue white-text" style="padding: 2%;">
                    Inbox messages
                </div>
            </div>
            @foreach($messages as $message)
                <a href='{{url("cfc/message-from-client/{$message->id}")}}' class="collection-item message" style="color: #212121;   min-height: 4em; border-bottom: 1px solid #b6b6b6;">
                    <span class="col s2">{{ucfirst($message->first_name)}}&nbsp;{{ucfirst($message->last_name)}}</span>
                    <span class="col s8 truncate">{{  $message->message}}</span>
                    <span class="col s2">{{  $message->created_at->diffForHumans()}}</span>
                </a>
            @endforeach
        </div>
    </div>
@endsection