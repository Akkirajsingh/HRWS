<!DOCTYPE html>
<html>

<head>
    <title>HRWS | Edit Contact</title>
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
                                <h5>Edit Contact</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <form class="request" method="post" id="formadd" action="/admin/contact_edit" enctype="multipart/form-data">
                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="contact_id" id="contact_id" value="{{ \Crypt::encrypt($data['id']) }}">
                    <input type="hidden" name="client_id" id="client_id" value="{{ \Crypt::encrypt($data['client_id']) }}">

                    <div class="col-md-12 user_list1">
                        @include('pages-message.notify-msg-error')
                        @include('pages-message.form-submit')
                        <div class="row d_center">
                            <div class="col-md-12 cont_name">
                                <div class="">
                                    <h5>{{ ucfirst($companyInfo->name) }}</h5>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="">
                                                    <div class="input-group mb-3">
                                                        <label class="w-100" for="accname label_text"><span class="label_text">Name Of Contact:</span></label>
                                                        <input type="text" class="s_form form-control" placeholder="Name"  name="client_name" value="{{ $data['contact_person'] }}" required><i class="new_holder1 far fa-user"></i>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="">
                                                    <div class="input-group mb-3">
                                                        <label class="w-100" for="accname label_text"><span class="label_text">Assigned To:</span></label>
                                                        <select class="w-100 form-control" id="client_assigned_to" name="client_assigned_to">
                                                            <option value="">Assign To:</option>
                                                            @if(isset($account_managers))
                                                                @foreach($account_managers as $managers)
                                                                <option value="{{ $managers['id'] }}" {{ (collect(old('client_assigned_to'))->contains($managers['id'])) ? 'selected':'' }} {{ ($data['assigned_to'] ==$managers['id']) ? 'selected' : ''}} > {{ $managers['name'] }} </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
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
                                                        <label class="w-100" for="accname label_text"><span class="label_text">Designation:</span></label>
                                                        <input type="text" class="s_form form-control" placeholder="Designation" name="designation" value="{{ $data['designation']  }}"><i class="new_holder1 fas fa-user"></i>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="">
                                                    <div class="input-group mb-3">
                                                        <label class="w-100" for="accname label_text"><span class="label_text">Email:</span></label>
                                                        <input type="text" class="s_form form-control" placeholder="Email" name="client_email" value="{{ $data['email']  }}" required><i class="new_holder1 far fa-envelope"></i>
                                                        
                                                    </div>
                                                <!-- <div class="input-group mb-3">
                                                        <input type="tel" class="s_form form-control" placeholder="Contact No:"  name="client_contactNo" value="{{ $data['mobile'] }}">
                                                        <div class="input-group-append">
                                                            <span class="form_right input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $countriesList = getCountries();
                                    ?>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="">
                                                    <div class="input-group">
                                                        <label class="w-100" for="accname label_text"><span class="label_text">Country:</span></label>
                                                        <div class="w-100 form-group">
                                                            <select class="form-control" id="client_country" name="client_country" required>
                                                                <option value="">Select Country</option>
                                                                @if(isset($countriesList))
                                                                    @foreach($countriesList as $countries)
                                                                        <option value="{{ $countries['id'] }}" {{ ( $countries['name'] == $data['country']  ) ? 'selected' : '' }}> {{ $countries['name'] }} </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="">
                                                    <div class="input-group">
                                                        <label class="w-100" for="accname label_text"><span class="label_text">State:</span></label>
                                                        <div class="w-100 form-group">
                                                            <select name="client_state" id="client_state" class="form-control" required>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="">
                                                    <div class="input-group">
                                                        <label class="w-100" for="accname label_text"><span class="label_text">City:</span></label>
                                                        <div class="w-100 form-group">
                                                            <select name="client_city" id="client_city" class="form-control" required>
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
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="">
                                                            <div class="input-group">
                                                                <label class="w-100" for="accname label_text"><span class="label_text">Country Code:</span></label>
                                                                <div class="w-100 form-group">
                                                                    <select class="form-control" id="client_phonecode" name="client_phonecode" disabled>
                                                                        <option value="">Select</option>
                                                                        @if(isset($countriesList))
                                                                            @foreach($countriesList as $countries)
                                                                              <option value="{{ $countries['id'] }}" {{ ( $countries['phonecode'] == $data['isd_code']  ) ? 'selected' : '' }}> {{ $countries['phonecode'] }} </option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="">
                                                            <div class="input-group mb-3">
                                                                <label class="w-100" for="accname label_text"><span class="label_text">Mobile No:</span></label>
                                                                <input type="number" class="s_form form-control" name="client_contactNo" value="{{ $data['mobile'] }}" required><i class="new_holder1 fas fa-mobile-alt"></i>
                                                           
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="">
                                                            <div class="input-group mb-3">
                                                                <label class="w-100" for="accname label_text"><span class="label_text">LandLine:</span></label>
                                                                <input type="text" class="s_form form-control" name="client_phone" value="{{ $data['phone'] }}"><i class="new_holder1 fas fa-tty"></i>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="">
                                                            <div class="input-group mb-3">
                                                                <label class="w-100" for="accname label_text"><span class="label_text">Fax:</span></label>
                                                                <input type="text" class="s_form form-control" name="client_fax" value="{{ $data['fax'] }}"><i class="new_holder1 fas fa-fax"></i>
                                                                
                                                            </div>
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
                                                    <div class="input-group mb-3">
                                                        <label class="w-100" for="accname"><span class="label_text">Address 1:</span></label>
                                                        <input type="text" class="s_form form-control" placeholder="Address 1" name="address1" value="{{ $data['address1'] }}"><i class="new_holder1 fas fa-map-marked-alt"></i>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="">
                                                    <div class="input-group mb-3">
                                                        <label class="w-100" for="accname label_text"><span class="label_text">Address 2:</span></label>
                                                        <input type="text" class="s_form form-control" placeholder="Address 2" name="address2" value="{{ $data['address2'] }}"><i class="new_holder1 fas fa-map-marked-alt"></i>
                                                        
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
                                                        <input type="hidden" id="place_id"  name="place_id">
                                                        <input type="text" class="s_form form-control" name="address" placeholder="Search Your Location"  id="searchplace"  name="place" value="{{ $data['google_place'] }}"><i id="btnClear" class="new_holder tick fas fa-times" data-toggle="tooltip" title="Clear" style="cursor:pointer"></i>

                                                        <div class="col-md-12 add_forms">
                                                            <div class="row">
                                                                <div id="map" style="width:500px;  height:200px;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    document.getElementById("client_item").classList.add("active1");
    document.getElementById("client_link").classList.add("active");
    document.getElementById("client_span").classList.add("active");
</script>

<script type="text/javascript">
    // Initial load state
    var CountryId = document.getElementById("client_country").value;
    var StateId = <?= $stateId ?>;
    if(CountryId){
        $.ajax({
            type:"GET",
            url:"api/get-state-list?country_id="+CountryId,

            success:function(res){

                if(res){
                    $("#client_state").empty();
                    $("#client_state").append('<option>Select State</option>');
                    $.each(res,function(key,value){

                        var selected = (key == StateId) ? "selected" : '';
                        $("#client_state").append('<option  value="'+key+'" '+selected+'>'+value+'</option>');
                    });

                }else{
                    $("#client_state").empty();
                }
            }
        });
    }else{
        $("#client_state").empty();
        $("#client_city").empty();
    }

    // Initial load city
    var CityId = <?= $cityId ?>;
    if(StateId){
        $.ajax({
            type:"GET",
            url:"api/get-city-list?state_id="+StateId,
            success:function(res){
                if(res){
                    $("#client_city").empty();
                    $.each(res,function(key,value){
                        var selected = (key == CityId) ? "selected" : '';

                        $("#client_city").append('<option value="'+key+'" '+selected+'>'+value+'</option>');
                    });

                }else{
                    $("#client_city").empty();
                }
            }
        });
    }else{
        $("#client_city").empty();
    }

</script>
<script type="text/javascript">
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 25.2048, lng: 55.2708},
            zoom: 13
        });

        var input = document.getElementById('searchplace');
        var autocomplete = new google.maps.places.Autocomplete(input);

        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);

        // Set the data fields to return when the user selects a place.
        autocomplete.setFields(['place_id','address_components', 'geometry', 'icon', 'name','formatted_address']);


        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });


        if(input){
            var service = new google.maps.places.PlacesService(map);
            service.getDetails({
                placeId: '{{ $data['place_id'] }}'
            }, function(result) {
                marker.setVisible(false);
                map.fitBounds(result.geometry.viewport);
                marker.setPosition(result.geometry.location);
                marker.setVisible(true);
            });
        }


        autocomplete.addListener('place_changed', function() {
            marker.setVisible(false);
            var place = autocomplete.getPlace();

            document.getElementById("place_id").value=place.place_id;
            if (!place.geometry) {
                // User entered the name of a Place that was not suggested and
                // pressed the Enter key, or the Place Details request failed.
                window.alert("No details available for input: '" + place.name + "'");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);  // Why 17? Because it looks good.
            }
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
        });
    }
</script>
<script  type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBB552l6LmxUK7jWamAMtlDNwk179SSg0A&libraries=places&callback=initMap"
         async defer></script>
</body>
</html>