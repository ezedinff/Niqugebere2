@extends('layouts.app')
@section('content')
<div class="row" style="position: relative;">
    <div class="section no-pad-bot no-padding ">
        <div class="hero">
            <img src="{{asset('img/banner.jpg')}}"  id="mu"/>
            <video class="responsive-video" autoplay="" loop="" id="bgvid" poster="{{asset('img/banner.jpg')}}" style="max-height: 300px !important;">
                mp4: ,
                <source src="{{asset('img/barley.mp4')}}" type="video/mp4">
                <img src="{{asset('img/banner.jpg')}}" title="Your browser does not support the <video> tag">
            </video>

            <div class="overlay">
                <div class="row-height">
                    <div class="col-height col-middle center">
                        <h1>Farm Input Purchasing, Made Easy</h1>
                        <p class="white-text">Join the Ethiopia's leading farms already embracing farming's most powerful purchasing&nbsp;platform</p>
                        <div class="row md-padding-top">
                            <div class="container">
                                <div class="col s6" style="text-align: right;">
                                    <a href="" style="display:inline-block;overflow:hidden;background:url(//linkmaker.itunes.apple.com/assets/shared/badges/en-us/appstore-lrg.svg) no-repeat;width:135px;height:40px;background-size:contain;"></a>
                                </div>
                                <div class="col s6" style="text-align: left;">
                                    <a href=""><img alt="Get it on Google Play" style="width: 150px; height: 60px;position: relative; margin-top: -10px" src="https://play.google.com/intl/en_gb/badges/images/generic/en_badge_web_generic.png"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section scrollspy service">
        <div class="row">
            <div class="sec-title text-center">
                <h2 class="flow-text he" style="text-align: center;">Markets</h2>
                <p class="pa">The Key Features of our Job</p>
            </div>
           <div class="container">
              <div class="row">
                    <a class="col l4 m4 s12" href='{{url("/market/Seeds")}}'>
                        <div class="card blue center" style="height: 15em; padding-top: 6em;">
                            <div class="card-title white-text">SEEDS</div>
                        </div>
                    </a>
                    <a class="col l4 m4 s12" href='{{url("/market/Fertilizers")}}' >
                        <div class="card orange center-align" style="height: 15em; padding-top: 6em;">
                            <div class="white-text card-title">
                                FERTILIZER
                            </div>
                        </div>
                    </a>
                    <a class="col l4 m4 s12"  href='{{url("/market/Feeds")}}' >
                        <div class="card green center-align" style="height: 15em; padding-top: 6em;">
                            <div class="white-text card-title">
                                FEEDS
                            </div>
                        </div>
                    </a>
               </div>
               <!-- second row of market -->
               <div class="row">
                   <a class="col l4 m4 s12" href='{{url("/market/Agro-chemical")}}'>
                       <div class="card red center-align" style="height: 15em; padding-top: 6em;">
                           <div class="white-text card-title">
                               AGRO-CHEMICALS
                           </div>
                       </div>
                   </a>
                   <a class="col l4 m4 s12" href='{{url("/market/Agricultural Equipments")}}'>
                       <div class="card purple center-align" style="height: 15em; padding-top: 6em;">
                           <div class="white-text card-title">
                               AGRO-EQUIPMENTS
                           </div>
                       </div>
                   </a>
                   <a class="col l4 m4 s12" href='{{url("/market/Veterinary Drugs")}}'>
                       <div class="card brown darken-3 center-align" style="height: 15em; padding-top: 6em;">
                           <div class="white-text card-title">
                               VETERNARY DRUGS
                           </div>
                       </div>
                   </a>
               </div>
           </div>
        </div>
    </div>

    <div class="section scrollspy white">
        <div class="sec-title text-center">
            <h2 class="flow-text he">commercial farm center services</h2>
            <p class="pa">List of commercial farm center services</p>

            <?php
                $cfcs = \App\Company::where('category_id',1)->get();

            ?>
<div class="container">

    <div class="row sliderMall">
        @foreach($cfcs as $cfc)
            <?php
            $cover = \App\Cover::where('company_id',$cfc->id)->get();
            $slide = \App\Slide::where('company_id',$cfc->id)->get();
            ?>
            @if($cover->count() > 0 or $slide->count() > 0)
                <div class="col s12 m4 slide">
                    <div class="card">
                        <div class="card-image item" style="text-align: center;">
                            @if($cover->count()>0)
                                <?php $photo = $cover[0]->photo_path; ?>
                                <a href='{{url("/show-cfc/{$cfc->id}")}}'><img src='{{asset("$photo")}}' alt="{{$cfc->name}}" style="background: linear-gradient(rgba(0,0,0,.5), rgba(0,0,0,.7)); height: 300px;"></a>
                                <span class="card-title" style="text-shadow: 1px 1px 1px #000; font-weight: 700;  text-transform: capitalize; top:35% ; height: 0%; text-align: center; min-width: 100%;">{{$cfc->name}}</span>
                            @elseif($slide->count()>0)
                                <?php $photo = $slide[0]->photo_path; ?>
                                <a href='{{url("/show-cfc/{$cfc->id}")}}'><img src='{{asset("$photo")}}' alt="{{$cfc->name}}" style="background: linear-gradient(rgba(0,0,0,.5), rgba(0,0,0,.7)); height: 300px;"></a>
                                <span class="card-title" style="text-shadow: 1px 1px 1px #000; font-weight: 700;  text-transform: capitalize; top:35% ; height: 0%; text-align: center; min-width: 100%;">{{$cfc->name}}</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>


        </div>
    </div>


    <div class="section scrollspy">
        <div class="row">
            <div class="sec-title text-center">
                <h2 class="flow-text he" style="text-align: center;">Services</h2>
                <p class="pa">services provided by commercial farm centers</p>
            </div>
            <div class="container">
                <div class="row">
                    <a class="col l4 m4 s12" href='{{url("service/AI Service")}}'>
                        <div class="card blue center" style="height: 15em; padding-top: 6em;">
                            <div class="card-title white-text">AI Service</div>
                        </div>
                    </a>
                    <a class="col l4 m4 s12" href='{{url("service/Repair and Maintenance")}}' >
                        <div class="card orange center-align" style="height: 15em; padding-top: 6em;">
                            <div class="white-text card-title">
                                Repair and Maintenance
                            </div>
                        </div>
                    </a>
                    <a class="col l4 m4 s12"  href='{{url("service/Spare parts")}}' >
                        <div class="card green center-align" style="height: 15em; padding-top: 6em;">
                            <div class="white-text card-title">
                                Spare parts
                            </div>
                        </div>
                    </a>
                </div>
                <!-- second row of market -->
                <div class="row">
                    <a class="col l4 m4 s12" href='{{url("service/Training")}}'>
                        <div class="card red center-align" style="height: 15em; padding-top: 6em;">
                            <div class="white-text card-title">
                                Training
                            </div>
                        </div>
                    </a>
                    <a class="col l4 m4 s12" href='{{url("service/ON farm service")}}'>
                        <div class="card purple center-align" style="height: 15em; padding-top: 6em;">
                            <div class="white-text card-title">
                                ON farm service
                            </div>
                        </div>
                    </a>
                    <a class="col l4 m4 s12" href='{{url("/service/OFF farm service")}}'>
                        <div class="card brown darken-3 center-align" style="height: 15em; padding-top: 6em;">
                            <div class="white-text card-title">
                                OFF farm service
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="section scrollspy" style="padding-bottom: 4em;">
        <div class="sec-title text-center">
            <h2 class="flow-text he">News & Events</h2>
            <p class="pa">stay connected with agricultural news.</p>
        </div>


       <div class="container">
             <div class="row">
                 <div class="col l6 m6 s12">
                    <div class="box">
                        <img src="{{asset('img/n2.png')}}" alt="" />
                        <p class="title">capacity building services</p>
                        <div class="overlay"></div>
                        <div class="button"><a href="#"> Read more </a></div>
                    </div>
                     <p> a  bridge  grant in  the  amount  of  $44,000toEGAA to  cover  technical  and administrative costs of  the  company  until  the  company  generates  revenueand  develops positive  cash flows through the importation of agricultural inputs.</p>
                 </div>
                 <div class="col l6 m6 s12" >
                     <div class="box">
                         <img src="{{asset('img/n1.jpg')}}"  alt="" />
                         <p class="title">food security</p>
                         <div class="overlay"></div>
                         <div class="button"><a href="#"> Read more </a></div>
                     </div>
                     <p>Keith Polo published on Agra Europe: Private sector partnerships can boost food security in developing world</p>
                 </div>
             </div>
       </div>
   </div>

    <div class="section scrollspy">
        <div class="sec-title text-center">
            <h2 class="flow-text he">Gallery</h2>
            <p class="pa">stay connected with agricultural news.</p>
        </div>
        <div class="container">
            <div class="row">
                <div class="col l4 m4 s6"><a href="{{url('img/gallery/g7.jpg')}}" data-lightbox="niqugebere-gallery" data-title="Click the right half of the image to move forward."><img class="responsive-img" src="{{asset('img/gallery/g7.jpg')}}" alt="" style="position: relative; width: 100%; height: 250px;"/></a></div>
                <div class="col l4 m4 s6"><a href="{{url('img/gallery/g2.jpg')}}" data-lightbox="niqugebere-gallery" data-title="Click the right half of the image to move forward."><img class="responsive-img" src="{{asset('img/gallery/g2.jpg')}}" alt="" style="position: relative; width: 100%; height: 250px;"/></a></div>
                <div class="col l4 m4 s6"><a href="{{url('img/gallery/g3.jpg')}}" data-lightbox="niqugebere-gallery" data-title="Click the right half of the image to move forward."><img class="responsive-img" src="{{asset('img/gallery/g3.jpg')}}" alt="" style="position: relative; width: 100%; height: 250px;"/></a></div>
                <div class="col l4 m4 s6"><a href="{{url('img/gallery/g4.jpg')}}" data-lightbox="niqugebere-gallery" data-title="Click the right half of the image to move forward."><img class="responsive-img" src="{{asset('img/gallery/g4.jpg')}}" alt="" style="position: relative; width: 100%; height: 250px;"/></a></div>
                <div class="col l4 m4 s6"><a href="{{url('img/gallery/g5.jpg')}}" data-lightbox="niqugebere-gallery" data-title="Click the right half of the image to move forward."><img class="responsive-img" src="{{asset('img/gallery/g5.jpg')}}" alt="" style="position: relative; width: 100%; height: 250px;"/></a></div>
                <div class="col l4 m4 s6"><a href="{{url('img/gallery/g6.png')}}" data-lightbox="niqugebere-gallery" data-title="Click the right half of the image to move forward."><img class="responsive-img" src="{{asset('img/gallery/g6.png')}}" alt="" style="position: relative; width: 100%; height: 250px;"/></a></div>
                <div class="col l4 m4 s6"><a href="{{url('img/gallery/g8.png')}}" data-lightbox="niqugebere-gallery" data-title="Click the right half of the image to move forward."><img class="responsive-img" src="{{asset('img/gallery/g8.png')}}" alt="" style="position: relative; width: 100%; height: 250px;"/></a></div>
                <div class="col l4 m4 s6"><a href="{{url('img/gallery/g9.jpg')}}" data-lightbox="niqugebere-gallery" data-title="Click the right half of the image to move forward."><img class="responsive-img" src="{{asset('img/gallery/g9.jpg')}}" alt="" style="position: relative; width: 100%; height: 250px;"/></a></div>
                <div class="col l4 m4 s6"><a href="{{url('img/gallery/g1.jpg')}}" data-lightbox="niqugebere-gallery" data-title="Click the right half of the image to move forward."><img class="responsive-img" src="{{asset('img/gallery/g1.jpg')}}" alt="" style="position: relative; width: 100%; height: 250px;"/></a></div>
            </div>
        </div>
    </div>

    <div class="white section scrollspy col l12 m12 s12 center-align">
        <div class="sec-title text-center">
            <h2 class="flow-text he">Our partners</h2>
            <p class="pa">this are the our partners that we work with.</p>
        </div>
        <div class="col l3 m3 s3"><img class="responsive-img" src="{{asset('img/cnfa.png')}}" alt="" style="position: relative;"></div>
    </div>
    <script src="{{asset('js/lightbox-plus-jquery.min.js')}}"></script>
</div>
@endsection