<!DOCTYPE html>
<html>

<head>
    <title>HRWS | HR Dashboard</title>
    @include('includes.external_dependency')
    @yield('includes.external_dependency-content')
    <style>
        .data_drop {
            width: 5em;
        }

        .col {
            flex: 1;
        }

        .main {
            display: flex;
        }
    </style>
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
                            <h5>Dashboard</h5>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="w-100 user_list">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="w-100 white-box">
                                            <div class="col-12 searchbox clientFirst">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            @include('pages-message.notify-msg-success')
                                                            @include('pages-message.notify-msg-error')
                                                            @include('pages-message.form-submit')
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row d_right">
                                                            <form method="post" action="/lead/search_requirement" enctype="multipart/form-data">
                                                                <div class="searchPlus search_container">
                                                                    <i class="fa fa-search searchIcon"></i><input type="text" name="search" class="dtable_search" placeholder="Search..">
                                                                    <a href="/home"><i class="fas fa-times searchIcon"></i></a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(isset($requirementList))
                                            @foreach($requirementList as $requirement)
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12 manreq">
                                                        <div class="row">
                                                            <div class="col-md-12 reqtiles">
                                                                <div class="row main">
                                                                    <div class="col-md-12 manreq1 no_bor">
                                                                        <div class="row">
                                                                            <div class="col-md-3 col reqleft leftman pad2">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="row">
                                                                                            <div class="col-md-12">
                                                                                                <div class="row">
                                                                                                    <h5 class="w-100 basic">{{$requirement->title}}&nbsp;&nbsp;<span>({{$requirement->vacancy_no}} )</span></h5>
                                                                                                    <p class="w-100 basic1">{{$requirement->req_no}}</p>
                                                                                                    <p class="w-100 basic1">{{$requirement->clientRelation->name}}</p>
                                                                                                    <p class="w-100 basic1">{{$requirement->location}}</p>
                                                                                                    <h5 class="w-100 basic">{{$requirement->sal_from}} - {{$requirement->sal_to}}</h5>
                                                                                                </div>
                                                                                            </div>
                                                                                            <?php
                                                                                            $reqId = $requirement->recruiterRelation->pluck('recruiter_id')->toArray();
                                                                                            ?>
                                                                                            <div class="col-md-12 clienters field_line pad2">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-12">
                                                                                                        <div class="row">
                                                                                                            <p class="basic1">Recruiter&nbsp;-
                                                                                                                <span>
                                                                                                                    @if(isset($reqId))
                                                                                                                    {{assignedRecruiterName($reqId)}}
                                                                                                                    @endif
                                                                                                                </span>
                                                                                                                &nbsp;</p>
                                                                                                            <p class="w-100 basic1">Target Date:&nbsp;<span>{{ ($requirement->req_submit_date) ? Carbon\Carbon::parse($requirement->req_submit_date)->format("m-d-Y") :'' }}</span></p>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-9 col reqleft rightman">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="row">
                                                                                            <!-- <div class="col-md-12">
                                                                                                            <div class="row right_head">
                                                                                                                <a href="#" class="notification mob_not" data-toggle="tooltip" title="Notification">
                                                                                                                    <span><i class="notification far fa-bell"></i></span>
                                                                                                                    <span class="badge2">3</span>
                                                                                                                </a>
                                                                                                            </div>
                                                                                                        </div> -->
                                                                                            <div class="col-md-12">
                                                                                                <div class="row d_right">
                                                                                                    <div class="commentboxes">
                                                                                                        <a href="#" class="notifications mob_not">
                                                                                                            <span><i class="cv notifications far fa-file-alt"></i></span>
                                                                                                            <span class="badge">3</span>
                                                                                                        </a>
                                                                                                    </div>
                                                                                                    <div class="commentboxes2">
                                                                                                        <a href="#"><i data-toggle="modal" data-target="#commentmodal-{{$requirement->id}}" class="ikon_bord am_icons tick far fa-comment-alt" title="Comments"></i></a>
                                                                                                    </div>
                                                                                                    <div class="commentboxes3">
                                                                                                        <div class="dropdown ikon_bord1">
                                                                                                            <i class="optionedit1 background_white tick btn btn-primary dropdown-toggle fas fa-ellipsis-v" data-toggle="dropdown"></i>
                                                                                                            <div class="optionedit dropdown-menu">
                                                                                                                <a class="dropdown-item" data-toggle="modal" data-target="#edithr{{$requirement->id}}" style="cursor: pointer;"><i class="tick fas fa-pen" title="Edit"></i>&nbsp;&nbsp;Edit</a>
                                                                                                                <a class="dropdown-item" data-toggle="modal" data-target="#skillmodal{{$requirement->id}}" style="cursor: pointer;"><i class="tick fas fa-tools" title="Delete" style="cursor:pointer"></i>&nbsp;&nbsp;Skills</a>
                                                                                                                <a class="dropdown-item" data-toggle="modal" data-target="#ineterviewmodal{{$requirement->id}}" style="cursor: pointer;"><i class="tick far fa-file-alt" title="Delete" style="cursor:pointer"></i>&nbsp;&nbsp;Questions</a>

                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-12" data-toggle="collapse" href="#collapseExample{{$requirement->id}}" style="cursor:pointer" data-toggle="tooltip" title="Click here to view more">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-5">
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-12">
                                                                                                                <div class="row">
                                                                                                                    <h5 class="w-100 basic">Status - <span>{{$requirement->status}}</span>&nbsp;<span>({{Carbon\Carbon::parse($requirement->updated_at)->format("m-d-Y") }})</span></h5>
                                                                                                                    <h5 class="w-100 basic">Priority - <span>{{$requirement->priority}}</span></h5>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-12">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-md-12">
                                                                                                                        <div class="row">
                                                                                                                            <div class="col-md-12">
                                                                                                                                <div class="row">
                                                                                                                                    <p class="w-100 basic1">Contract Duration - <span>{{$requirement->duration}}</span></p>
                                                                                                                                    <p class="w-100 basic1">Years of Experience - <span>{{$requirement->experience}}</span></p>
                                                                                                                                    <!--  <p class="w-100 basic1">Preffered Nationality - <span>Dubai</span></p> -->
                                                                                                                                    <p class="w-100 basic1">Submission Date - <span class="redc"> {{$requirement->lead_submit_date}}</span></p>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-7">
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-12">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-md-12">
                                                                                                                        <div class="row">
                                                                                                                            <h5 class="basic">Job Description&nbsp;</h5>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-12">
                                                                                                                        <div class="row">
                                                                                                                            <h5 class="basic1">
                                                                                                                                {{$requirement->description}}
                                                                                                                            </h5>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                    <div class="col-md-12 log_form">
                                                                                                        <div class="row ">
                                                                                                            @if(isset($requirement->skillsRelation))
                                                                                                            @foreach($requirement->skillsRelation as $list)
                                                                                                            <div class="recSkills">
                                                                                                                <h5 class="basic1 ">{{$list->skill}}</h5>
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
                                                    </div>


                                                </div>
                                            </div>
                                            <div class="collapse" id="collapseExample{{$requirement->id}}">
                                                <div class="card card-body paddintop">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <!-- <div class="col-md-12">
                                                                <div class="row right_head">
                                                                    <i id="hide" class="right_close far fa-times-circle" style="cursor: pointer;" data-toggle="tooltip" title="Close"></i>
                                                                </div>
                                                            </div> -->
                                                            <div class="col-md-12 pad_all">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="row">
                                                                                    <h6 class="w-100 basic">Position</h6>
                                                                                    <div class="col-7 col-md-7">
                                                                                        <div class="row">
                                                                                            <h5 class="w-100 basic1">Extendable</h5>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-5 col-md-5">
                                                                                        <div class="row text_center">
                                                                                            <p class="basic1">&nbsp;:{{$requirement->extendable}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-7 col-md-7">
                                                                                        <div class="row">
                                                                                            <h5 class="w-100 basic1">Ideal Start Date</h5>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-5 col-md-5">
                                                                                        <div class="row text_center">
                                                                                            <p class="basic1">&nbsp;:{{$requirement->start_date}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="row">
                                                                                    <h6 class="w-100 basic">Contact Info</h6>
                                                                                    <div class="col-7 col-md-7">
                                                                                        <div class="row">
                                                                                            <h5 class="w-100 basic1">Reporting Person</h5>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-5 col-md-5">
                                                                                        <div class="row text_center">
                                                                                            <p class="basic1">:&nbsp;{{$requirement->reporting_name}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-7 col-md-7">
                                                                                        <div class="row">
                                                                                            <h5 class="w-100 basic1">Reporting Person Designation</h5>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-5 col-md-5">
                                                                                        <div class="row text_center">
                                                                                            <p class="basic1">:&nbsp;{{$requirement->reporting_desg}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-7 col-md-7">
                                                                                        <div class="row">
                                                                                            <h5 class="w-100 basic1">Contact Number</h5>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-5 col-md-5">
                                                                                        <div class="row text_center">
                                                                                            <p class="basic1">:&nbsp;{{$requirement->reporting_contact}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-7 col-md-7">
                                                                                        <div class="row">
                                                                                            <h5 class="w-100 basic1">E-mail</h5>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-5 col-md-5">
                                                                                        <div class="row text_center">
                                                                                            <p class="basic1">:&nbsp;{{$requirement->reporting_email}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="row">
                                                                                    <h6 class="w-100 basic">Other Info</h6>
                                                                                    <div class="col-7 col-md-7">
                                                                                        <div class="row">
                                                                                            <h5 class="w-100 basic1">Mode Of Interview</h5>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-5 col-md-5">
                                                                                        <div class="row text_center">
                                                                                            <p class="basic1">:&nbsp;{{$requirement->interview_mode}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-7 col-md-7">
                                                                                        <div class="row">
                                                                                            <h5 class="w-100 basic1">Travelling Required</h5>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-5 col-md-5">
                                                                                        <div class="row text_center">
                                                                                            <p class="basic1">:&nbsp;{{$requirement->travelling}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-7 col-md-7">
                                                                                        <div class="row">
                                                                                            <h5 class="w-100 basic1">Local Driving License</h5>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-5 col-md-5">
                                                                                        <div class="row text_center">
                                                                                            <p class="basic1">:&nbsp;{{$requirement->local_driving_license}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-7 col-md-7">
                                                                                        <div class="row">
                                                                                            <h5 class="w-100 basic1">Local Experience Required</h5>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-5 col-md-5">
                                                                                        <div class="row text_center">
                                                                                            <p class="basic1">:&nbsp;{{$requirement->local_exp}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-7 col-md-7">
                                                                                        <div class="row">
                                                                                            <h5 class="w-100 basic1">Local Availability</h5>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-5 col-md-5">
                                                                                        <div class="row text_center">
                                                                                            <p class="basic1">:&nbsp;{{$requirement->local_availability}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-7 col-md-7">
                                                                                        <div class="row">
                                                                                            <h5 class="basic1">Notice</h5>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-5 col-md-5">
                                                                                        <div class="row text_center">
                                                                                            <p class="basic1">:&nbsp;{{$requirement->notice_period}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-7 col-md-7">
                                                                                        <div class="row">
                                                                                            <h5 class="basic1">Leave Salary</h5>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-5 col-md-5">
                                                                                        <div class="row text_center">
                                                                                            <p class="basic1">:&nbsp;{{$requirement->leave_sal}}</p>
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
                                            <div class="modal fade" id="commentmodal-{{$requirement->id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form method="post" action="/requirement/comment" enctype="multipart/form-data">
                                                            <input type="hidden" name="req_id" value="{{$requirement->id}}">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Comments</h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h6>Place Your Comments Here&nbsp;:-</h6>
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <textarea name="comment" class="form-control" rows="2" id="comment" style="resize:none" required></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 pad_left log_form old_comments">
                                                                    <div class="row">
                                                                        <ul class="w-100" id="comment_list">
                                                                            @foreach($requirement->commentRelation as $comment)
                                                                            <li>
                                                                                <div class="col-md-12">
                                                                                    <div class="row">
                                                                                        <div class="col-md-1">
                                                                                            <div class="row">
                                                                                                <i class="active far fa-comment-alt"></i>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-11">
                                                                                            <div class="row">
                                                                                                <h5 class="basic1">{{$comment->comments}}<span>&nbsp;-&nbsp;{{ $comment->created_by }} ({{ \Carbon\Carbon::parse($comment->created_at)->format("d-M-y h:i A") }})</span></h5>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                            @endforeach

                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="std_butU btn btn-secondary">Save</button><button type="button" class="std_but1 btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="skillmodal{{$requirement->id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Skills</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <h6 class="w-100 basic">{{$requirement->title}}</h6>
                                                                    @if(isset($requirement->skillsRelation))
                                                                    @foreach($requirement->skillsRelation as $list)
                                                                    <div class="input-group mb-3">
                                                                        <input type="text" class="form-control" name="" value="{{ $list->skill }}" readonly>
                                                                        <div class="input-group-append">
                                                                            <button data-id="{{$list->id}}" class="form_right input-group-text delSkill" id="skills1" style="cursor: pointer;">
                                                                                <i id="skills" data-toggle="modal" data-target="#delSkillModal" class="far fa-trash-alt skill"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    @endforeach
                                                                    @endif
                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                            <h6>Add Skills</h6>
                                                                        </div>
                                                                    </div>
                                                                    <form method="post" class="w-100" action="/add_skill" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="input-group mb-3">
                                                                            <div class="w-100 field_wrapper">
                                                                                <div>
                                                                                    <input type="hidden" name="requirement_id" value="{{ \Crypt::encrypt($requirement->id) }}">
                                                                                    <input class="acc_mobile" type="text" name="field_name[]" value="" autocomplete="off" minlength="2" maxlength="40" required />

                                                                                    <a href="javascript:void(0);" class="add_button" title="Add field"><i class="far fa-plus-square" style="color:#f07c10; font-size:20px;"></i></a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="std_butU btn btn-secondary">Save</button><button type="button" class="std_but1 btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="ineterviewmodal{{$requirement->id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Interview Questions</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <h6 class="w-100 basic">{{$requirement->title}}</h6>
                                                                    @if(isset($requirement->questionsRelation))
                                                                    @foreach($requirement->questionsRelation as $questions)
                                                                    <div class="input-group mb-3">
                                                                        <input type="text" class="form-control" name="" value="{{ $questions->question}}" placeholder="Question" disabled>
                                                                        <div class="input-group-append">
                                                                            <button data-id="{{$questions->id}}" class="form_right input-group-text delQuestion" style="cursor: pointer;"><i data-toggle="modal" data-target="#delQuestionModal" class="far fa-trash-alt"></i></span>
                                                                        </div>
                                                                    </div>
                                                                    @endforeach
                                                                    @endif
                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                            <h6>Add Questions</h6>
                                                                        </div>
                                                                    </div>
                                                                    <form method="post" class="w-100" action="/add_question" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="input-group mb-3">
                                                                            <div class="w-100 field_wrapper">
                                                                                <div>
                                                                                    <input type="hidden" name="requirement_id" value="{{ \Crypt::encrypt($requirement->id) }}">

                                                                                    <input class="acc_mobile" type="text" name="field_name[]" value="" autocomplete="off" minlength="2" maxlength="40" required />
                                                                                    <a href="javascript:void(0);" class="add_button" title="Add field"><i class="far fa-plus-square" style="color:#f07c10; font-size:20px;"></i></a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="std_butU btn btn-secondary">Save</button><button type="button" class="std_but1 btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="edithr{{$requirement->id}}">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Fields</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <form class="request" action="/assign_recruiter" method="post">
                                                            <input type="hidden" name="requirement_id" value="{{$requirement->id}}">
                                                            <div class="modal-body">
                                                                <div class="col-md-12">
                                                                    <div class="row text_center">
                                                                        <label for="dept"><span class="basic1">Assign To:</span></label>
                                                                        <div class="col-md-12">
                                                                            <div class="row">
                                                                                <button type="button" class="w-100 role_drop btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                                                    Select Recruiter
                                                                                </button>
                                                                                <div class="w-100 dropdown-menu dropdown-menu-form">
                                                                                    <ul class="role_list" id="cmbitems">
                                                                                        @if(isset($recruterList))
                                                                                        <?php
                                                                                        $reqId = $requirement->recruiterRelation->pluck('recruiter_id')->toArray();
                                                                                        ?>
                                                                                        @foreach($recruterList as $recruiter)
                                                                                        <li>
                                                                                            <input type="checkbox" name="assigned[]" value="{{$recruiter['id']}}" {{ (in_array($recruiter['id'],  $reqId)) ? "checked" :'' }} id="assigned">
                                                                                            <label class="marge" style="cursor:pointer" for="group1">{{$recruiter['name']}}</label>
                                                                                        </li>
                                                                                        @endforeach
                                                                                        @endif
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 log_form">
                                                                    <div class="row text_center">
                                                                        <div class="input-group mb-3">
                                                                            <label for="dept"><span class="basic1">Target Submission Date:</span></label>
                                                                            <div class="col-md-12">
                                                                                <div class="row">
                                                                                    <div id="datepicker" class="w-100 datepickerForm calMOdal input-group date formdate" data-date-format="mm-dd-yyyy">
                                                                                        <input readonly type="text" class="w-100 form_right form-control" name="recruiter_submission_date" value="{{ Carbon\Carbon::parse($requirement->req_submit_date)->format('m-d-Y') }}" autocomplete="off" required /><i class="new_holder far fa-calendar-alt"></i>
                                                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="std_butU btn btn-secondary">Edit</button><button type="button" class="std_but1 btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                        {{$requirementList->links()}}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delSkillModal">
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
                    <form action="/delete_skill" method="post">
                        <input type="hidden" id="skill_val" name="skill_id" value="">
                        <button type="submit" class="std_butU btn btn-secondary" value="Submit">Delete</button>
                    </form>
                    <button type="button" class="std_but1 btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="delQuestionModal">
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
                    <form action="/delete_question" method="post">
                        <input type="hidden" id="question_val" name="question_id" value="">
                        <button type="submit" class="std_butU btn btn-secondary" value="Submit">Delete</button>
                    </form>
                    <button type="button" class="std_but1 btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <!-- <script>
        $(document).ready(function() {
            $("#hide").click(function() {
                $(".rightcolumn").hide();
            });
        });
    </script> -->
    <script type="text/javascript">
        $('document').ready(function() {
            $('.delSkill').click(function() {
                var SkillId = $(this).data('id');
                $('#skill_val').val(SkillId);
            });
        });
    </script>
    <script type="text/javascript">
        $('document').ready(function() {
            $('.delQuestion').click(function() {
                var QuestionId = $(this).data('id');
                $('#question_val').val(QuestionId);
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var maxField = 10; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = '<div style="padding-top:5px;"><input type="text" class="acc_mobile" name="field_name[]" value="" minlength="2" maxlength="40" autocomplete="off" /><a href="javascript:void(0);" class="remove_button"><i class="far fa-times-circle" style="color:#333; font-size:20px; padding-left:2px;"></i></a></div>'; //New input field html 
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function() {
                //Check maximum number of input fields
                if (x < maxField) {
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e) {
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#name").val($($(".user_listing .viewname")).text());
        });
    </script>
    <script>
        $("document").ready(function() {

            $('.dropdown-menu').on('click', function(e) {
                if ($(this).hasClass('dropdown-menu-form')) {
                    e.stopPropagation();
                }
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
        document.getElementById("tlDashboard_item").classList.add("active1");
        document.getElementById("tlDashboard_link").classList.add("active");
        document.getElementById("tlDashboard_span").classList.add("active");
    </script>
</body>

</html>