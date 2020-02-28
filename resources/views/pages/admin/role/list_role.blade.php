<!DOCTYPE html>
<html>

<head>
    <title>HRWS | Roles</title>
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
                    <div class="col-12 pad_bot1">
                        <div class="row">
                            <div class="col-3 col-lg-9">
                                <div class="row">
                                    <h5>Roles</h5>
                                </div>
                            </div>
                            <div class="col-9 col-lg-3">
                                <div class="row right_head">
                                    <button type="submit" class="std_but btn btn-primary" data-toggle="modal" data-target="#role_modal"><i class="far fa-user"></i>&nbsp;&nbsp;Add Role</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="w-100 user_list">
                                <form id="role_form" method="post" action="" enctype="multipart/form-data" autocomplete="off">
                                    <table id="example" class="user_listing table" style="width:100%">
                                        <div class="col-12 searchbox">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="row">
                                                        @include('pages-message.form-submit')
                                                        @include('pages-message.notify-msg-success')
                                                        @include('pages-message.notify-msg-error')
                                                    </div>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="row  d_right">
                                                        <form method="post" action="/admin/role" enctype="multipart/form-data">
                                                            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                                                            <div class="search_container">
                                                                <i class="fa fa-search searchIcon"></i><input type="text" name="search" class="dtable_search" placeholder="Search.."><a href=""><i class="fas fa-times searchIcon"></i></a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <thead>
                                            <tr class="text_center">
                                                <th class="list_head">Name</th>
                                                <th class="list_head">Role</th>
                                                <th class="list_head">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $role)
                                            <tr class="text_center">
                                                <td class="popcontent" id="defValue">{{ $role['name']  }}</td>
                                                <td>{{ $role['display_name'] }}</td>
                                                <td>
                                                    <a class="act_table fas fa-pencil-alt" data-toggle="modal" data-target="#editmodal" title="Edit" onClick="updateRole('{{ \Crypt::encrypt($role['id'])  }}','{{ $role['display_name'] }}')" href=""></a>

                                                    {{-- <a href="/admin/role_edit?id={{ \Crypt::encrypt($role['id'])  }}">
                                                    TEST
                                                    </a>&nbsp;--}}&nbsp;&nbsp;&nbsp;
                                                    <a href="/admin/role_delete?id={{ \Crypt::encrypt($role['id'])  }}"><i class="act_table far fa-trash-alt" title="Delete"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label class="switch">
                                                        @if($role['active']==1)
                                                        <input id='roleToggle' type="checkbox" value="{{ \Crypt::encrypt($role['id']) }}" checked>
                                                        @else
                                                        <input id='roleToggle' type="checkbox" value="{{ \Crypt::encrypt($role['id']) }}">
                                                        @endif
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $data->links() }}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="editmodal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" id="editRole" action="/admin/role_update" enctype="multipart/form-data" autocomplete="off" <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="role_id" id="role_id">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Role</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="text" class="s_form form-control" placeholder="Edit Role" name="role_value" id="edit_role" minlength="3" maxlength="10"><i class="new_holder fas fa-user-tie"></i>

                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="std_but btn btn-danger">Update</button>
                        <button type="button" class="std_but btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="role_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" id="submitRole" action="/admin/role_add" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add Role</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="text" class="s_form form-control" placeholder="Add Role" name="role" id="role" minlength="3" maxlength="10"><i class="new_holder fas fa-user-tie"></i>

                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="std_but btn btn-danger">Add</button>
                        <button type="button" class="std_but btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "sDom": 'Rfrtlip',
                "info": false,
            });
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
        document.getElementById("role_item").classList.add("active1");
        document.getElementById("role_link").classList.add("active");
        document.getElementById("role_span").classList.add("active");
    </script>
    <script type="text/javascript">
        function updateRole(role_id, roleName) {
            $("#edit_role").val(roleName);
            $("#role_id").val(role_id);
        }
    </script>
</body>

</html>