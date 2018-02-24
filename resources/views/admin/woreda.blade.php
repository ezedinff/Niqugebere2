@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col s12">
            <ul class="tabs">
                <li class="tab col s3"><a class="active green-text" href="#test1">Add woreda</a></li>
                <li class="tab col s3"><a class="active green-text"  href="#test2">Add woreda translation</a></li>
                <li class="tab col s3"><a class="active green-text" href="#test3">list of woreda</a></li>
            </ul>
        </div>
        <div id="test1" class="col s12">
            <div class="card">
                @if(\Illuminate\Support\Facades\Session::get('saved'))
                    <div class="card-title teal white-text" style="padding: 2%;">
                        {{\Illuminate\Support\Facades\Session::get('saved')}}
                    </div>
                @else
                    <div class="card-title blue lighten-1 white-text" style="padding: 2%;">
                        {{ $titleZone }}
                    </div>
                @endif
            </div>
            <div class="card">
                <div class="card-content">
                    {!! $formZone !!}
                </div>
            </div>
        </div>
        <div id="test2" class="col s12">
            <div class="card">
                @if(\Illuminate\Support\Facades\Session::get('saved'))
                    <div class="card-title teal white-text" style="padding: 2%;">
                        {{\Illuminate\Support\Facades\Session::get('saved')}}
                    </div>
                @else
                    <div class="card-title blue lighten-1 white-text" style="padding: 2%;">
                        {{ $title }}
                    </div>
                @endif
            </div>
            <div class="card">
                <div class="card-content">

                </div>
            </div>
        </div>
        <div id="test3" class="col s12">
            <div class="card">
                <div class="card-title blue lighten-1 white-text" style="padding: 2%;">
                    List of Woreda
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <table class="table-bordered table-responsive striped">
                        <thead class="blue lighten-4">
                        <tr>
                            <th>no</th>
                            <th>Region</th>
                            <th>zones</th>
                            <th>Woreda</th>
                            <th>English</th>
                            <th>አማርኛ</th>
                            <th>ትግርኛ</th>
                            <th>Soomaali</th>
                            <th>Afaan Oromoo</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($zones as $zone)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$zone->region}}</td>
                                <td>{{$zone->zone}}</td>
                                <td>{{$zone->woreda}}</td>
                                <?php
                                $en = \App\WoredaTranslation::where(['language_id'=>1,'woreda_id'=>$zone->id])->get();
                                $am = \App\WoredaTranslation::where(['language_id'=>2,'woreda_id'=>$zone->id])->get();
                                $ti = \App\WoredaTranslation::where(['language_id'=>3,'woreda_id'=>$zone->id])->get();
                                $so = \App\WoredaTranslation::where(['language_id'=>4,'woreda_id'=>$zone->id])->get();
                                $om = \App\WoredaTranslation::where(['language_id'=>5,'woreda_id'=>$zone->id])->get();
                                ?>
                                <td class="center-text">
                                    @if($en->count() >0)
                                        <i class="fa fa-check green-text fa-2x"></i>
                                    @else
                                        <i class="fa fa-times red-text fa-2x"></i>
                                    @endif
                                </td>
                                <td class="center-text">
                                    @if($am->count() >0)
                                        <i class="fa fa-check green-text fa-2x"></i>
                                    @else
                                        <i class="fa fa-times red-text fa-2x"></i>
                                    @endif
                                </td>
                                <td class="center-text">
                                    @if($ti->count() >0)
                                        <i class="fa fa-check green-text fa-2x"></i>
                                    @else
                                        <i class="fa fa-times red-text fa-2x"></i>
                                    @endif
                                </td>
                                <td class="center-text">
                                    @if($so->count() >0)
                                        <i class="fa fa-check green-text fa-2x"></i>
                                    @else
                                        <i class="fa fa-times red-text fa-2x"></i>
                                    @endif
                                </td>
                                <td class="center-text">
                                    @if($om->count() >0)
                                        <i class="fa fa-check green-text fa-2x"></i>
                                    @else
                                        <i class="fa fa-times red-text fa-2x"></i>
                                    @endif
                                </td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="col s12 right">{{ $zones->links() }}</div>
            </div>
        </div>
    </div>
@endsection