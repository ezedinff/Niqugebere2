@extends('layouts.app')
@section('content')
<main>
    <header>
        <div id="head2">
            @include('showNavBar')
        </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="card">
                @if($about->count() > 0)
                    <div class="card-content">
                        {!! $about[0]->description !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>

@endsection