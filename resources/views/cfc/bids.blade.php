@extends('cfc.layouts.app')
@section('content')
    @if($bids->count() > 0)
        <div class="row">
            <div class="card">
                <div class="card-title blue lighten-1 white-text" style="padding: 2%;">
                    List of transporters bid on your need
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <table class="table-bordered table-responsive">
                        <thead class="blue lighten-4">
                        <tr>
                            <th>no</th>
                            <th>Transporter Name</th>
                            <th>Address</th>
                            <th>bid amount</th>
                            <th>your demand</th>
                            <th>          </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i =1 ; ?>
                        @foreach($bids as $bid)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$bid->name}}</td>
                                <td>
                                    <ul style="list-style: none;">
                                        <li><b>Woreda:</b> {{$bid->name}}</li>
                                        <li><b>phone:</b> 0{{$bid->phone}}</li>
                                    </ul>
                                </td>
                                <td>{{$bid->price}} ETB</td>
                                <td><a href='{{url("cfc/demand/{$bid->id}")}}'>Click here to see the demand</a></td>
                                <td><a href='{{url("cfc/accept-request-transporter/{$bid->tid}")}}' class="btn fa fa-check white-text blue"> Accept</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-title orange lighten-1 white-text" style="padding: 2%;">
                No one yet bid on your need.
            </div>
        </div>
    @endif
@endsection