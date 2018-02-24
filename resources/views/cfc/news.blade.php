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
                    post a news
                </div>
            @endif
        </div>
        <div class="card">
            <div class="card-content">
                <form action='{{url("cfc/news")}}' method="post">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="input-field">
                            <input type="text" id="title" name="title" class="validate">
                            <label for="title">news title</label>
                        </div>
                    </div>
                    <p style="font-weight: bold; color: #212121;">News body</p>
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