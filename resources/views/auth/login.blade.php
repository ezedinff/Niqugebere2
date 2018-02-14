@extends('layouts.app')
@section('content')
    <style>
        body{
            background-color: #66BB6A;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col l4 m4 s10 offset-m4 offset-l4 offset-s1 no-padding" >
                <form class="col s12 m12 no-padding center" role="form"  method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class="card z-depth-5">
                        <div class="card-content center" >
                           <div class="row">
                                <div class="col l5 m8 offset-m2">
                                    <img src="{{asset('img/logo.png')}}" style="margin-left: 25%; margin-bottom: 15%; height: 64px; width: 148px;"/>
                                </div>
                           </div><br><br><br>
                            <div class="text_b">{{trans("translations.login")}}</div>
                            <div class="row">
                                <div class="input-field col s12 m12 {{ $errors->has('email') ? ' has-error' : '' }}" style="padding-left: 0;">
                                    <i class="material-icons prefix">person_outline</i>
                                    <input id="tin" type="number" class="validate" name="email">
                                    <label for="tin" data-error="wrong" data-success="right">Tin/phone number<sup class="fa fa-asterisk" style="color: red;"></sup></label>
                                    @if ($errors->has('email'))
                                        <span class="help-block red-text">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m12 {{ $errors->has('password') ? ' has-error' : '' }}" style="padding: 0; margin: 0;">
                                    <i class="material-icons prefix">lock_outline</i>
                                    <input id="password" type="password" class="validate" name="password">
                                    <label for="password" data-error="wrong" data-success="right">password <sup class="fa fa-asterisk" style="color: red;"></sup></label>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12">
                                    <input type="checkbox" id="remember" {{ old('remember') ? 'checked' : '' }} style="float: left;" class="checkbox-indigo"/>
                                    <label for="remember" style="float: left;">Remember me</label>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="input-field col s12 m12 " >
                                    <input type="submit" class="btn waves-effect waves-light teal lighten-1 col s12 m12" value="Login">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection