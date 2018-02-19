@extends('cfc.layouts.app')
@section('content')
    <div class="row">
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
    </div>
    <div class="row">
        <div class="card">
            <div class="card-content">
                <form action = '{{url("cfc/service")}}' method = "POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="input-field">
                            <select id = "category" name="category" required>
                                <option value="" disabled selected>select service category</option>
                                @foreach(\App\ServiceCategory::all() as $category )
                                    <option value="{{$category->id}}" >{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field">
                            <input type="text" id="title" name="title" class="validate">
                            <label for="title">title</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field">
                            <textarea name="text" id="editor" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field">
                            <textarea name="text" id="editor" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field">
                            <input type="submit" class="right btn blue white-text" value="post">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection