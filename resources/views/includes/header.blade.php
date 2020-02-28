@section('header-content')
<div class="head_fix container-fluid gps1">
    <div clas="row">
        <div class="col-12 top_section">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="row">
                        <a href="/"><img class="logo_img img-fluid" src="/images/cantaloupe_logo.png"></a>
                        <span class="tog sidebarTogglerIn" style="cursor:pointer;">
                            <i class="fas fa-bars"></i>
                        </span>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="row right_head mobW">
                        {{-- <div class="col-3 col-xs-2">
                            <div class="row mob-right">
                                <a href="#" class="notification mob_not">
                                    <span><i class="notification far fa-bell"></i></span>
                                    <span class="badge">3</span>
                                </a>
                            </div>
                        </div>--}}
                        <div class="col-9 col-xs-10 loggeduser">
                            <div class="row">
                                <div class="dropdown">
                                    <button type="button" class="welcome btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                        Welcome {{ session('display_name') }}&nbsp;&nbsp;<i class="fas fa-sort-down" style="font-size:25px;"></i>
                                    </button>
                                    <div class="dropdown-menu" style="padding:0;">
                                        <a class="dropdown-item" href="/logout">Log Out</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection