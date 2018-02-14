@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="card {{$color}} center-align" style="height: 20em;">
            <div class="card-title white-text" style="padding-top: 3.5em; font-size: 2.5em;">
               {{$title}} Market
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col l3 m3 s12">
                <div class="card center">
                    <h5>{{$title}} category</h5>
                    <?php
                        $postedGroup = \App\posted_product::join('product_sub_categories','posted_products.product_sub_category_id' ,'=', 'product_sub_categories.id')
                            ->join('product_categories','product_categories.id','=','product_sub_categories.product_category_id')
                            ->where('product_categories.id',$id)
                            ->select(['product_sub_categories.name'])
                            ->groupBy('product_sub_categories.name')
                            ->get();
                    ?>
                    <ul class="collection">
                        @foreach($postedGroup as $v)
                            <li class="collection-item">{{$v->name}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col l9 m9 s12 center">
                <h5>List of available products posted </h5>
                <?php  $posts = \App\posted_product::join('product_sub_categories','posted_products.product_sub_category_id' ,'=', 'product_sub_categories.id')
                                        ->join('product_categories','product_categories.id','=','product_sub_categories.product_category_id')
                                        ->select(['posted_products.product_photo','posted_products.product_name','posted_products.unit_price'])
                                        ->where('product_categories.id',$id)->get();
                ?>
                @foreach($posts as $post)
                    <?php $photo = $post->product_photo; ?>
                    <div class="col l4 m4 s12">
                        <div class="card">
                            <div class="card-image">
                                <img src='{{asset("$photo")}}' alt="post photo">
                            </div>
                            <div class="card-content">
                                <p><label>product name: {{$post->product_name}}</label></p>
                                <p><label>price: {{$post->unit_price}}</label></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection