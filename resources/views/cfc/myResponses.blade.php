@extends('cfc.layouts.app')
@section('content')
    <div class="row">
        <ul id="tabs-swipe-demo" class="tabs">
            <li class="tab col s3"><a href="#test-swipe-1" class=" active green-text">demand Responses</a></li>
            <li class="tab col s3"><a href="#test-swipe-2" class=" green-text">supply Responses</a></li>
        </ul>
        <div id="test-swipe-1" class="col s12">
            <div class="row">
                <table class="table-bordered table-responsive striped">
                    <thead class="blue lighten-4">
                    <tr>
                        <th>no</th>
                        <th>demand</th>
                        <th>win/lose</th>
                        <th>Address-contact</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i =1 ; ?>
                    @foreach($responseForDemands as $demand)
                        <tr>
                            <td>{{$i}}</td>
                            <td><a href='{{url("cfc/demand/{$demand->demand_id}")}}'>Click here to see the demand</a></td>
                            @if($demand->win == 1)
                                <td class="green-text">Win</td>
                            @elseif($demand->win == 2)
                                <td class="red-text">Lose</td>
                            @else
                                <td class="red-text">not yet decided</td>
                            @endif
                           <td>
                               <p><span>FSC: </span> {{$demand->name}}</p>
                               <p><span>Region: </span> {{$demand->region}}</p>
                               <p><span>Zone: </span> {{$demand->zone}}</p>
                               <p><span>woreda: </span> {{$demand->woreda}}</p>
                               <p><span>phone: </span> 0{{$demand->phone}}</p>
                           </td>
                        </tr>
                        <?php $i ++ ; ?>
                    @endforeach
                    </tbody>

                </table>
                <div class="col s12 right">{{ $responseForDemands->links() }}</div>
            </div>
        </div>
        <div id="test-swipe-2" class="col s12"></div>
    </div>
@endsection