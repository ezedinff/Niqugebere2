 <div class="col s12 l12 m12 black largenav " style="height: 27px;">
        <div class="row">
            <div class="col l4 m4"></div>
            <div class="col l8 m8 s12 right">
                <?php $en = "en"; $am = "am"; $ti = "ti"; $so = "so"; $om = "om";?>
                    <div style="float: right; padding-right: 5%;" >
                        <a class="language white-text"  href='{{url("/language/{$en}")}}' style="color: #f5f5f5;">[ English ]</a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="language white-text"  href='{{url("/language/{$am}")}}'>[ አማርኛ ]</a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="language white-text"  href='{{url("/language/{$ti}")}}'>[ ትግርኛ ]</a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="language white-text"  href='{{url("/language/{$so}")}}'>[ Soomaali ]</a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="language white-text"  href='{{url("/language/{$om}")}}'>[ Afaan Oromoo ]</a>
                    </div>
            </div>
        </div>
    </div>
    <nav class="white hide-on-med-and-down">
        <div class="nav-wrapper">
            <div class="row row2">
                <div class="col m3 s2">
                    <a href='{{url("/")}}'  class="brand-logo" style="float: left;  padding-left: 2.5%; ">
                        <img src="{{asset("/img/logo.png")}}" style="height: 64px; width: 128px;" alt="logo of Niqugebere">
                    </a>
                </div>
                <div class="flipkart-navbar-search smallsearch col m5 s12 center">
                    <div class="row">
                        <input class="flipkart-navbar-input col m10 s10 z-depth-1-half" type="search" placeholder="Search for Products, Brands and more" name="">
                        <button class="flipkart-navbar-button col m1 s1  green lighten-1 white-text" style="width: 50px;  fill: currentColor;">
                            <svg width="25px" height="25px" id="svg" style="text-align: center;">
                                <path d="M11.618 9.897l4.224 4.212c.092.09.1.23.02.312l-1.464 1.46c-.08.08-.222.072-.314-.02L9.868 11.66M6.486 10.9c-2.42 0-4.38-1.955-4.38-4.367 0-2.413 1.96-4.37 4.38-4.37s4.38 1.957 4.38 4.37c0 2.412-1.96 4.368-4.38 4.368m0-10.834C2.904.066 0 2.96 0 6.533 0 10.105 2.904 13 6.486 13s6.487-2.895 6.487-6.467c0-3.572-2.905-6.467-6.487-6.467 "></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="cart largenav col m4 s4 right-align">
                    @if (Auth::guest())
                        <a class="signinButton btn" href="{{url('/login')}}">Login</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="signinButton btn" href="{{url('/register')}}">register</a>
                    @else
                        <li>
                            <a href="#" class="dropdown-button green-text" data-activates='dropdown2'>
                                {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}&nbsp;<span class="fa fa-caret-down"></span>
                            </a>
                        </li>
                    @endif
                </div>
            </div>
        </div>
    </nav>
    <nav class="green darken-3">
        <div class="nav-wrapper">
            <a href='{{url("/")}}' id="homelogo" class="brand-logo smallnav center-align blue">
                <img src="{{asset("/img/logo-white.png")}}" style="height: 48px; width: 92px;" alt="logo of niqugebere">
            </a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons" style="color: #FBFBFB;">menu</i></a>
            <div>
                <ul id="navmenu" class="hide-on-med-and-down ">
                    <li><a class='dropdown-button menu' href="{{url('/buyer')}}" data-activates='dropdown1' >Digital Lease space</a></li>
                    <li><a href="" class="dropdown-button menu" data-activates='dropdown2' >Agri. Apps</a></li>
                    <li><a href="" class="dropdown-button menu" data-activates='dropdown3'>Climate Change & Research</a></li>
                    <li><a href="" class="dropdown-button menu" data-activates='dropdown4'>Innovation and Commercialization</a></li>
                    <li><a href="" class="dropdown-button menu" data-activates='dropdown5'>Consultancy and Partnership</a></li>
                </ul>
            </div>
            <ul class="side-nav green darken-3" id="mobile-demo">
                <li><a href="" class="menu truncate">Digital Lease space Service</a></li>
                <li><a href="" class="menu truncate">Agricultural Apps Service</a></li>
                <li><a href="" class="menu truncate">Climate Change & Research Service</a></li>
                <li><a href="" class="menu truncate">Innovation and Commercialization</a></li>
                <li><a href=""  class="menu truncate">Consultancy and Partnership</a></li>
                @if (Auth::guest())
                    <li id="navMenus"><a href="{{url('/login')}}" style="text-transform: uppercase; color:#fff;">sign in</a></li>
                    <li id="navMenus"><a href="{{url('/register')}}" style="text-transform: uppercase; color:#fff;" >register</a></li>
                @else
                    <li id="navMenus">
                        <a  href="{{ route('logout') }}"
                            onclick="event.preventDefault();
           document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endif
            </ul>
        </div>
    </nav>





 <ul id='dropdown1' class='dropdown-content'>
     <li><a href="#!">Input Market</a></li>
     <li><a href="#!">Output Market</a></li>
     <li><a href="#!">Agri. labour Market</a></li>
     <li><a href="#!">Land Lease / Contract Farming market</a></li>
 </ul>
 <ul id='dropdown2' class='dropdown-content'>
     <li><a href="#!">Agronomic best practices apps</a></li>
     <li><a href="#!">Logistics apps</a></li>
     <li><a href="#!">Digital finance apps</a></li>
     <li><a href="#!">Data Warehouse / Business intelligent</a></li>
 </ul>
 <ul id='dropdown3' class='dropdown-content'>
     <li><a href="#!">GIS & Remote Sensing</a></li>
     <li><a href="#!">Risk Forecasting model and simulation</a></li>
     <li><a href="#!">Climate Smart Technology</a></li>
 </ul>
 <ul id='dropdown4' class='dropdown-content'>
     <li><a href="#!">University-Industry Linkage</a></li>
     <li><a href="#!">Artificial intelligence for Agricultural </a></li>
     <li><a href="#!">Innovation incubation Service</a></li>
 </ul>
 <ul id='dropdown5' class='dropdown-content'>
     <li><a href="#!">Organized Events</a></li>
     <li><a href="#!">Adviser Service</a></li>
     <li><a href="#!">Training</a></li>
 </ul>




 <ul id='dropdown2' class='dropdown-content'>
     <li>
         <a href="javascript:;" id="drop">
             <span class="fa fa-user"></span>
             <span>Profile</span>
         </a>
     </li>
     <li>
         <a id="drop" href="javascript:;">
             <span class="fa fa-gear"></span>
             <span>Settings</span>
         </a>
     </li>
     <li><a href="javascript:;" id="drop"><span id="drop" class="fa fa-question-circle"></span>&nbsp Help</a></li>
     <li>
         <a id="drop" href="{{ route('logout') }}"
            onclick="event.preventDefault();
           document.getElementById('logout-form').submit();">
             <span class="fa fa-sign-out"></span><span>Logout</span>
         </a>

         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
             {{ csrf_field() }}
         </form>
     </li>
 </ul>