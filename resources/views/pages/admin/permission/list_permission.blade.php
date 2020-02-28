<!DOCTYPE html>
<html>

<head>
    <title>HRWS | Permissions</title>
    @include('includes.external_dependency')
    @yield('includes.external_dependency-content')
</head>

<body>
    @include('includes.header')
    @yield('header-content')
    <div class="wrapper">
        @include('includes.admin.sidebar')
        @yield('admin.sidebar-content')
        @include('includes.cancel-modal-popup')
        <div class="mainContent">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 pad_bot add_sec">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <h5>Permission</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                        <form class="w-100" id="permission_form" method="post" action="/admin/permission-assign" enctype="multipart/form-data" autocomplete="off">
                            <div class="w-100 user_list">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="white-box">
                                            <div class="col-12 searchbox">
                                                <div class="row d_right">
                                                    <div class="col-lg-7 col-12">
                                                        <div class="row">
                                                            @include('pages-message.form-submit')
                                                            @include('pages-message.notify-msg-success')
                                                            @include('pages-message.notify-msg-error')
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-5">
                                                                <div class="row">
                                                                    <select name="role_id" class="drop_role form-control" id="role_id">
                                                                        <option value="">Select Roles</option>
                                                                        @foreach($data['role'] as $role)
                                                                        <option value="{{ \Crypt::encrypt($role['id'])  }}">{{ $role['display_name'] }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-7 search_container1">
                                                                <div class="row">
                                                                    <i class="fa fa-search searchIcon"></i><input type="text" id="search_permission" style="width:12em;" name="search" class="dtable_search" placeholder="Search..">
                                                                    <a href="/admin/permission"><i class="fas fa-times searchIcon"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <table id="example" class="user_listing table" style="width:100%">
                                                <thead>
                                                    <tr class="text_center">
                                                        <!-- <th class="list_head">Permission Code</th> -->
                                                        <th class="list_head">Permission List</th>
                                                        <th class="list_head">Assign</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($data['permission'] as $permission)
                                                    <tr class="text_center">
                                                        <!-- <td>{{ $permission['id'] }}</td> -->
                                                        <td>{{ $permission['display_name'] }}</td>
                                                        <td><input name="permission[]" type="checkbox" class="form-check-input" value="{{ $permission['id'] }}"></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 log_form permlog padright2">
                                        <div class="row right_head">
                                            <button type="button" id="popup" data-id="/admin/permission" data-toggle="modal" data-target="#cancelPopup" class="std_but1 btn btn-primary del">Cancel</button>
                                            <a href=""><button type="submit" class="std_but btn btn-primary">Save</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "sDom": 'Rfrtlip',
                "info": false,
            });
            // $('<div class="pull-right">' +
            //     '<select class="form-control">' +
            //     '<option value="volvo">Volvo</option>' +
            //     '<option value="saab">Saab</option>' +
            //     '<option value="opel">Opel</option>' +
            //     '</select>' +
            //     '</div>').appendTo("#example_wrapper .dataTables_filter");

            // $(".dataTables_filter label").addClass("pull-right");
        });
    </script> -->
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "searching": true,
                // "sDom": 'lrtip',
                "info": false,
                dom: "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-10'l><'col-sm-2'p>>",
            });
        });
    </script>
   
    <script type="text/javascript">
        document.getElementById("permission_item").classList.add("active1");
        document.getElementById("permission_link").classList.add("active");
        document.getElementById("permission_span").classList.add("active");
    </script>
</body>

</html>