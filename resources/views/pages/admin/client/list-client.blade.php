<!DOCTYPE html>
<html>

<head>
    <title>HRWS | Clients</title>
    @include('includes.external_dependency')
    @yield('includes.external_dependency-content')
</head>

<body>
    @include('includes.header')
    @yield('header-content')
    <div class="wrapper">
        @include('includes.admin.sidebar')
        @yield('admin.sidebar-content')
        <div class="mainContent">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 pad_bot">
                        <div class="row">
                            <h5>Clients</h5>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="w-100 user_list">
                                <div class="col-sm-12">
                                    <div class="white-box">
                                        <div class="col-12 searchbox clientFirst">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="row">
                                                        @include('pages-message.form-submit')
                                                        @include('pages-message.notify-msg-success')
                                                        @include('pages-message.notify-msg-error')
                                                    </div>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="row d_right">
                                                        <form method="post" action="/admin/client" enctype="multipart/form-data" autocomplete="off">
                                                            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                                                            <div class="searchPlus search_container">
                                                                <i class="fa fa-search searchIcon"></i><input type="text" name="search" class="dtable_search" placeholder="Search.."> <a href=""><i class="fas fa-times searchIcon"></i></a>
                                                            </div>
                                                        </form>
                                                        <a href="/admin/client_add"><button type="submit" class="std_butU btn btn-primary"><i class="fas fa-plus" data-toggle="tooltip" title="Add Client"></i></button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @foreach($data as $client)
                                        <?php $client_id = $client['id']; ?>
                                        <div class="col-md-12 clienters">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row right_head">
                                                        <div class="iconBorder clientEdit" style="cursor:pointer;" data-toggle="tooltip" title="Edit">
                                                            <a href="/admin/client_edit?id={{ \Crypt::encrypt($client_id) }}"><i class="fas fa-pencil-alt"></i></a>
                                                        </div>
                                                        <div class="iconBorder clientEdit" style="cursor:pointer;" title="Delete">
                                                            <i class="far fa-trash-alt" data-toggle="modal" data-target="#delmodal" data-id="{{ \Crypt::encrypt($client_id) }}"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-1 log_form">
                                                            <div class="row">
                                                                <div class="profile_pic">
                                                                    @if($client['logo_name'])
                                                                    <img class="img-fluid" src="{{ url('/images/clients/'.$client['logo_name']) }}" style="width:90px; height:90px; float:left;  margin-right:25px;"><br>
                                                                    @else
                                                                    <img class="img-fluid" src="/images/Permissions.png">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-11 log_form1">
                                                            <div class="row">
                                                                <div class="col-md-12 ">
                                                                    <div class="row">
                                                                        <h5>{{ $client['name'] }}</h5>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-3 log_form">
                                                                            <div class="row">
                                                                                <div class="col-lg-2 col-2">
                                                                                    <div class="row">
                                                                                        <i class="clientIcons tick far fa-envelope"></i>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-10 col-10">
                                                                                    <div class="row">
                                                                                        <p>{{ $client['email'] }}</p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-2 col-2">
                                                                                    <div class="row">
                                                                                        <i class="clientIcons tick fas fa-globe"></i>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-10 col-10">
                                                                                    <div class="row">
                                                                                        <p>{{ $client['website'] }}</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3 log_form">
                                                                            <div class="row">
                                                                                <div class="col-lg-2 col-2">
                                                                                    <div class="row">
                                                                                        <i class="clientIcons tick fas fa-phone-volume"></i>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-10 col-10">
                                                                                    <div class="row">
                                                                                        <p>{{ $client['contact_no'] }}</p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-2 col-2">
                                                                                    <div class="row">
                                                                                        <i class="clientIcons tick fas fa-street-view"></i>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-10 col-10">
                                                                                    <div class="row">
                                                                                        <p>{{ $client['city'] }}</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3 log_form2">
                                                                            <div class="row">
                                                                                <div class="col-lg-2 col-2">
                                                                                    <div class="row">
                                                                                        <i class="clientIcons tick far fa-calendar-alt"></i>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-10 col-10">
                                                                                    <div class="row">
                                                                                        <p>{{ \Carbon\Carbon::parse($client['created_at'])->format('d-M-Y') }}</p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-2 col-2">
                                                                                    <div class="row">
                                                                                        <i class="clientIcons tick fas fa-users"></i>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-10 col-10 numberclient">
                                                                                    <div class="row">
                                                                                        <a href="/admin/clientContact?id={{ \Crypt::encrypt($client['id']) }}">
                                                                                            <p>No Of Contacts: ( {{ $client['contact_count'] }} )</p>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3 log_form clientAddress">
                                                                            <div class="row">
                                                                                <div class="col-lg-2 col-2">
                                                                                    <div class="row">
                                                                                        <i class="clientIcons tick fas fa-map-marked-alt"></i>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-10 col-10">
                                                                                    <div class="row">
                                                                                        <p>{{ $client['address1'] }},{{ $client['address2'] }},{{ $client['city'] }},{{ $client['country'] }}</p>
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
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delmodal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form method="post" action="/admin/client_delete" enctype="multipart/form-data">
                    <input type="hidden" name="client_id" id="client_id">
                    <div class="modal-header">
                        <h4 class="modal-title">Confirm Delete</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <h6>Are you sure you want to delete this entry ?</h6>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="std_butU btn btn-secondary">Delete</button>
                        <button type="button" class="std_but1 btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#name").val($($(".user_listing .viewname")).text());
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "info": false,
                "bPaginate": true,
                "language": {
                    "paginate": {
                        "previous": "<",
                        "next": ">"
                    }
                }
            });
        });
    </script>

    <script type="text/javascript">
        document.getElementById("client_item").classList.add("active1");
        document.getElementById("client_link").classList.add("active");
        document.getElementById("client_span").classList.add("active");
    </script>
</body>

</html>