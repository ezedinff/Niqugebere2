@extends('layouts.app')
@section('content')
    <header>
        <div id="head2">
            @include('showNavBar')
        </div>
    </header>
    <style>
        img{
            z-index: 0;
        }
        #posted-content{
            min-height: 20em;
        }
    </style>
    <div class="row">
        <div class="container">
            <div class="col l3 m3 s12">
                <div class="card">
                    <div class="card-content no-padding">
                        <ul class="collection">
                            <li class="collection-header">Recent posts</li>
                            @foreach($services as $service)
                                <li class="collection-item"><a href='{{url("cfc/service/$service->id")}}' class="green-text">{{$service->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col l9 m9 s12">
                <div class="card">
                    <div class="card-title" style="padding: 2%; padding-bottom: 0;">
                        {{$services->first()->title}}
                        <br> <label class="right" style="color: #212121;">{{\Carbon\Carbon::createFromTimeStamp(strtotime($services->first()->created_at))->diffForHumans()}}</label>
                    </div>
                    <div class="card-content" id="posted-content">
                        {!! $services->first()->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection