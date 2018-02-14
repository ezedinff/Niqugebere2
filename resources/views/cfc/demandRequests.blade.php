@extends('cfc.layouts.app')
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-title blue white-text" style="padding: 2%;">
                List of commercial farm centers requesting to deliver you the product of your demand
            </div>
        </div>
        <div class="card">
            <table class="table-bordered table-responsive">
                <thead class="blue lighten-4">
                <tr>
                    <th>no</th>
                    <th>FSC Name</th>
                    <th>Address</th>
                    <th>Contact</th>
                    <th>your demand</th>
                    <th>          </th>
                </tr>
                </thead>
                <tbody>
                <?php $i =1 ; ?>
                @foreach($demandRequests as $request)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$request->name}}</td>
                        <td>
                            <ul style="list-style: none;">
                                <li>Region : {{$request->region}}</li>
                                <li>Zone : {{$request->zone}}</li>
                                <li>Woreda : {{$request->woreda}}</li>
                            </ul>
                        </td>
                        <td>Phone : 0{{$request->phone}}</td>
                        <td><a href='{{url("cfc/demand/{$request->demand_id}")}}'>Click here to see the demand</a></td>
                        <td><a href='{{url("cfc/accept-request/{$request->id}")}}' class="btn fa fa-check white-text blue"> Accept</a></td>
                    </tr>
                    <?php $i++; ?>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection