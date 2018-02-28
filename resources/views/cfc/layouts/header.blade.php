<nav class="top-nav col offset-m2" style="background-color: #fff;">
    <div class="nav-wrapper">
        <a href="{{url('/')}}" id="logo"  class="brand-logo">
            <img src="{{asset('img/logo.png')}}" style="height: 48px; width: 120px; top: -30px;">
        </a>
        <a href="#" data-activates="nav-mobile" class="button-collapse top-nav full hide-on-large-only"><i class="material-icons green-text">menu</i></a>
        <ul class="right hide-on-med-and-down" style="width: 72.6%; position: relative;">
            <li  style="min-width: 45.6% !important; ">
                <form  style="width: 100%; height: 50px;">
                    <div class="input-field z-depth-1" style="background-color: #f5f5f5; top: 7px;">
                        <input class="form-control" id="search" type="search" required>
                        <label class="label-icon" for="search" style="top: -17px; left: 10px;"><i class="fa fa-search" style="color: #66BB6A; font-size: 1.5em;"></i></label>
                    </div>
                </form>
            </li>
            <li><a href=""><i class="fa fa-bell " style="color: #66BB6A; font-size: 1.5em;"></i></a></li>
            <li><a href=""><i class="fa fa-comments " style="color: #66BB6A; font-size: 1.5em;"></i></a></li>
            <li class="">
                <a  class="dropdown-button" href="#!" data-activates="dropdown1">
                    <label style="font-size: 1.0em;">{{auth()->user()->first_name}} {{auth()->user()->last_name}}</label>
                    <span class=" fa fa-angle-down"></span>
                </a>
            </li>
        </ul>
    </div>
</nav>

<ul id="nav-mobile" class="collapsible side-nav fixed" style="background-color: #2A3F54 !important;">
    <li>
        <div class="user-view" style="padding-left: 2%; text-align: center;">
            <img class="circle" style="margin-left: 7.5em;" src="{{asset('img/default_pic.png')}}"><br>
            <a><span class="name">{{auth()->user()->first_name}} {{auth()->user()->last_name}}</span></a>
            <?php $company = \App\Company::find(auth()->user()->company_id); ?>
            <a ><span class="email" style=" text-transform: uppercase;">{{$company->name}} Admin</span></a>
        </div>
    </li>
    <li >
        <a class="collapsible-header" href="{{url('/cfc')}}">
            <i class="fa fa-dashboard"></i> Dashboard
        </a>
    </li>
    <li><a class="collapsible-header" ><i class="fa fa-folder"></i> Manage Inventory <span class="fa fa-chevron-down"></span></a>
        <ul class="collapsible-body">
            <li><a href="{{url('cfc/inventory/create')}}">Add new product</a></li>
            <li><a href="{{url('/cfc/inventory')}}">my inventory</a></li>
        </ul>
    </li>
    <li><a class="collapsible-header"><i class="fa fa-gear"></i>Manage Supply<span class="fa fa-chevron-down"></span></a>
        <ul class="collapsible-body">
            <li><a href="{{url('cfc/supply/create')}}">post supply</a></li>
            <li><a href="{{url('cfc/supply')}}">my supplies</a></li>
        </ul>
    </li>
    <li><a class="collapsible-header"><i class="fa fa-gear"></i>Manage Demand<span class="fa fa-chevron-down"></span></a>
        <ul class="collapsible-body">
            <li><a href="{{url('cfc/demand/create')}}">post demand</a></li>
            <li><a href="{{url('cfc/demand')}}">my demands</a></li>
        </ul>
    </li>
    <li><a class="collapsible-header"><i class="fa fa-gear"></i>Manage posted items<span class="fa fa-chevron-down"></span></a>
        <ul class="collapsible-body">
            <li><a href="{{url('cfc/post/create')}}">post item</a></li>
            <li><a href="{{url('cfc/post')}}">my posted items</a></li>
        </ul>
    </li>
    <li><a class="collapsible-header"><i class="fa fa-gear"></i>Manage Service<span class="fa fa-chevron-down"></span></a>
        <ul class="collapsible-body">
            <li><a href="{{url('cfc/service/create')}}">post service</a></li>
        </ul>
    </li>
    <li><a class="collapsible-header"><i class="fa fa-gear"></i>purchasing requests<span class="fa fa-chevron-down"></span></a>
        <ul class="collapsible-body">
            <li><a href="{{url('cfc/purchasing-request/create')}}">send purchasing request</a></li>
            <li><a href="{{url('cfc/my-purchasing-request')}}">my purchasing requests</a></li>
        </ul>
    </li>
    <li><a class="collapsible-header"><i class="fa fa-gear"></i>Manage interests<span class="fa fa-chevron-down"></span></a>
        <ul class="collapsible-body">
            <li><a href="{{url('cfc/requests-to-deliver')}}">requests to deliver</a></li>
            <li><a href="{{url('cfc/my-responses')}}" class="truncate">my responses for supplies and demands</a></li>
            <li><a href="{{url('cfc/transporters-bid')}}">transporters bid</a></li>
        </ul>
    </li>
    <li><a class="collapsible-header"><i class="fa fa-comments"></i>Message & feedback<span class="fa fa-chevron-down"></span></a>
        <ul class="collapsible-body">
            <li><a href="{{url('cfc/message-from-egaa')}}">message from egaa</a></li>
            <li><a href="{{url('cfc/message-from-client')}}">message from clients</a></li>
        </ul>
    </li>
    <li><a class="collapsible-header"><i class="fa fa-laptop"></i>Manage layouts<span class="fa fa-chevron-down"></span></a>
        <ul class="collapsible-body">
            <li><a href="{{url('cfc/slide')}}">slide</a></li>
            <li><a href="{{url('cfc/cover')}}">cover</a></li>
            <li><a href="{{url('cfc/logo')}}">logo</a></li>
            <li><a href="{{url('cfc/about')}}">About page</a></li>
            <li><a href="{{url('cfc/news')}}">News & Event</a></li>
        </ul>
    </li>
    <li><a class="collapsible-header"><i class="fa fa-users"></i>Manage user<span class="fa fa-chevron-down"></span></a>
        <ul class="collapsible-body">
            <li><a href="{{url('/cfc/user')}}">user</a></li>
            <li><a href="{{url('/cfc/user/create')}}">add new user</a></li>
        </ul>
    </li>
</ul>


<ul id="dropdown1" class="dropdown-content"  >
    <li><a href="javascript:;" id="drop"> Profile</a></li>
    <li>
        <a id="drop" href="javascript:;">
            <span class="badge bg-red pull-right">50%</span>
            <span>Settings</span>
        </a>
    </li>
    <li><a href="javascript:;" id="drop">Help</a></li>
    <li>
        <a id="drop" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out pull-right"></i> Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </li>

</ul>