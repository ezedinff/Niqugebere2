@extends('layouts.app')
@section('content')
    <main>
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
                <div class="card">
                    <div class="card-title green darken-1 center white-text" style="padding: 2%;">
                        {{$title}}
                    </div>
                </div>
                <div class="col l3 m3 s12">
                    <div class="card">
                        <div class="card-content no-padding">
                            <ul class="collection">
                                @foreach($services as $service)
                                    <li class="collection-item"><a href='{{url("cfc/service/$service->id")}}' class="green-text">{{$service->title}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @if($ser != null)
                <div class="col l9 m9 s12">
                        <div class="card">
                            <div class="card-title" style="padding: 2%; padding-bottom: 0;">
                                {{$ser->title}}
                                <br> <label class="right">posted by {{$ser->company}}</label>
                                <br> <label class="right">{{\Carbon\Carbon::createFromTimeStamp(strtotime($ser->created_at))->diffForHumans()}}</label>
                            </div>
                            <div class="card-content" id="posted-content">
                                {!! $ser->description !!}
                            </div>
                        </div>
                </div>
                @else
                    <div class="card">
                        <div class="card-title blue darken-1 white-text" style="padding: 2%;">
                            there is no posted service in this category
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>
@endsection