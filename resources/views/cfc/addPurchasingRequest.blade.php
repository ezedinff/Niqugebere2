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
                <form action = '{{url("cfc/purchasing-request")}}' method = "POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="input-field">
                            <select id = "category" name="category" required>
                                <option value="" disabled selected>select product category</option>
                                @foreach(\App\ProductCategory::all() as $category )
                                    <option value="{{$category->id}}" >{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field">
                            <select id = "subcategory" name="subcategory" required>
                                <option value="" disabled selected>select product sub category</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input name="title" id="title" type="text" class="validate"  required>
                            <label for="subject">product name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input name="quantity" id="quantity" type="number" class="validate"  required>
                            <label for="quantity">Quantity</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m12 l12">
                            <input type="submit" value="Send" class="btn-large wave-effect wave-light blue white-text right">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection