<!DOCTYPE html>
<html>

<head>
    <title>HRWS | Users</title>
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
                            <div class="col-12">
                                <div class="row">
                                    <h5>Users</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="w-100 user_list">
                                <div class="table-responsive">
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
                                                    <div class="row d_right">
                                                        <form method="post" action="/admin/user_list" enctype="multipart/form-data" autocomplete="off">
                                                            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                                                            <div class="mar2 search_container">
                                                                <i class="fa fa-search searchIcon"></i>
                                                                <input type="text" name="search" class="dtable_search" placeholder="Search..">
                                                                <a href=""><i class="fas fa-times searchIcon"></i></a>
                                                            </div>
                                                        </form>
                                                        <div class="adder">
                                                    <a href="/admin/user_add"><button type="submit" class="std_butU btn btn-primary"><i class="fas fa-plus" data-toggle="tooltip" title="Add User"></i></button></a>
                                                </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <thead>
                                            <tr class="text_center">
                                                <th class="list_head">Name</th>
                                                <!-- <th class="list_head">Designation</th> -->
                                                <th class="list_head">Display Name</th>
                                                <th class="list_head">Mobile</th>
                                                <th class="list_head">Email</th>
                                                {{--<th class="list_head">Designation</th>--}}
                                                <th class="list_head">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $user)
                                            <tr class="text_center">
                                                <td>{{ $user['name']}}</td>
                                                <!-- <td>{{ $user['designation']  }}</td> -->
                                                <td>{{ $user['display_name'] }}</td>
                                                <td>{{ $user['mobile'] }}</td>
                                                <td>{{ $user['email'] }}</td>
                                                {{--<td>{{ $user['designation']  }}</td>--}}
                                                <td>
                                                    <?php $user_id = $user['id']; ?>
                                                    <a href="/admin/user_edit?user_id={{ \Crypt::encrypt($user_id)  }}"><i class="act_table fas fa-pencil-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                                    @if(Auth::user()->id != $user_id)
                                                    <span data-toggle="modal" class="deluser" data-target="#deluser" data-id="{{\Crypt::encrypt($user_id) }}"><i class="act_table far fa-trash-alt"></i></span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $data->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deluser">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Confirm Delete</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h6>Are you sure you want to delete this entry ?</h6>
                </div>
                <div class="modal-footer">
                    <form action="/admin/user_delete" method="get">
                        @csrf
                        <input type="hidden" id="user_id" name="user_id" value="">
                        <button type="submit" class="std_butU btn btn-secondary" value="Submit">Delete</button>
                    </form>
                    <button type="button" class="std_but1 btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('document').ready(function() {
            $('.deluser').click(function() {
                var UserId = $(this).data('id');
                $('#user_id').val(UserId);
            });
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
        document.getElementById("user_item").classList.add("active1");
        document.getElementById("user_link").classList.add("active");
        document.getElementById("user_span").classList.add("active");
    </script>
</body>

</html>