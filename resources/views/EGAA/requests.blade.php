@extends('EGAA.layouts.app')
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-title blue lighten-1 white-text" style="padding: 2%;">
                List of purchasing requests sent from commercial farm centers
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <form action="{{url('/admin-egaa/purchasing-requests/pdf')}}" method="post" class="right">
                {{csrf_field()}}
                <button type="submit" class="btn blue fa fa-file white-text"> Export to PDF</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-content">
                <table class="table-bordered table-responsive">
                    <thead class="blue lighten-4">
                        <tr>
                            <th>no</th>
                            <th>FSC</th>
                            <th>subcategory</th>
                            <th>product name</th>
                            <th>phone</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i =1 ; ?>
                    @foreach($purchases as $purchase)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$purchase->company}}</td>
                            <td>{{$purchase->subcategory}}</td>
                            <td>{{$purchase->product_name}}</td>
                            <td>0{{$purchase->phone}}</td>
                            <td>
                                <ul>
                                    <li><label style="color: #212121; font-weight: bold;">Region:</label><span>{{$purchase->region}}</span></li>
                                    <li><label style="color: #212121; font-weight: bold;">Zone: </label><span>{{$purchase->zone}}</span></li>
                                    <li><label style="color: #212121; font-weight: bold;">Woreda: </label><span>{{$purchase->woreda}}</span></li>
                                </ul>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection