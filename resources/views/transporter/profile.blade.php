@extends('transporter.layouts.app')
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-title green  white-text" style="padding: 2%;">
                List of bids you win
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <table class="table-bordered table-responsive">
                    <thead class="blue lighten-4">
                    <tr>
                        <th>no</th>
                        <th>FSC Name</th>
                        <th>Address</th>
                        <th>bid amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i =1 ; ?>
                    @foreach($wins as $win)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$win->name}}</td>
                            <td>
                                <ul style="list-style: none;">
                                    <li><b>Woreda:</b> {{$win->woreda}}</li>
                                    <li><b>phone:</b> 0{{$win->phone}}</li>
                                </ul>
                            </td>
                            <td>{{$win->price}} ETB</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection