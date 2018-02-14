@extends('layouts.app')
@section('content')

    <?php
        $i = 1;
       $categories = \App\Category::all();
       $products = \App\ProductCategory::all();
       $regions = \App\Region::all();
        ?>
    <div class="container" ng-app="register">
        <div class="row" ng-controller="maincontroller">
            <div class="card">
                <div class="card-title green lighten-2 white-text" style="padding: 2%;">
                    <% title %>
                </div>
            </div>
            <p>Fields marked with <sup class="fa fa-asterisk fa-spin red-text"></sup> are mandatory.</p>
            <form action="{{url('/register-company')}}" method="post">
                {{csrf_field()}}
                <div class="card">
                        <div class="row">
                            <div class="card-content col s12 m12 l12">
                                @foreach($categories as $category)
                                    <span class="col l3 m3 s12">
                                        <input id="{{$i}}" type="radio" class="with-gap" name="category" value="{{$i}}" ng-model="category"  ng-change = "decideCategory(category)">
                                        <label for="{{$i}}">{{$category->name}}</label>
                                    </span>
                                    <?php $i++; ?>
                                @endforeach
                                @if($errors->has('category'))
                                    <span class="help-block">
                                       <strong>{{ $errors->first('category') }}</strong>
                                     </span>
                                @endif
                            </div>
                            <div class="card-content" ng-show="decide">
                                <div class="row">
                                    <div class="input-field col s12 m12">
                                        <select name="product">
                                            <option value="" disabled selected>Select a category</option>
                                            @foreach($products as $product)
                                                <option value="{{$product->id}}">{{$product->name}}</option>
                                            @endforeach
                                        </select>
                                        <label>what do you supply? . <sup class="fa fa-asterisk fa-spin red-text"></sup></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="card" ng-show="formDisplay">
                    <div class="card-content">
                        <div class="row">
                            <div class="input-field col s12 m12" style="padding: 0; margin: 0;">
                                <input id="name" type="text" class="validate" name="name">
                                <label for="name" data-error="wrong" data-success="right">Name of the company <sup class="fa fa-asterisk red-text" ></sup></label>
                                @if ($errors->has('name'))
                                    <span class="help-block red-text">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m12" style="padding: 0; margin: 0;">
                                <input id="tin" type="number" class="validate" name="tin">
                                <label for="tin" data-error="wrong" data-success="right">TIN number <sup class="fa fa-asterisk red-text"></sup></label>
                                @if ($errors->has('tin'))
                                    <span class="help-block red-text">
                                        <strong>{{ $errors->first('tin') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m12" style="padding: 0; margin: 0;">
                                <input name="phone" id="phone" type="number" class="validate" >
                                <label for="phone" data-error="wrong" data-success="right">phone number <sup class="fa fa-asterisk red-text"></sup></label>
                                @if ($errors->has('phone'))
                                    <span class="help-block red-text">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m12">
                                <select name="region" class="regions" required>
                                    <option value="" disabled selected>Select a region</option>
                                    @foreach($regions as $region)
                                        <option tmp_id="{{$region->id}}" value="{{$region->id}}">{{$region->name}}</option>
                                    @endforeach
                                </select>
                                <label>select a region . <sup class="fa fa-asterisk fa-spin red-text"></sup></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m12">
                                <select name="zone" id="zone" required></select>
                                <label>select a zone/sub-city . <sup class="fa fa-asterisk fa-spin red-text"></sup></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m12">
                                <select name="woreda" id="woreda" required></select>
                                <label>select a woreda/kebele . <sup class="fa fa-asterisk fa-spin red-text"></sup></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m12" style="padding: 0; margin: 0;">
                                <input id="special" type="text" class="validate" name="special">
                                <label for="special" data-error="wrong" data-success="right">special name of the place <sup class="fa fa-asterisk red-text" ></sup></label>
                                @if ($errors->has('name'))
                                    <span class="help-block red-text">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-title green lighten-2" style="padding: 2%; color: #fff;">
                                Your Contact details
                            </div>
                        </div>
                        <p style="color:red;">Your information will not be visible to site-visitors. Contact will be established through phone number only.</p>
                        <div>
                            <div class="card-content">
                                <div class="row">
                                    <div class="input-field col s12 m12" style="padding: 0; margin: 0;">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input id="first_name" type="text" class="validate" name="first_name">
                                        <label for="first_name" data-error="wrong" data-success="right">First Name <i class="fa fa-asterisk red-text"></i></label>
                                        @if ($errors->has('first_name'))
                                            <span class="help-block red-text">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12 m12" style="padding: 0; margin: 0;">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input id="lastname" type="text" class="validate" name="last_name">
                                        <label for="lastname" data-error="wrong" data-success="right">Last Name <i class="fa fa-asterisk red-text" ></i></label>
                                        @if ($errors->has('last_name'))
                                            <span class="help-block red-text">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12 m12" style="padding: 0; margin: 0;">
                                        <i class="material-icons prefix">phone</i>
                                        <input id="phoneu" type="number" class="validate" name="phoneu">
                                        <label for="phoneu" data-error="wrong" data-success="right">phone number <i class="fa fa-asterisk red-text"></i></label>
                                        @if ($errors->has('phoneu'))
                                            <span class="help-block red-text">
                                                <strong>{{ $errors->first('phoneu') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12 m12" style="padding: 0; margin: 0;">
                                        <i class="material-icons prefix">lock</i>
                                        <input id="passowrd" type="password" class="validate" name="password">
                                        <label for="password" data-error="wrong" data-success="right">password <i class="fa fa-asterisk red-text"></i></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m12 l12">
                                <input type="submit" value="register" class="btn-large wave-effect wave-light teal white-text right">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script>
        $(function () {
            $(".regions").change(function () {
                var woreda_id = $(this).find("option:selected").attr('tmp_id');
                $.ajax({
                    type:'get',
                    url:"{{url('/zone')}}",
                    data:{'id':woreda_id},
                    success:function (data) {
                        var elem = "<option value=\"\" disabled selected>" + "Select a zone/sub-city" + "</option>" ;
                        for (var i=0;i<data.length;i++){
                            elem = elem + '<option tmp_id="'+data[i].id+'" value="'+data[i].id+'">'+data[i].name+'</option>';
                            $("#zone").html(elem);
                        }
                        $("#zone").material_select();
                    }
                });
            });
            $("#zone").change(function () {
                var woreda_id = $(this).find("option:selected").attr('tmp_id');
                $.ajax({
                    type:'get',
                    url:"{{url('/woreda')}}",
                    data:{'id':woreda_id},
                    success:function (data) {
                        var elem = "<option value=\"\" disabled selected>" + "Select a woreda/kebele" + "</option>" ;
                        for (var i=0;i<data.length;i++){
                            elem = elem + '<option tmp_id="'+data[i].id+'" value="'+data[i].id+'">'+data[i].name+'</option>';
                            $("#woreda").html(elem);
                        }
                        $("#woreda").material_select();
                    }
                });
            });
        });
    </script>
@endsection
