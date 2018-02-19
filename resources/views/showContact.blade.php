@extends('layouts.app')
@section('content')
    <header>
        <div id="head2">
            @include('showNavBar')
        </div>
    </header>
    <div class="row">
       <div class="container">
           <div class="card">
               @if(\Illuminate\Support\Facades\Session::get('saved'))
                   <div class="card-title teal white-text" style="padding: 2%;">
                       {{\Illuminate\Support\Facades\Session::get('saved')}}
                   </div>
               @else
                   <div class="card-title green center-align white-text" style="padding: 2%;">
                       {{ $title }}
                   </div>
               @endif
           </div>
           <div class="card">
               <div class="card-content green lighten-4">
                   <div class="row">
                       <form class="col s12" method="post" action={{url("/show-cfc/{$company->id}/contact-us")}} >
                           {{csrf_field()}}
                           <div class="row">
                               <div class="input-field col m6 s12">
                                   <input name="first" id="first_name" type="text" class="validate">
                                   <label for="first_name">First Name</label>
                               </div>
                               <div class="input-field col m6 s12">
                                   <input name="last" id="last_name" type="text" class="validate">
                                   <label for="last_name">Last Name</label>
                               </div>
                           </div>
                           <div class="row">
                               <div class="input-field col m6 s12">
                                   <input name="email" id="email" type="email" class="validate" required>
                                   <label for="email">Email</label>
                               </div>
                               <div class="input-field col m6 s12">
                                   <input name="phone" id="phone" type="tel" class="validate">
                                   <label for="phone">phone</label>
                               </div>
                           </div>
                           <div class="row">
                               <div class="input-field col s12">
                                   <textarea name="message" id="message" class="materialize-textarea"></textarea>
                                   <label for="message">Message</label>
                               </div>
                           </div>
                           <div class="row">
                               <div class="input-field">
                                   <input type="submit" class="right btn green white-text" value="send">
                               </div>
                           </div>
                       </form>
                   </div>
               </div>
           </div>
       </div>
    </div>
@endsection