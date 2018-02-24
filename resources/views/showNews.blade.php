@extends('layouts.app')
@section('content')
    <header>
        <div id="head2">
            @include('showNavBar')
        </div>
    </header>
    <style>
        p{
            position: relative;
        }
        p img{
            position: relative !important;
        }
    </style>
    <div class="row">
        <div class="container">
            <div class="card">
                <div class="card-content">
                    {!! $news[0]->description !!}
                </div>
            </div>
        </div>
    </div>
@endsection