@extends('cfc.layouts.app')
@section('content')
    <div class="row">
        <div class="card">
            @if(\Illuminate\Support\Facades\Session::get('saved'))
                <div class="card-title red white-text" style="padding: 2%;">
                    {{\Illuminate\Support\Facades\Session::get('saved')}}
                </div>
            @else
                <div class="card-title blue lighten-1 white-text" style="padding: 2%;">
                    {{ $title }}
                </div>
            @endif
        </div>
        <div class="card">
            <div class="card-content">
                {!! $table !!}
            </div>
        </div>
    </div>
@endsection