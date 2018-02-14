@extends('cfc.layouts.app')
@section('content')
    <div class="row">
        <div class="col l4 m4 s12">
            <div class="card">
                <div class="card-image">
                    <?php $photo = $demand->product_photo; ?>
                    <img src='{{asset("$photo")}}' alt="demand picture">
                </div>
                <div class="card-content">
                    <b>Product name:</b> <p>{{$demand->title}}</p>
                    <b>Unit price:</b> <p>{{$demand->price}}</p>
                    <b>Quantity:</b> <p>{{$demand->total_quantity}}</p>
                    <b>Description:</b> <p>{{$demand->description}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection