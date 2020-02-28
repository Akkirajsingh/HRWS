<!DOCTYPE html>
<html>

<head>
    <title>HRWS | Add Requirement</title>
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
                                    <h5>Add Requirement</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form class="request" method="post" id="formadd" action="/add_requirement" enctype="multipart/form-data">
                        <input type="hidden" name="client_id" value="{{ \Crypt::encrypt($clientInfo->id) }}">
                        <input type="hidden" name="contact_id" value="{{ \Crypt::encrypt($contactInfo->id)}}">
                        <div class="col-md-12">
                            @include('pages-message.notify-msg-success')
                            @include('pages-message.notify-msg-error')
                            @include('pages-message.form-submit')
                            <div class="row">
                                <div class="col-12 accBox">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="">
                                                <div class="input-group mb-3">
                                                    <label class="w-100" for="dept"><span class="label_text">Assign To:</span></label>
                                                    <div class="w-100 form-group">
                                                        <select class="form-control" id="assigned_to" name="assigned_to">
                                                            <option value="">Assign To</option>
                                                            @if(isset($hrLeads))
                                                            @foreach($hrLeads as $leads)
                                                            <option value="{{ $leads['id'] }}" {{ $leads['id'] == old('assigned_to')  ? 'selected' : '' }}> {{ $leads['name'] }} </option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="">
                                                <div class="input-group mb-3">
                                                    <label class="w-100" for="dept"><span class="label_text">Priority:</span></label>
                                                    <div class="w-100 form-group">
                                                        <select class="form-control" id="priority" name="priority">
                                                            <option value="" selected hidden>Select</option>
                                                            @if(isset($priorities))
                                                            @foreach($priorities as $key => $value)
                                                            <option value="{{ $value }}" {{ $value == old('priority')  ? 'selected' : '' }}> {{ $value }} </option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="">
                                                <div class="input-group mb-3">
                                                    <label class="w-100" for="dept"><span class="label_text">Submission Date:</span></label>
                                                    <div id="datepicker" class="datepickerForm input-group date formdate" data-date-format="mm-dd-yyyy">
                                                        <input readonly type="text" class="form_right w-100 form-control" name="submission_date" autocomplete="off" value="{{old('submission_date')}}"/><i class="new_holder far fa-calendar-alt"></i>
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="">
                                                <div class="input-group mb-3">
                                                    <label class="w-100" for="dept"><span class="label_text">Lead Target Date:</span></label>
                                                        <div id="datepicker" class="clientEdit datepickerForm input-group date formdate" data-date-format="mm-dd-yyyy">
                                                            <input readonly  type="text" class="form_right w-100 form-control" name="lead_submit_date"  autocomplete="off"  value="{{old('lead_submit_date')}}"/><i class="new_holder far fa-calendar-alt"></i>
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-100 user_list add_forms">

                                    <div class="col-sm-12">
                                        <div class="white-box">
                                            <div class="col-12 searchbox">
                                                <div class="row d_right">
                                                    <div class="col-12 client_tables">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-md-1">
                                                                        <div class="row">
                                                                            @if($clientInfo->logo_name)
                                                                            <img src=" {{ url('/images/clients/'.$clientInfo->logo_name) }}" img class="img-fluid" style="width: 40px;height: 40px;"><br>
                                                                            @else
                                                                            <img class="img-fluid" style="width: 40px;height: 40px;" src="/images/permissions.png">
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2 log_remember">
                                                                        <div class="row">
                                                                            <h5 class="new_font">{{$clientInfo->name}}</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="right_head row">
                                                                            <h5 class="pad10 basic">Contact Person&nbsp;:</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 log_remember">
                                                                        <div class="row">
                                                                            <h5 class="w-100 pad12 basic1">{{ $contactInfo->contact_person}}</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="row d_right">
                                                                            <a href="/home" class="std_but1 btn btn-primary">Cancel</a>
                                                                            <button id="check" type="submit" class="std_but btn btn-primary">Save</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="accordion" style="width:100%;">
                                                                <div class="card account_collapse">
                                                                    <div class="card-header account_head" id="headingOne">
                                                                        <h5 class="mb-0">
                                                                            <a class="acc_links btn btn-link" id="show" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                                               <span class="basic"> Position</span>
                                                                                <i class="fas fa-chevron-down" style="float:right;"></i>
                                                                            </a>
                                                                        </h5>
                                                                    </div>

                                                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                                                        <div class="card-body acc_body">
                                                                            <div class="col-md-12">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="row">
                                                                                            <div class="col-md-4">
                                                                                                <div class="">
                                                                                                    <div class="input-group mb-3">
                                                                                                        <label class="w-100" for="task"><span class="label_text">Position Title:</span></label>
                                                                                                        <input type="text" class="s_form form-control" name="title" id="title" autocomplete="off" required value="{{old('title')}}"><i class="new_holder1 far fa-user"></i>

                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="">
                                                                                                    <div class="input-group mb-3">
                                                                                                        <label class="w-100" for="task"><span class="label_text">Job Location:</span></label>
                                                                                                        <input type="text" class="s_form form-control" name="location" id="location" autocomplete="off" value="{{old('location')}}"><i class="new_holder1 fas fa-city"></i>

                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="">
                                                                                                    <div class="input-group mb-3">
                                                                                                        <label class="w-100" for="dept"><span class="label_text">Salary Range:</span></label>
                                                                                                        <div class="col-md-12">
                                                                                                            <div class="row">
                                                                                                                <div class="col-md-6 gapbetween">
                                                                                                                    <div class="row">
                                                                                                                        <div class="w-100 form-group">
                                                                                                                            <input type="text" class="s_form form form-control" name="sal_from" id="sal_from" placeholder="From" autocomplete="off" value="{{old('sal_from')}}">
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="col-md-6 gapbetween1">
                                                                                                                    <div class="row">
                                                                                                                        <div class="w-100 form-group">
                                                                                                                            <input type="text" class="s_form form form-control" name="sal_to" id="sal_to" placeholder="To" autocomplete="off" value="{{old('sal_to')}}">
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
                                                                                    <div class="col-md-12">
                                                                                        <div class="row">

                                                                                            <div class="col-md-4">
                                                                                                <div class="">
                                                                                                    <div class="input-group mb-3">
                                                                                                        <label class="w-100" for="cname"><span class="label_text">Number Of Vacancy:</span></label>
                                                                                                        <input type="number" class="s_form form-control" name="vacancy_no" id="vacancy_no" min="0"  value="{{old('vacancy_no')}}" required><i class="new_holder1 far fa-user"></i>

                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="">
                                                                                                    <div class="input-group mb-3">
                                                                                                        <label class="w-100" for="cname"><span class="label_text">Time For Placement:</span></label>
                                                                                                        <div class="col-md-12">
                                                                                                            <div class="row">
                                                                                                                <div class="col-md-6 gapbetween">
                                                                                                                    <div class="row">
                                                                                                                        <div class="w-100 form-group">
                                                                                                                            <select class="form-control" id="need_by_no" name="need_by_no">
                                                                                                                                <option value="" selected hidden>Select</option>
                                                                                                                                @if(isset($needBys))
                                                                                                                                @foreach($needBys as $key => $value)
                                                                                                                                <option value="{{ $value }}" {{ $value == old('need_by_no')  ? 'selected' : '' }}> {{ $value }} </option>
                                                                                                                                @endforeach
                                                                                                                                @endif
                                                                                                                            </select>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="col-md-6 gapbetween1">
                                                                                                                    <div class="row">
                                                                                                                        <div class="w-100 form-group">
                                                                                                                            <select class="form-control" id="need_by_type" name="need_by_type" required>
                                                                                                                                <option value="">Select</option>
                                                                                                                                @if(isset($needByTypes))
                                                                                                                                @foreach($needByTypes as $key => $value)
                                                                                                                                <option value="{{ $value }}" {{ $value == old('need_by_type')  ? 'selected' : '' }}> {{ $value }} </option>
                                                                                                                                @endforeach
                                                                                                                                @endif
                                                                                                                            </select>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="">
                                                                                                    <div class="input-group mb-3">
                                                                                                        <label class="w-100" for="cname"><span class="label_text">Contract Duration:</span></label>
                                                                                                        <div class="w-100 form-group">
                                                                                                            <input type="text" class="form-control" name="duration" id="duration" autocomplete="off" required value="{{old('duration')}}">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-12">
                                                                                        <div class="row">
                                                                                            <div class="col-md-8">
                                                                                                <div class="">
                                                                                                    <div class="input-group mb-3">
                                                                                                        <label class="w-100" for="task"><span class="label_text">Job Description:</span></label>
                                                                                                        <textarea class="w-100 form-control" rows="8" id="description" name="description" style="resize: none;" required>{{old('description')}}</textarea>

                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-12">
                                                                                                        <div class="">
                                                                                                            <div class="input-group mb-3">
                                                                                                                <label class="w-100" for="accname"><span class="label_text">Extendable:</span></label>
                                                                                                                <input type="radio" class="form_radio" name="extendable" value="Yes" {{ old('extendable') == "Yes" ? "checked" :'' }}>Yes&nbsp;&nbsp;
                                                                                                                <input type="radio" class="form_radio" name="extendable" value="No" {{ old('extendable') == "No" ? "checked" :'' }}>No<br>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-12">
                                                                                                        <div class="">
                                                                                                            <div class="input-group mb-3">
                                                                                                                <label class="w-100" for="dept"><span class="label_text">Years Of Experience:</span></label>
                                                                                                                <input type="text" class="s_form form-control" name="experience" id="experience" autocomplete="off" required value="{{old('experience')}}"><i class="new_holder1 far fa-user"></i>

                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-12">
                                                                                                        <div class="">
                                                                                                            <div class="input-group mb-3">
                                                                                                                <label class="w-100" for="dept"><span class="label_text">Ideal Start Date:</span></label>
                                                                                                                <div id="datepicker" class="datepickerForm input-group date formdate" data-date-format="mm-dd-yyyy">
                                                                                                                    <input class="form_right w-100 form-control" readonly type="text" name="start_date"  autocomplete="off" id="start_date" value="{{old('start_date')}}"/><i class="new_holder far fa-calendar-alt"></i>
                                                                                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-12 log_form">
                                                                                        <div class="d_right">
                                                                                            <a id="show" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="std_but btn btn-primary">Next</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card account_collapse">
                                                                    <div class="card-header account_head" id="headingTwo">
                                                                        <h5 class="mb-0">
                                                                            <a class="acc_links btn btn-link" id="show" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                               <span class="basic"> Contact Details</span> <i class="fas fa-chevron-down" style="float:right;"></i>
                                                                            </a>
                                                                        </h5>
                                                                    </div>

                                                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                                                        <div class="card-body acc_body">
                                                                            <div class="col-md-12">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="row">
                                                                                            <div class="col-md-4">
                                                                                                <div class="">
                                                                                                    <div class="input-group mb-3">
                                                                                                        <label class="w-100" for="cname"><span class="label_text">Reporting Person:</span></label>
                                                                                                        <input type="text" class="s_form form-control" name="reporting_name" id="reporting_name" autocomplete="off" value="{{old('reporting_name')}}"><i class="new_holder1 far fa-user"></i>

                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="">
                                                                                                    <div class="input-group mb-3">
                                                                                                        <label class="w-100" for="cname"><span class="label_text">Reporting Person Designation:</span></label>
                                                                                                        <input type="text" class="s_form form-control" name="reporting_desg" id="reporting_desg" autocomplete="off" value="{{old('reporting_desg')}}"><i class="new_holder1 far fa-user"></i>

                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="">
                                                                                                    <div class="input-group mb-3">
                                                                                                        <label class="w-100" for="cname"><span class="label_text">Contact No:</span></label>
                                                                                                        <input type="number" class="s_form form-control" name="reporting_contact" id="reporting_contact" autocomplete="off" maxlength="16" value="{{old('reporting_contact')}}"><i class="new_holder1 fas fa-mobile-alt"></i>

                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-12">
                                                                                        <div class="row">
                                                                                            <div class="col-md-4">
                                                                                                <div class="">
                                                                                                    <div class="input-group mb-3">
                                                                                                        <label class="w-100" for="cname"><span class="label_text">Email:</span></label>
                                                                                                        <input type="email" class="s_form form-control" name="reporting_email" id="reporting_email" autocomplete="off" value="{{old('reporting_email')}}"><i class="new_holder1 far fa-envelope"></i>

                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-12 log_form">
                                                                                        <div class="d_right">
                                                                                            <a id="show" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" class="std_but btn btn-primary">Next</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card account_collapse">
                                                                    <div class="card-header account_head" id="headingThree">
                                                                        <h5 class="mb-0">
                                                                            <a class="acc_links btn btn-link" id="show" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                                                <span  class="basic">Other Info</span>
                                                                                <i class="fas fa-chevron-down" style="float:right;"></i>
                                                                            </a>
                                                                        </h5>
                                                                    </div>

                                                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                                                        <div class="card-body acc_body">
                                                                            <div class="col-md-12">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="row">
                                                                                            <div class="col-md-4">
                                                                                                <div class="">
                                                                                                    <div class="input-group mb-3">
                                                                                                        <label class="w-100" for="dept"><span class="label_text">Mode Of Interview:</span></label>
                                                                                                        <div class="w-100 form-group">
                                                                                                            <select class="form-control" id="interview_mode" name="interview_mode">
                                                                                                                <option value="" selected hidden>Select</option>
                                                                                                                @if(isset($modeOfInterviews))
                                                                                                                @foreach($modeOfInterviews as $key => $value) 
                                                                                                                <option value="{{ $value }}" {{ $value == old('interview_mode')  ? 'selected' : '' }}> {{ $value }} </option>
                                                                                                                @endforeach
                                                                                                                @endif
                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="">
                                                                                                    <div class="input-group mb-3">
                                                                                                        <label class="w-100" for="task"><span class="label_text">Travelling Required:</span></label>
                                                                                                        <input type="radio" class="form_radio" id="travelling" name="travelling" value="Yes" {{ old('travelling') == "Yes" ? "checked" :'' }}> Yes&nbsp;&nbsp;
                                                                                                        <input type="radio" class="form_radio" id="travelling" name="travelling" value="No" {{ old('travelling') == "No" ? "checked" :'' }}>No<br>

                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="">
                                                                                                    <div class="input-group mb-3">
                                                                                                        <label class="w-100" for="cname"><span class="label_text">Local Driving License:</span></label>
                                                                                                        <input type="radio" class="form_radio" id="local_driving_license" name="local_driving_license" value="Yes" {{ old('local_driving_license') == "Yes" ? "checked" :'' }}> Yes&nbsp;&nbsp;
                                                                                                        <input type="radio" class="form_radio" id="local_driving_license" name="local_driving_license" value="No" {{ old('local_driving_license') == "No" ? "checked" :'' }}>No<br>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-12">
                                                                                        <div class="row">
                                                                                            <div class="col-md-4">
                                                                                                <div class="">
                                                                                                    <div class="input-group mb-3">
                                                                                                        <label class="w-100" for="dept"><span class="label_text">Leave Salary Provided By The Client:</span></label>
                                                                                                        <div class="w-100 form-group">
                                                                                                            <select class="form-control" id="leave_sal" name="leave_sal">
                                                                                                                <option value=""  selected hidden>Select</option>
                                                                                                                <option value="Yes" {{ old('leave_sal') =="Yes" ? "selected" : ""}}>Yes</option>
                                                                                                                <option value="No" {{ old('leave_sal') =="No" ? "selected" : ""}}>No</option>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="">
                                                                                                    <div class="input-group mb-3">
                                                                                                        <label class="w-100" for="dept"><span class="label_text">Local Availability:</span></label>
                                                                                                        <div class="w-100 form-group">
                                                                                                            <select class="form-control" id="local_availability" name="local_availability">
                                                                                                                <option value="" selected hidden> Select</option>
                                                                                                                @if(isset($availability))
                                                                                                                @foreach($availability as $key => $value)
                                                                                                                <option value="{{ $value }}" {{ $value == old('local_availability')  ? 'selected' : '' }}> {{ $value }} </option>
                                                                                                                @endforeach
                                                                                                                @endif
                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="">
                                                                                                    <div class="input-group mb-3">
                                                                                                        <label class="w-100" for="accname"><span class="label_text">Local Exp Required:</span></label>
                                                                                                        <input type="radio" class="form_radio" name="local_exp" value="Yes" {{ old('local_exp') == "Yes" ? "checked" :'' }}> Yes&nbsp;&nbsp;
                                                                                                        <input type="radio" class="form_radio" name="local_exp" value="No" {{ old('local_exp') == "No" ? "checked" :'' }}>No<br>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-12">
                                                                                        <div class="row">
                                                                                            <div class="col-md-4">
                                                                                                <div class="">
                                                                                                    <div class="input-group mb-3">
                                                                                                        <label class="w-100" for="task"><span class="label_text">Notice Period Accepted:</span></label>
                                                                                                        <input type="text" class="s_form form-control" name="notice_period" id="notice_period" autocomplete="off" required value="{{old('notice_period')}}"><i class="new_holder1 far fa-user"></i>

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
                    </form>
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
</body>

</html>