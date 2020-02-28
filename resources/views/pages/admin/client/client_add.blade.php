<!DOCTYPE html>
<html>

<head>
    <title>HRWS | Add Clients</title>
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
                                    <h5>Add Client</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form class="request" method="post" action="" enctype="multipart/form-data" autocomplete="off">
                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
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
                                                            <input type="text" class="s_form form-control" placeholder="Name" name="client_name" value="{{ old('client_name') }}" required><i class="new_holder far fa-user"></i>
                                                          
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="">
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="s_form form-control" placeholder="Email" name="client_email" value="{{ old('client_email') }}" required><i class="new_holder far fa-envelope"></i>
                                                           
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
                                                            <input type="text" class="s_form form-control" placeholder="Website" name="client_website" value="{{ old('client_website') }}" required><i class="new_holder fab fa-internet-explorer"></i>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="">
                                                        <div class="input-group mb-3">
                                                            <input type="number" class="s_form form-control" placeholder="Contact No:" name="client_contactNo" value="{{ old('client_contactNo') }}" required><i class="new_holder fas fa-mobile-alt"></i>
                                                            
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
                                                            <input type="text" class="s_form form-control" placeholder="Address 1" name="address1"><i class="new_holder fas fa-map-marked-alt"></i>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="">
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="s_form form-control" placeholder="Address 2" name="address2"><i class="new_holder fas fa-map-marked-alt"></i>
                                                            
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
                                                                <input type="hidden" id="oldCountryID" value="{{old('client_country')}}">
                                                                <select class="form-control" id="client_country" name="client_country">
                                                                    <option value="">Select Country</option>
                                                                    @if(isset($countriesList))
                                                                    @foreach($countriesList as $countries)
                                                                    @if(old('client_country') == $countries['id']  )
                                                                    <option value="{{ $countries['id'] }}" selected>{{ $countries['name'] }}</option>
                                                                    @else
                                                                    <option value="{{ $countries['id'] }}">{{ $countries['name'] }}</option>
                                                                    @endif
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
                                                                <input type="hidden" id="oldStateID" value="{{old('client_state')}}">
                                                                <select name="client_state" id="client_state" class="form-control">
                                                                    <option value="">Select State</option>
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
                                                                <input type="hidden" id="oldCityID" value="{{old('client_city')}}">
                                                                <select name="client_city" id="client_city" class="form-control">
                                                                    <option value="">Select City</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                             <div class="col-md-6">
                                                <div class="">
                                                    <div class="input-group">
                                                        <div class="w-100 form-group">
                                                           <input type="file" name="logo_name" id="file" onchange="fileCheck(this);"><br><br><span style="font-size: 12px;"> Upload Size Max: 2MB ( jpg, png, jpeg )</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                           </div>
                                        </div>

                                        {{-- <div class="col-md-12">
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
                                                <button type="submit" class="std_but btn btn-primary">Save</button>
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
    <script type="text/javascript">
        $(window).on('load', function(){
          var countryID = $("#oldCountryID").val();
          var stateID   = $("#oldStateID").val();
          var cityID    = $("#oldCityID").val();

            if (countryID) {
                    $.ajax({
                        type: "GET",
                        url: "api/get-state-list?country_id=" + countryID,

                        success: function(res) {
                            if (res) {
                                $("#client_state").empty();
                                $("#client_state").append('<option value="">Select State</option>');
                                $.each(res, function(key, value) {
                                    if(key == stateID)
                                    $("#client_state").append('<option value="' + key + '" selected>' + value + '</option>');
                                    else
                                    $("#client_state").append('<option value="' + key + '">' + value + '</option>');
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

            if (stateID) {
            $.ajax({
                type: "GET",
                url: "api/get-city-list?state_id=" + stateID,
                success: function(res) {
                    if (res) {
                        $("#client_city").empty();
                        $.each(res, function(key, value) {
                            if(key == cityID)
                                $("#client_city").append('<option value="' + key + '" selected>' + value + '</option>');
                            else
                                 $("#client_city").append('<option value="' + key + '">' + value + '</option>');
                        });

                    } else {
                        $("#client_city").empty();
                    }
                }
            });
        } else {
            $("#client_city").empty();
        }
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