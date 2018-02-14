@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-title blue lighten-1 white-text" style="padding: 2%;">
            List of {{$company}} waiting for acceptance
        </div>
        <div class="card-content">
            <table class="responsive-table bordered striped">
                <thead>
                <tr>
                    <th>no</th>
                    <th>Name</th>
                    <th>TIN</th>
                    <th>Phone</th>
                    <th>Region</th>
                    <th>Zone</th>
                    <th>Woreda</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1; ?>
                    @foreach($tobeVerfied as $tobe)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$tobe->name}}</td>
                            <td>{{$tobe->tin}}</td>
                            <td>{{$tobe->phone}}</td>
                            <td>{{$tobe->region}}</td>
                            <td>{{$tobe->zone}}</td>
                            <td>{{$tobe->woreda}}</td>
                        </tr>
                        <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-title blue lighten-1 white-text" style="padding: 2%;">
            List of {{$company}}
        </div>
        <div class="card-content">
            <table class="responsive-table bordered striped">
                <thead>
                <tr>
                    <th>no</th>
                    <th>Name</th>
                    <th>TIN</th>
                    <th>Phone</th>
                    <th>Region</th>
                    <th>Zone</th>
                    <th>Woreda</th>
                </tr>
                </thead>
                <tbody>
                <?php $j=1; ?>
                @foreach($verfied as $v)
                    <tr>
                        <td>{{$j}}</td>
                        <td>{{$v->name}}</td>
                        <td>{{$v->tin}}</td>
                        <td>{{$v->phone}}</td>
                        <td>{{$v->region}}</td>
                        <td>{{$v->zone}}</td>
                        <td>{{$v->woreda}}</td>
                    </tr>
                    <?php $j++; ?>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection