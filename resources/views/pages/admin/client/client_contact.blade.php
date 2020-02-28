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
                            <div class="w-100 user_list add_forms">
                                <div class="col-sm-12">
                                    <div class="w-100 white-box">
                                        <div class="col-12 searchbox">
                                            <div class="row">
                                                <div class="col-md-12">
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
                                                                <div class="search_container1">
                                                                    <form method="post" action="/admin/searchclientContact" enctype="multipart/form-data">
                                                                        <i class="fa fa-search searchIcon"></i><input type="text" class="dtable_search" placeholder="Search.." name="search">
                                                                        <a href="/admin/client_contact"><i class="fas fa-times searchIcon"></i></a>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 client_tables">
                                                    <div class="row">
                                                        @if($clientList)
                                                        @foreach($clientList as $clients)
                                                        <div id="accordion" style="width:100%;">
                                                            <div class="card account_collapse">
                                                                <div class="basic_shadow card-header account_head" id="headingOne">
                                                                    <h5 class="mb-0">
                                                                        <button class="acc_links btn btn-link" id="show" data-toggle="collapse" data-target="#{{ $clients['id'] }}" aria-expanded="false" aria-controls="{{ $clients['id'] }}">
                                                                            <div class="col-12">
                                                                                <div class="row">
                                                                                    <div class="col-md-1">
                                                                                        <div class="row">
                                                                                            @if($clients['logo_name'])
                                                                                            <img class="img-fluid" src="{{ url('/images/clients/'.$clients['logo_name']) }}" style="width:30px; height:30px;"><br>
                                                                                            @else
                                                                                            <img class="img-fluid" src="/images/Permissions.png" style="width:30px; height:30px;">
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="row text_center">
                                                                                            <p class="w-100 basic_font weight">{{ $clients['name'] }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="row text_center">
                                                                                            <p class="w-100 basic_font weight">No of Contacts &nbsp;
                                                                                                <span>({{ $clients['counts'] }})</span></p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="row text_center">
                                                                                            <p class="w-100 basic_font weight">
                                                                                                {{ $clients['website'] }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-2">
                                                                                        <div class="row text_center">
                                                                                            <a href="/admin/contact_add?id={{ \Crypt::encrypt($clients['id']) }}" class="tick"><i class="tick fa fa-plus" data-toggle="tooltip" title="Create Contact">&nbsp;</i></a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- <a href="addContact.html"><i class="collapse_add menu std_butU fas fa-plus" title="Add Contacts" style="display: none;"></i></a> -->
                                                                        </button>
                                                                    </h5>
                                                                </div>

                                                                <div id="{{ $clients['id'] }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                                    <div class="card-body acc_body">
                                                                        @if(isset($clients['contacts']))
                                                                        @foreach($clients['contacts'] as $contact)
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

                                                                                            <div class="col-md-12">
                                                                                                <div class="row">
                                                                                                    <h5>{{ $contact['contact_person'] }}</h5>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-12">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-3 log_form">
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-3 col-2 pad_bot">
                                                                                                                <div class="row">
                                                                                                                    <i class="clientIcons tick fas fa-id-card-alt"></i>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-9 col-10">
                                                                                                                <div class="row">
                                                                                                                    <p>
                                                                                                                        {{ $contact['designation'] }}</p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-3 col-2 pad_bot">
                                                                                                                <div class="row">
                                                                                                                    <i class="clientIcons tick fas fa-user-check"></i>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-9 col-10">
                                                                                                                <div class="row  clientParent">
                                                                                                                    <select class="client_drop form-control child1">
                                                                                                                        <option value="">Assign To:</option>
                                                                                                                        @if(isset($account_managers))
                                                                                                                        @foreach($account_managers as $managers)
                                                                                                                        <option value="{{ \Crypt::encrypt($managers['id'])}}" {{ ( $managers['id'] == $contact['assigned_to'] ) ? 'selected' : '' }}> {{ $managers['name'] }} </option>
                                                                                                                        @endforeach
                                                                                                                        @endif
                                                                                                                    </select>
                                                                                                                    <input class="child2" type="hidden" value="{{\Crypt::encrypt( $contact['id']) }}"> </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-3 log_form">
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-3 col-2 pad_bot">
                                                                                                                <div class="row">
                                                                                                                    <i class="clientIcons tick fas fa-phone-volume"></i>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-9 col-10">
                                                                                                                <div class="row">
                                                                                                                    <p>{{ $contact['mobile'] }}</p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-3 col-2 pad_bot">
                                                                                                                <div class="row">
                                                                                                                    <i class="clientIcons tick far fa-envelope"></i>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-9 col-10">
                                                                                                                <div class="row">
                                                                                                                    <p>{{ $contact['email'] }}</p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-3 log_form2">
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-3 col-2 pad_bot">
                                                                                                                <div class="row">
                                                                                                                    <i class="clientIcons tick fas fa-street-view"></i>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-9 col-10">
                                                                                                                <div class="row">
                                                                                                                    <p>{{ $contact['city'] }}</p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-3 col-2 pad_bot">
                                                                                                                <div class="row">
                                                                                                                    <i class="clientIcons tick fas fa-fax"></i>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-9 col-10 numberclient">
                                                                                                                <div class="row">
                                                                                                                    <p>{{ $contact['fax'] }}</p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-3 log_form clientAddress">
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-3 col-2 pad_bot">
                                                                                                                <div class="row">
                                                                                                                    <i class="clientIcons tick fas fa-map-marked-alt"></i>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-9 col-10">
                                                                                                                <div class="row">
                                                                                                                    <p>{{ $contact['address1'] }}</p>
                                                                                                                </div>
                                                                                                                <div class="row">
                                                                                                                    <p>{{ $contact['address2'] }}</p>
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
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @endif
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
    <div class="modal fade" id="delmodal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
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
                    <button type="button" class="btn btn-secondary">Delete</button><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <!-- <script>
        $(document).ready(function() {
            $('#show').click(function() {
                $('.menu').toggle("slide");
            });
        });
    </script> -->
    <script>
        $("#selectAll").click(function() {
            $("input[type=checkbox]").prop('checked', $(this).prop('checked'));

        });
    </script>

    <script type="text/javascript">
        document.getElementById("contact_item").classList.add("active1");
        document.getElementById("contact_link").classList.add("active");
        document.getElementById("contact_span").classList.add("active");
    </script>
</body>