@extends('layouts.app')
@section('content')
    <header>
        <div id="head2">
            @include('showNavBar')
        </div>
    </header>
    <div class="row">
        @foreach($product_categories as $product_category)
            <a style="text-decoration: none; outline: none;" href='{{url("/show-cfc/{$company->id}/products/{$product_category->name}")}}' class="col l4 m4 s12" >
                <div class="card" >
                    <div class="card-image" style="max-height: 10em !important;">
                        <?php $photo = $product_category->product_photo; ?>
                        <img src='{{asset("$photo")}}' alt="">
                    </div>
                    <div class="card-action center">
                        {{$product_category->name}}
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endsection