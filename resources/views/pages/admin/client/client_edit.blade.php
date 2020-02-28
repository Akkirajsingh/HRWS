<!DOCTYPE html>
<html>

<head>
    <title>HRWS | Edit Client</title>
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
                                    <h5>Edit Client</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form class="request" method="post" action="/admin/client_edit" enctype="multipart/form-data">
                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="client_id" id="client_id" value="{{ \Crypt::encrypt($data['id']) }}">

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
                                                            <input type="text" class="s_form form-control" placeholder="Name" name="client_name" value="{{ $data['name'] }}" required><i class="new_holder far fa-user"></i>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="">
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="s_form form-control" placeholder="Email" name="client_email" value="{{ $data['email']  }}" required><i class="new_holder far fa-envelope"></i>
                                                            
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
                                                            <input type="text" class="s_form form-control" placeholder="Website" name="client_website" value="{{ $data['website']  }}" required><i class="new_holder fab fa-internet-explorer"></i>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="">
                                                        <div class="input-group mb-3">
                                                            <input type="number" class="s_form form-control" placeholder="Contact No:" name="client_contactNo" value="{{ $data['contact_no'] }}" required><i class="new_holder fas fa-mobile-alt"></i>
                                                            
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
                                                            <input type="text" class="s_form form-control" placeholder="Address 1" name="address1" value="{{ $data['address1'] }}"><i class="new_holder fas fa-map-marked-alt"></i>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="">
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="s_form form-control" placeholder="Address 2" name="address2" value="{{ $data['address2'] }}"><i class="new_holder fas fa-map-marked-alt"></i>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $countriesList = getCountries();
                                        ?>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="">
                                                        <div class="input-group">
                                                            <div class="w-100 form-group">
                                                                <select class="form-control" id="client_country" name="client_country">
                                                                    <option value="">Select Country</option>
                                                                    @if(isset($countriesList))
                                                                    @foreach($countriesList as $countries)
                                                                    <option value="{{ $countries['id'] }}" {{ ( $countries['name'] == $data['country'] ) ? 'selected' : '' }}> {{ $countries['name'] }} </option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="">
                                                        <div class="input-group">
                                                            <div class="w-100 form-group">
                                                                <select name="client_state" id="client_state" class="form-control">
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                        <div class="row">
                                                <div class="col-md-6">
                                                    <div class="">
                                                        <div class="input-group">
                                                            <div class="w-100 form-group">
                                                                <select name="client_city" id="client_city" class="form-control">
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div class="col-md-6">
                                                        <div class="">
                                                            <div class="input-group">
                                                                <div class="w-100 form-group">
                                                                    <input type="file" name="logo_name" id="file" onchange="fileCheck(this);"><br><span style="font-size: 12px;"> Upload Size Max: 2MB ( jpg, png, jpeg )</span><br>
                                                                    @if($data['logo_name'] )
                                                                     <img src= " {{ url('/images/clients/'.$data['logo_name']) }}" style="width:90px; height:90px; float:left;  margin-right:25px;"><br>
                                                                     <span data-toggle="modal" class="deleteLogo" data-target="#deleteLogo" 
                                                                     data-id="{{\Crypt::encrypt($data['id']) }}" style="cursor: pointer;">
                                                                     <i class="act_table far fa-trash-alt"></i></span> 
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                 </div>
                                            </div>

                                        {{--<div class="col-md-12">
                                        <div class="row">
                                        <div class="col-md-6">
                                                <div class="">
                                                    <div class="input-group">
                                                        <input type="text" class="w-100 form-control" style="margin-bottom:1em;" id="searchplace" placeholder="Search Location" name="place">
                                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.992353059971!2d77.64976461418946!3d12.908212819760053!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae148453748f87%3A0x5092ab9f9194a949!2sOrbio%20Solutions%20Pvt%20Ltd!5e0!3m2!1sen!2sin!4v1569933779139!5m2!1sen!2sin"
                                                            width="500" height="200" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>--}}
                                        <div class="col-md-12">
                                            <div class="d_right">
                                                <button type="button" id="popup" data-id="/admin/client" data-toggle="modal" data-target="#cancelPopup" class="std_but1 btn btn-primary del">Cancel</button>
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
     <div class="modal fade" id="deleteLogo">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Confirm Delete</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h6>Are you sure you want to delete this logo ?</h6>
                </div>
                <div class="modal-footer">
               <form action="/admin/delete_client_logo" method="post">   
                <input type="hidden" id="client_val" name="client_id" value="">
                <button type="submit" class="std_butU btn btn-secondary" value="Submit">Delete</button>
               </form>                      
                 <button type="button" class="std_but1 btn btn-secondary" data-dismiss="modal">Close</button>
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
     <script type="text/javascript">
        $('document').ready(function() {
        $('.deleteLogo').click(function() {
        var clientId = $(this).data('id');
        $('#client_val').val(clientId);
        });
        });
    </script>
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
        document.getElementById("client_item").classList.add("active1");
        document.getElementById("client_link").classList.add("active");
        document.getElementById("client_span").classList.add("active");
    </script>

    <script type="text/javascript">
        // Initial load state 
        var ClientCountryId = document.getElementById("client_country").value;
        var ClientStateId = "{{ $stateId }}";
        if (ClientCountryId) {
            $.ajax({
                type: "GET",
                url: "api/get-state-list?country_id=" + ClientCountryId,

                success: function(res) {

                    if (res) {
                        $("#client_state").empty();
                        $("#client_state").append('<option>Select State</option>');
                        $.each(res, function(key, value) {

                            var selected = (key == ClientStateId) ? "selected" : '';
                            $("#client_state").append('<option  value="' + key + '" ' + selected + '>' + value + '</option>');
                        });

                    } else {
                        $("#client_state").empty();
                    }
                }
            });
        } else {
            $("#client_state").empty();
            $("#client_city").empty();
        }
        // Initial load city
        var ClientCityId = "{{ $cityId}}";
        if (ClientStateId) {
            $.ajax({
                type: "GET",
                url: "api/get-city-list?state_id=" + ClientStateId,
                success: function(res) {
                    if (res) {
                        $("#client_city").empty();
                        $.each(res, function(key, value) {
                            var selected = (key == ClientCityId) ? "selected" : '';

                            $("#client_city").append('<option value="' + key + '" ' + selected + '>' + value + '</option>');
                        });

                    } else {
                        $("#client_city").empty();
                    }
                }
            });
        } else {
            $("#client_city").empty();
        }
    </script>
      <!-- File Check -->
    <script type="text/javascript">
       function fileCheck(file){
            var ext = $('#file').val().split('.').pop().toLowerCase();
            if($.inArray(ext, ['jpg','png','jpeg']) == -1) {
                alert('Invalid extension! Please Select "jpg or png or jpeg " File');
                location.reload();
            }
            var FileSize = file.files[0].size / 1024 / 1024; // in MB
            if (FileSize > 2) {
                alert('File size exceeds 2 MB');
                location.reload();
            }
    }
    </script>
</body>

</html>