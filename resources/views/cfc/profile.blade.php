@extends('cfc.layouts.app')
@section('content')
    <div class="row">
        @if($supplies->count() > 0)
            <div class="row">
                <style>
                    .sup:hover{
                        max-height: 500px !important;
                    }
                </style>
                <div  style="position: relative; left: 5%; width: 90%; background-color: #f5f5f5; padding: 1%; margin-top: 1%;">
                    <div class="card-title" style="padding: 1%;">
                        <h5 style="display: inline;">Recent posted supplies in your category</h5>
                        <a class="right" style="padding-top: 5px;" href="#">
                            VIEW ALL
                        </a>
                    </div>
                </div>

                <div style="padding-left: 10%;">
                    <div class="row slider2" style="background-color: #f5f5f5;">
                        @foreach($supplies as $supply)
                            <div class="col l8 m8 s12 slide" >
                                <div class="card horizontal">
                                    <div class="card-image">
                                        <?php $photo = $supply->product_photo; ?>
                                        <?php
                                        $address = \App\Address::join('woredas','woredas.id','=','addresses.woreda_id')
                                            ->join('zones','woredas.zone_id','=','zones.id')
                                            ->join('regions','regions.id','=','zones.region_id')
                                            ->select(['addresses.phone','addresses.special_name','woredas.name as woreda','zones.name as zone','regions.name as region'])
                                            ->where('addresses.company_id',$supply->company_id)->get();
                                        $company = \App\Company::find($supply->company_id);
                                        ?>
                                        <img src='{{asset("$photo")}}' width="300">
                                    </div>
                                    <div class="col l6 m6 s6">
                                        <div class="card-content">
                                            <p>
                                                {!! $supply->description !!}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col l6 m6 s6">
                                        <div class="card-content" style="overflow: hidden; text-overflow: ellipsis; margin-top: 0;  ">
                                            <p  style="font-size: 1.2em; font-weight: 700;">price & quantity</p>
                                            <label style="font-size: 1.2em;">Unit price:</label>&nbsp;<span>{{$supply->price}}</span><br>
                                            <label style="font-size: 1.2em;">Quantity:</label>&nbsp;<span>{{$supply->quantity}}</span>&nbsp;<span>pieces</span><br>
                                            <p  style="font-size: 1.2em; font-weight: 700;">{{$company->name}}</p>
                                            <p  style="font-size: 1.2em; font-weight: 700;">Address:</p>
                                            <label style="font-size: 1.2em;">Phone:</label>&nbsp;<span>{{$address[0]->phone}}</span><br>
                                            <label style="font-size: 1.2em;">region:</label>&nbsp;<span>{{$address[0]->region}}</span><br>
                                            <label style="font-size: 1.2em;">Zone:</label>&nbsp;<span>{{$address[0]->zone}}</span><br>
                                            <label style="font-size: 1.2em;">Woreda:</label>&nbsp;<span>{{$address[0]->woreda}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        @else
            <div class="row" style="padding-top: 100px;">
                <style>
                    .sup:hover{
                        max-height: 500px !important;
                    }
                </style>
                <div  style="position: relative; left: 5%; width: 90%; background-color: #f5f5f5; padding: 1%; margin-top: 1%;">
                    <div class="card-title" style="padding: 1%;">
                        <h5 style="display: inline;"> there is no supplies</h5>

                    </div>
                </div>
            </div>
        @endif

        @if($demands->count() > 0)
            <div class="row">
                <style>
                    .sup:hover{
                        max-height: 500px !important;
                    }
                </style>
                <div  style="position: relative; left: 5%; width: 90%; background-color: #f5f5f5; padding: 1%; margin-top: 1%;">
                    <div class="card-title" style="padding: 1%;">
                        <h5 style="display: inline;">Recent posted demands in your category</h5>
                        <a class="right" style="padding-top: 5px;" href="{{url('#')}}">
                            VIEW ALL
                        </a>
                    </div>
                </div>
                <div style="padding-left: 10%;">
                    <div class="row slider2" style="background-color: #f5f5f5;">
                        @foreach($demands as $supply)
                            @if(\App\DemandAggrement::where('demand_id',$supply->id)->get()->count() == 0)
                                <div class="col l8 m8 s12 slide" >
                                    <div class="card horizontal">
                                        <div class="card-image">
                                            <?php $photo = $supply->product_photo; ?>
                                            <?php
                                            $address = \App\Address::join('woredas','woredas.id','=','addresses.woreda_id')
                                                ->join('zones','woredas.zone_id','=','zones.id')
                                                ->join('regions','regions.id','=','zones.region_id')
                                                ->select(['addresses.phone','addresses.special_name','woredas.name as woreda','zones.name as zone','regions.name as region'])
                                                ->where('addresses.company_id',$supply->company_id)->get();
                                            $company = \App\Company::find($supply->company_id);
                                            ?>
                                            <img src='{{asset("$photo")}}' width="300">
                                        </div>
                                        <div class="col l6 m6 s6">
                                            <div class="card-content">
                                                <p>
                                                    {!! $supply->description !!}
                                                </p>
                                            </div>
                                            <div class="card-action">
                                                <a href='{{url("/cfc/i-can-deliver/{$supply->id}")}}' class="btn blue white-text">I want to deliver it!</a>
                                            </div>
                                        </div>
                                        <div class="col l6 m6 s6">
                                            <div class="card-content" style="overflow: hidden; text-overflow: ellipsis; margin-top: 0;  ">
                                                <p  style="font-size: 1.2em; font-weight: 700;">price & quantity</p>
                                                <label style="font-size: 1.2em;">Unit price:</label>&nbsp;<span>{{$supply->price}}</span><br>
                                                <label style="font-size: 1.2em;">Quantity:</label>&nbsp;<span>{{$supply->quantity}}</span>&nbsp;<span>pieces</span><br>
                                                <p  style="font-size: 1.2em; font-weight: 700;">{{$company->name}}</p>
                                                <p  style="font-size: 1.2em; font-weight: 700;">Address:</p>
                                                <label style="font-size: 1.2em;">Phone:</label>&nbsp;<span>{{$address[0]->phone}}</span><br>
                                                <label style="font-size: 1.2em;">region:</label>&nbsp;<span>{{$address[0]->region}}</span><br>
                                                <label style="font-size: 1.2em;">Zone:</label>&nbsp;<span>{{$address[0]->zone}}</span><br>
                                                <label style="font-size: 1.2em;">Woreda:</label>&nbsp;<span>{{$address[0]->woreda}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
                    @endif
     </div>
@endsection