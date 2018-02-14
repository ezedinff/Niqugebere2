@extends('transporter.layouts.app')
@section('content')
    <div class="card">
        <div class="card-content">
            <table class="table-bordered table-responsive">
                <thead class="blue lighten-4">
                <tr>
                    <th>no</th>
                    <th>From</th>
                    <th>To</th>
                    <th>quantity</th>
                    <th>   </th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1; ?>
                @foreach($transportations as $transportation)
                    <tr>
                        <td>{{$i}}</td>
                        <th>
                            <ul style="list-style: none;">
                                <li><b>FSC Name: </b>{{$transportation->name}}</li>
                                <li><b>woreda:  </b>{{$transportation->woreda}}</li>
                                <li><b>phone:  </b>0{{$transportation->phone}}</li>
                            </ul>
                        </th>
                        <th>
                            <ul style="list-style: none;">
                                <li><b>FSC Name:  </b>{{$to[$i-1]->name}}</li>
                                <li><b>woreda: </b>{{$to[$i-1]->woreda}}</li>
                                <li><b>phone: </b>0{{$to[$i-1]->phone}}</li>
                            </ul>
                        </th>
                        <th>{{$to[$i-1]->total_quantity}}</th>
                        <th><a href='{{url("/transporter/transportationBid/create/{$transportation->id}")}}' class="btn blue lighten-1 fa fa-gavel"> Bid</a></th>
                    </tr>
                    <?php $i++; ?>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection