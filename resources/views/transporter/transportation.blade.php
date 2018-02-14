@extends('transporter.layouts.app')
@section('content')
    <div class="card">
        <div class="card-content">
            <table class="table-bordered table-responsive">
                <thead class="blue lighten-4">
                    <tr>
                        <th>no</th>
                        <th>Transportation type</th>
                        <th>path</th>
                        <th>plate no</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i=1; ?>
                    @foreach($transportations as $transportation)
                        <tr>
                            <td>{{$i}}</td>
                            <th>{{$transportation->name}}</th>
                            <th>{{$transportation->start}} - {{$transportation->end}}</th>
                            <th>{{$transportation->plate_no}}</th>
                        </tr>
                        <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection