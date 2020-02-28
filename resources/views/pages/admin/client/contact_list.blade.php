<!DOCTYPE html>
<html>

<head>
    <title>HRWS | Client Contacts</title>
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
                    <div class="col-md-12 pad_bot1">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <h5>Client Contacts</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="w-100 user_list">
                                <div class="col-sm-12">
                                    <div class="w-100 white-box">
                                        <div class="col-12 searchbox">
                                            <form method="post" action="/admin/clientContact" enctype="multipart/form-data">
                                                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="id" value="{{ $company_id  }}">

                                                <div class="row">
                                                    <div class="col-md-2 leftClient">
                                                        <div class="row">
                                                            <h5>{{ $company_name  }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <div class="row">
                                                                    @include('pages-message.form-submit')
                                                                    @include('pages-message.notify-msg-success')
                                                                    @include('pages-message.notify-msg-error')
                                                                </div>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <div class="row right_head">
                                                                    <div class="searchPlus search_container1">
                                                                        <i class="fa fa-search searchIcon"></i><input type="text" name="search" class="dtable_search" placeholder="Search..">
                                                                        <a href=""><i class="fas fa-times searchIcon"></i></a>
                                                                    </div>
                                                                    <a href="/admin/contact_add?id={{ $company_id }}"><button type="button" class="std_butU btn btn-primary"><i class="fas fa-plus" data-toggle="tooltip" title="Add Client"></i></button></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        @foreach($data as $client)
                                        <div class="col-md-12 clienters">
                                            <div class="row">
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <div class="row">
                                                            <div class="profile_pic">
                                                                <img class="img-fluid" src="/images/Permissions.png">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-11 log_form1">
                                                        <div class="row">
                                                            <div class="col-md-6 pad_bot">
                                                                <div class="row">
                                                                    <h5>{{ $client['contact_person'] }}</h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="row right_head">
                                                                    <div class="iconBorder clientEdit" style="cursor:pointer;" data-toggle="tooltip" title="Edit">
                                                                        <a href="/admin/contact_edit?id={{ \Crypt::encrypt($client['id']) }}"><i class="fas fa-pencil-alt"></i></a>
                                                                    </div>
                                                                    <div class="iconBorder clientEdit" style="cursor:pointer;" data-toggle="tooltip" title="Delete">
                                                                        <i class="far fa-trash-alt" data-toggle="modal" data-target="#delmodal" data-id="{{ \Crypt::encrypt($client['id']) }}" title="Delete"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-md-3 log_form">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="row">
                                                                                    <div class="col-md-3 col-2 pad_bot">
                                                                                        <div class="row">
                                                                                            <i class="clientIcons tick fas fa-id-card-alt"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-9 col-10">
                                                                                        <div class="row">
                                                                                            <p>{{ $client['designation'] }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="row">
                                                                                    <div class="col-md-3 col-2 pad_bot">
                                                                                        <div class="row">
                                                                                            <i class="clientIcons tick fas fa-user-check"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-9 col-10">
                                                                                        <div class="row clientParent">
                                                                                            <select class="client_drop form-control child1" name="sellist1">
                                                                                                <option value="">Assign To:</option>
                                                                                                @if(isset($account_managers))
                                                                                                @foreach($account_managers as $managers)

                                                                                                <option value="{{ \Crypt::encrypt($managers['id']) }}" {{ ( $managers['id'] == $client['assigned_to'] ) ? 'selected' : '' }}> {{ $managers['name'] }} </option>

                                                                                                @endforeach
                                                                                                @endif
                                                                                            </select>
                                                                                            <input class="child2" type="hidden" value="{{ \Crypt::encrypt($client['id']) }}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 log_form">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="row">
                                                                                    <div class="col-md-3 col-2 pad_bot">
                                                                                        <div class="row">
                                                                                            <i class="clientIcons tick fas fa-phone-volume"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-9 col-10">
                                                                                        <div class="row">
                                                                                            <p>{{ $client['mobile'] }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="row">
                                                                                    <div class="col-md-3 col-2 pad_bot">
                                                                                        <div class="row">
                                                                                            <i class="clientIcons tick far fa-envelope"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-9 col-10">
                                                                                        <div class="row">
                                                                                            <p>{{ $client['email'] }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 log_form2">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="row">
                                                                                    <div class="col-md-3 col-2 pad_bot">
                                                                                        <div class="row">
                                                                                            <i class="clientIcons tick fas fa-street-view"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-9 col-10">
                                                                                        <div class="row">
                                                                                            <p>{{ $client['city'] }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="row">
                                                                                    <div class="col-md-3 col-2 pad_bot">
                                                                                        <div class="row">
                                                                                            <i class="clientIcons tick fas fa-fax"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-9 col-10 numberclient">
                                                                                        <div class="row">
                                                                                            <p>{{ $client['fax'] }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 log_form clientAddress">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="row">
                                                                                    <div class="col-md-3 col-2 pad_bot">
                                                                                        <div class="row">
                                                                                            <i class="clientIcons tick fas fa-map-marked-alt"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-9 col-10">
                                                                                        <div class="row">
                                                                                            <p> {{ $client['address1'] }},{{ $client['address2'] }},{{ $client['city'] }},{{ $client['country'] }}</p>
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
    </div>

    <div class="modal fade" id="delmodal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form method="post" action="/admin/contact_delete" enctype="multipart/form-data">
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
                        <button type="submit" class="btn btn-secondary">Delete</button><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#show').click(function() {
                $('.menu').toggle("slide");
            });
        });
    </script>

    <script>
        $("#selectAll").click(function() {
            $("input[type=checkbox]").prop('checked', $(this).prop('checked'));

        });
    </script>
    <script type="text/javascript">
        document.getElementById("client_item").classList.add("active1");
        document.getElementById("client_link").classList.add("active");
        document.getElementById("client_span").classList.add("active");
    </script>
</body>