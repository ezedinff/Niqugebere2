<div class="row" style="padding: 0;">
    <div class="slider">
        <ul class="slides">
            @if($slides->count() > 0)
                @foreach($slides as $slide)
                    <?php $image  = $slide->photo_path; ?>
                    <li class="blue lighten-1">
                        <img src='{{asset("$image")}}'> <!-- random image -->
                        <div class="caption center-align" style="padding-top: 5%;">
                            <h3 style="text-shadow: 1px 1px 1px #000;">{{$slide->caption1}}</h3>
                            <h5 class="light grey-text text-lighten-3" style="text-shadow: 1px 1px 1px #000;">{{$slide->caption2}}</h5>
                        </div>
                    </li>
                @endforeach
            @else
                <li class="green lighten-1">
                    <img src='{{asset("")}}' class="center center-align" style=" object-fit: contain; height: 100%; width: 100%; background-size: cover;    -webkit-background-size: cover;
    -moz-background-size: cover;  -o-background-size: cover; background-position: center bottom; "> <!-- random image -->
                    <div class="caption center-align">
                        <h3 class="white-text" style="text-shadow: 1px 1px 1px #000;">{{$company->name}}</h3>
                    </div>
                </li>
            @endif
        </ul>
    </div>
    <nav class="green darken-3" style="position: relative;  padding-left: 2%; padding-right: 2%;">
        <div class="nav-wrapper">
            <a href="#" class="brand-logo white-text">
                @if($logo->count()>0)
                    <?php $logoPic =  $logo[0]->logo_path; ?>
                    <img src='{{asset("$logoPic")}}' height="64">
                @else
                    <span style="font-size: 0.6em !important;">{{$company->name}}</span>
                @endif
            </a>
            <ul class="right hide-on-med-and-down" style="margin-right: 20%;">
                <li><a href='#' class="white-text">HOME</a></li>
                <li><a href='#' class="white-text">SERVICES</a></li>
                <li><a href="#" class="white-text">NEWS & EVENTS</a></li>
                <li><a href='#' class="white-text">ABOUT</a></li>
                <li><a href="#" class="white-text">CONTACT</a></li>
            </ul>
            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons" style="color: #fff;">menu</i></a>
            <ul id="nav-mobile" class="side-nav" style="padding-top: 50%;">
                <li id="navMenus"><a href='#' class="green-text">HOME</a></li>
                <li id="navMenus"><a href="#" class="green-text">SERVICES</a></li>
                <li id="navMenus"><a href='#' class="green-text">NEWS & EVENTS</a></li>
                <li id="navMenus"><a href='#' class="green-text">ABOUT</a></li>
                <li id="navMenus"><a href="#" class="green-text">CONTACT</a></li>
            </ul>
        </div>
    </nav>
</div>