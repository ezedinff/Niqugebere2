@extends('cfc.layouts.app')
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-title blue white-text" style="padding: 2%;">Post your services</div>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-content">
                <form action = "" method = "POST" enctype="multipart/form-data">
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
                            <textarea name="text" id="" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection