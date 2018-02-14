@extends('transporter.layouts.app')
@section('content')
    <div class="card">
        @if(\Illuminate\Support\Facades\Session::get('saved'))
            <div class="card-title teal white-text" style="padding: 2%;">
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
                <form action='{{url("/transporter/transportation")}}' method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="input-field">
                            <select id = "category" name="category" required>
                                <option value="" disabled selected>select transportation category</option>
                                @foreach(\App\TransportationCategory::all() as $category)
                                    <option value='{{$category->id}}'>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field">
                            <select id = "vehicle" name="vehicle" required>
                                <option value="" disabled selected>select vehicle</option>
                                @foreach(\App\Vehicle::where('company_id',auth()->user()->company_id)->get() as $category)
                                    <option value='{{$category->id}}'>vehicle identified by {{$category->plate_no}} plate number</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field">
                            <select id = "path" name="path" required>
                                <option value="" disabled selected>select path</option>
                                @foreach(\App\Path::all() as $category)
                                    <option value='{{$category->id}}'>{{$category->start}} - {{$category->end}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m12 l12">
                            <input type="submit" value="save" class="btn-large wave-effect wave-light blue white-text right">
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection