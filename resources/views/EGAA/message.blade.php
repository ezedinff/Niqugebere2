@extends('EGAA.layouts.app')
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
                <form action='{{url("/admin-egaa/send-message")}}' method="post">
                    {{csrf_field()}}
                   <div class="row">
                       <div class="col l2 m2 s12">
                           <label for="" style="font-weight: bold; color: #212121;">To:</label>
                       </div>
                       <div class="col l10 m10 s12" >
                           <div class="row" style="overflow-y: auto; max-height: 10em;">
                               @foreach($companies as $company )
                                   <p>
                                        <input type="checkbox" id="{{$company->id}}" name="to[]" value="{{$company->id}}"/>
                                        <label for="{{$company->id}}">{{$company->name}}</label>
                                   </p>
                               @endforeach
                           </div>
                       </div>
                   </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input name="subject" id="subject" type="text" class="validate" value="" required>
                            <label for="subject">subject</label>
                        </div>
                    </div>
                    <div class="row">
                        <label for="" style="font-weight: bold; color: #212121;">Message:</label>
                        <div class="input-field">
                            <textarea name="message" id="editor" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="submit" class="btn blue white-text right" value="send">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection