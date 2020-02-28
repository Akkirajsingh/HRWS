<!DOCTYPE html>
<html>

<head>
    <title>HRWS | Edit User</title>
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
                    <div class="col-md-12 pad_bot1">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <h5>Edit User</h5>
                                    <?php //dd($data); 
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form class="request" method="post" action="" enctype="multipart/form-data" autocomplete="off">
                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="user_id" id="user_id" value="{{ \Crypt::encrypt($data['user']['id']) }}">
                        <div class="col-md-12 user_list1">
                            @include('pages-message.notify-msg-error')
                            @include('pages-message.form-submit')
                            <div class="row d_center">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="">
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="s_form form-control" placeholder="Name" name="name" value="{{ $data['user']['name']  }}" minlength="3" maxlength="40" required><i class="new_holder far fa-user"></i>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="">
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="s_form form-control" placeholder="Email" name="email" value="{{ $data['user']['email']  }}" readonly required><i class="new_holder far fa-envelope"></i>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="">
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="s_form form-control" placeholder="Display Name" name="display_name" value="{{ $data['user']['display_name'] }}" required><i class="new_holder far fa-user"></i>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="">
                                                        <div class="input-group mb-3">
                                                            <div class="dropdown">
                                                                <button type="button" class="s_form1 role_drop btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                                    Select Role
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <ul class="role_list">
                                                                        @foreach($data['roles'] as $role)
                                                                        @if($role['editable']=='1')
                                                                        <?php $display_name = $role['display_name']; ?>
                                                                        @else
                                                                        <?php $display_name = $role['display_name'] . "*"; ?>
                                                                        @endif
                                                                        <li>
                                                                            @if(in_array($role['id'], $data['user_role']))
                                                                            <input type="checkbox" name="user_role[]" value="{{ $role['id'] }}" checked /> {{ $display_name }}
                                                                            @else
                                                                            <input type="checkbox" name="user_role[]" value="{{ $role['id'] }}" /> {{ $display_name }}
                                                                            @endif
                                                                        </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">

                                                {{-- <div class="col-md-6">
                                                <div class="">
                                                    <div class="input-group mb-3">
                                                        <select class="s_form1 form-control" id="sel1" name="designation">
                                                            <option>Designation</option>
                                                            @foreach($data['designation'] as $designation)
                                                                @if($data['user']['designation'] == $designation)
                                                                    <option value="{{ $designation  }}" selected>{{ $designation }}</option>
                                                @else
                                                <option value="{{ $designation  }}">{{ $designation }}</option>
                                                @endif
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>--}}
                                    <div class="col-md-6">
                                        <div class="">
                                            <div class="input-group mb-3">
                                                <input type="tel" class="s_form form-control" placeholder="Mob No: " name="mobile" value="{{ $data['user']['mobile'] }}" required><i class="new_holder fas fa-mobile-alt"></i>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="">
                                                    <div class="input-group mb-3">
                                                        <select class="s_form1 form-control" id="sel1" name="dept">
                                                            <option>Department</option>
                                                            @foreach($data['dept'] as $dept)
                                                                @if($data['user']['dept'] == $dept)
                                                                    <option value="{{ $dept  }}" selected>{{ $dept }}</option>
                                                                @else
                                                                    <option value="{{ $dept  }}">{{ $dept }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                            <div class="col-md-12">
                                <div class="d_right">
                                    <button type="button" id="popup" data-id="/admin/user_list" data-toggle="modal" data-target="#cancelPopup" class="std_but1 btn btn-primary del" value="/admin/user_list">Cancel</button>
                                    <button type="submit" class="std_but btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    </div>
    </div>
    </div>

    <!-- <script>
        $(document).ready(function() {
            $('#example').DataTable({
                // "sDom": 'Rfrtlip',
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
        document.getElementById("user_item").classList.add("active1");
        document.getElementById("user_link").classList.add("active");
        document.getElementById("user_span").classList.add("active");
    </script>
</body>

</html>