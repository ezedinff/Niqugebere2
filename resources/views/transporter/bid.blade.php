@extends('transporter.layouts.app')
@section('content')
    <div class="row">
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
                <form action='{{url("/transporter/transportationBid/store/{$id}")}}' method="post">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="input-field col s12">
                            <input name="bid" id="bid" type="number" class="validate"  required>
                            <label for="bid">Enter your bid amount</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m12 l12">
                            <input type="submit" value="Sumbit" class="btn-large wave-effect wave-light teal white-text right">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection