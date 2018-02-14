@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col l4 m4 12">
            <div class="card purple" style="min-height: 10.6em;">
                <div class="card-content">
                    <div class="card-title white-text center-align">
                        Commercial Farm Centers
                    </div>
                    <div class="card-title white-text center">
                        {{\App\Company::where('category_id',1)->get()->count()}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col l4 m4 12">
            <div class="card orange" style="min-height: 10.6em;">
                <div class="card-content">
                    <div class="card-title  white-text center-align">
                        Suppliers
                    </div>
                    <div class="card-title white-text center">
                        {{\App\Company::where('category_id',2)->get()->count()}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col l4 m4 12">
            <div class="card blue" style="min-height: 10.6em;">
                <div class="card-content">
                    <div class="card-title  white-text center-align">
                        Agro-dealers
                    </div>
                    <div class="card-title white-text center">
                        {{\App\Company::where('category_id',3)->get()->count()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection