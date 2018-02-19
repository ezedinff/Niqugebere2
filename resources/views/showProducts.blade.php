@extends('layouts.app')
@section('content')
    <header>
        <div id="head2">
            @include('showNavBar')
        </div>
    </header>
    <div class="container">
        <div class="row">
            @foreach($products as $product)
                <?php $photo = $product->product_photo; ?>
                <div class="col l4 m4 s12">
                    <div class="card">
                        <div class="card-image">
                            <img src='{{asset("$photo")}}' alt="post photo">
                        </div>
                        <div class="card-content">
                            <p><label>product name:</label><span>{{$product->product_name}}</span></p>
                            <p><label>price: </label><span>{{$product->unit_price}}</span></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection