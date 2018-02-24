@extends('cfc.layouts.app')
@section('content')
    <div class="row">
        @if($about->count() == 0)
            <div class="card">
                @if(\Illuminate\Support\Facades\Session::get('saved'))
                    <div class="card-title teal white-text" style="padding: 2%;">
                        {{\Illuminate\Support\Facades\Session::get('saved')}}
                    </div>
                @else
                    <div class="card-title blue lighten-1 white-text" style="padding: 2%;">
                        Add your contents for about page
                    </div>
                @endif
            </div>
            <div class="card">
                <div class="card-content">
                    <form action='{{url("cfc/about")}}' method="post">
                        {{csrf_field()}}
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
        @else
            <div class="card">
                <div class="card-title " style="padding: 2%;">
                   you have already set your about page. do you want make some change?
                    <a href="#" class="fa fa-edit teal-text"> click here to edit</a>
                </div>
            </div>
        @endif
    </div>
@endsection