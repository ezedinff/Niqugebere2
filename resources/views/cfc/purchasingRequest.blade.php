@extends('cfc.layouts.app')
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-title blue white-text" style="padding: 2%;">
                List of purchasing requests you have sent to EGAA
            </div>
        </div>
        <div class="card">
            <table class="table-bordered table-responsive">
                <thead class="blue lighten-4">
                <tr>
                    <th>no</th>
                    <th>product cateogory</th>
                    <th>product name</th>
                    <th>quantity</th>
                    <th>          </th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                    @foreach($requests as $request)
                        <tr>
                            <td>{{$i}}</td>
                            <td><a href="#">{{$request->category}}</a> > <a href="#">{{$request->sub}}</a></td>
                            <td>{{$request->product_name}}</td>
                            <td>{{$request->quantity}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection