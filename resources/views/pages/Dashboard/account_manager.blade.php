<!DOCTYPE html>
<html>

<head>
    <title>HRWS | AM Dashboard</title>
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
                                                    <div class="col-md-5">
                                                        <div class="row">
                                                        @include('pages-message.notify-msg-success')
                        @include('pages-message.notify-msg-error')
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                    <div class="row d_right">
                                                    <div class="clientEdit dropdown">
                                                        <button type="submit" class="std_butU btn btn-primary dropdown-toggle" data-toggle="dropdown" title="Add Requirement"><i class="fas fa-plus"></i></button>
                                                        <div class="dropdown-menu">
                                                            @if(isset($clientContactList))
                                                            @foreach($clientContactList as $list)
                                                            <a class="dropdown-item" href="add_requirement/{{ $list['client_id']}}/{{ $list['contact_id']}}">{{$list['client_name']}}<span>&nbsp;-&nbsp;{{$list['contact_person']}}</span></a>
                                                            @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <form method="post" action="/search_requirement" enctype="multipart/form-data">
                                                            <div class="searchPlus search_container">
                                                                <i class="fa fa-search searchIcon"></i><input type="text" name="search" class="dtable_search" placeholder="Search..">
                                                                <a href="/home"><i class="fas fa-times searchIcon"></i></a>
                                                            </div>
                                                        </form>
                                                </div>
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        @if(isset($requirementList))
                                                        @foreach($requirementList as $requirement)
                                                        <!---------------------fulllength starts---------------------------- -->
                                                        <div class="col-md-12 fullength" id="fullength-{{$requirement->id}}" >
                                                            <div class="row">
                                                                <div class="col-md-12 manreq">
                                                                    <div class="row">
                                                                        <div class="col-md-12 reqtiles">
                                                                            <div class="row main">
                                                                                <div class="col-md-12 manreq1 no_bor">
                                                                                    <div class="row">
                                                                                        <div id="showright" data-id="{{ $requirement->id }}" data-toggle="tooltip" titexpandedle="Click here to view more" class="col-md-5 col reqleft leftman" style="cursor: pointer;">
                                                                                            <div class="row">
                                                                                                <div class="col-md-12">
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-12">
                                                                                                            <div class="row">
                                                                                                                <div class="col-md-12">
                                                                                                                    <div class="row">
                                                                                                                        <h5 class="w-100 basic">{{$requirement->title}}&nbsp;&nbsp;<span>( {{$requirement->vacancy_no}} )</span></h5>
                                                                                                                        <p class="w-100 basic1">{{$requirement->req_no}}</p>
                                                                                                                        <p class="w-100 basic1">
                                                                                                                            {{$requirement->clientRelation->name}} - {{$requirement->contactRelation->contact_person}}</p>
                                                                                                                        <p class="w-100 basic1">
                                                                                                                            {{$requirement->location}}</p>
                                                                                                                        <h5 class="w-100 basic">
                                                                                                                            {{$requirement->sal_from}}- {{$requirement->sal_to}}</h5>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-12">
                                                                                                            <div class="row">
                                                                                                                <div class="col-md-12 clienters log_form">
                                                                                                                    <div class="row">
                                                                                                                        <p class="w-100 basic1">Assigned To: <span>
                                                                                                                                @if($requirement->assignedRelation)
                                                                                                                                {{$requirement->assignedRelation->name}}
                                                                                                                                @endif
                                                                                                                            </span></p>
                                                                                                                        <p class="w-100 basic1">Target Date: <span>{{$requirement->lead_submit_date}}</span></p>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-7 col reqleft leftman1">
                                                                                            <div class="row">
                                                                                                <div class="col-md-12">
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-12">
                                                                                                            <div class="row">
                                                                                                                <div class="col-md-7">
                                                                                                                    <div class="row">
                                                                                                                        <h5 class="basic">Status - <span>{{$requirement->status}}</span>&nbsp;
                                                                                                                      <span>
                                                                                                                      ({{Carbon\Carbon::parse($requirement->updated_at)->format("m-d-Y") }})
                                                                                                                       </span>
                                                                                                                    </h5>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="col-md-5">
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
                                                                                                                                <i class="optionedit1 background_white tick btn btn-primary dropdown-toggle fas fa-ellipsis-v" data-toggle="dropdown" title="Edit"></i>
                                                                                                                                <div class="optionedit dropdown-menu">
                                                                                                                                    <a class="dropdown-item" href="edit_requirement/{{$requirement->id}}"><i class="tick fas fa-pen" title="Edit"></i>&nbsp;&nbsp;Edit</a>
                                                                                                                                    <a class="dropdown-item" data-toggle="modal" data-target="#delmodal{{$requirement->id}}" style="cursor: pointer;"><i class="tick far fa-trash-alt" title="Delete"></i>&nbsp;&nbsp;Delete</a>
                                                                                                                                    <a class="dropdown-item" data-toggle="modal" data-target="#statusmodal{{$requirement->id}}" style="cursor: pointer;">Change Status</a>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-12">
                                                                                                            <div class="row">
                                                                                                                <h5 class="w-100 basic">Priority - <span>{{$requirement->priority}}</span></h5>
                                                                                                                <h5 class="w-100 basic">Posted On - <span>{{$requirement->created_at}}</span></h5>
                                                                                                                <p class="w-100 basic1">Contract Duration - <span>{{$requirement->duration}}</span></p>
                                                                                                                <p class="w-100 basic1">Years of Experience - <span>{{$requirement->experience}}</span></p>
                                                                                                               <!--  <p class="w-100 basic1">Preffered Nationality - <span>Dubai</span></p> -->
                                                                                                                <p class="w-100 basic1">Submission Date - <span class="redc">
                                                                                                                    {{$requirement->submission_date}}
                                                                                                                </span></p>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="modal fade" id="delmodal{{$requirement->id}}">
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
                                                                                                    <a  href="delete_requirement/{{ \Crypt::encrypt($requirement->id) }}">
                                                                                                    <button type="button" class="std_but btn btn-secondary">Delete</button></a><button type="button" class="std_but1 btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                                    </div>

                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="modal fade" id="statusmodal{{$requirement->id}}">
                                                                                                <div class="modal-dialog modal-sm">
                                                                                                    <div class="modal-content">
                                                                                                        <div class="modal-header">
                                                                                                            <h4 class="modal-title">Change Status</h4>
                                                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                                        </div>
                                                                                                        <div class="modal-body">
                                                                                                        <form method="post"  action="/status_requirement" enctype="multipart/form-data">
                                                                                                        <input type="hidden" name="requirement_id" value="{{ \Crypt::encrypt($requirement->id) }}">
                                                                                                            <div class="col-md-12">
                                                                                                                <div class="row text_center">
                                                                                                                    <div class="col-md-12">
                                                                                                                        <div class="row">
                                                                                                                            <select class="form-control" id="sel1" name="status">
                                                                                                                                @if(isset($status))
                                                                                                                                @foreach($status as $value)
                                                                                                                                <option value="{{$value}}" {{ ($requirement->status == $value) ? "selected":''}}>{{$value}}</option>
                                                                                                                                @endforeach
                                                                                                                                @endif
                                                                                                                            </select>
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
                                                                                                                                            <h5 class="basic1">{{$comment->comments}}<span>&nbsp;-&nbsp;{{ $comment->created_by }}  ({{ \Carbon\Carbon::parse($comment->created_at)->format("d-M-y h:i A") }})</span></h5>
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
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!----------------fulllength ends-------------------------------------->

                                                        <!---------------right column starts----------------------------------->

                                                        <div class="col-md-5 rightcolumn"  id="rightcolumn{{$requirement->id}}" style="display:none;">
                                                            <div class="row">
                                                                <div class="col-md-12 manreq right_man">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="row">
                                                                                <div class="col-md-9">
                                                                                    <div class="row">
                                                                                        <h5 class="basic">{{$requirement->title}}&nbsp;&nbsp;<span>( {{$requirement->vacancy_no}} )</span></h5>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="row right_head">
                                                                                        <i id="hide" class="right_close far fa-times-circle" data-id="{{$requirement->id}}" style="cursor: pointer;" data-toggle="tooltip" title="Close"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 pad_all">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="row">
                                                                                        <h6 class="w-100 basic">Position</h6>
                                                                                        <div class="col-7 col-md-6">
                                                                                            <div class="row">
                                                                                                <h5 class="basic1">Job Description</h5>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-5 col-md-6">
                                                                                            <div class="row">
                                                                                                <p class="basic1">:&nbsp;{{$requirement->description}} </p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-7 col-md-6">
                                                                                            <div class="row">
                                                                                                <h5 class="basic1">Extendable</h5>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-5 col-md-6">
                                                                                            <div class="row text_center">
                                                                                                <p class="basic1">:&nbsp;{{$requirement->extendable}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-7 col-md-6">
                                                                                            <div class="row">
                                                                                                <h5 class="basic1">Ideal Start Date</h5>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-5 col-md-6">
                                                                                            <div class="row text_center">
                                                                                                <p class="basic1">:&nbsp;{{$requirement->start_date}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 pad_all">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="row">
                                                                                        <h6 class="w-100 basic">Contact Info</h6>
                                                                                        <div class="col-7 col-md-6">
                                                                                            <div class="row">
                                                                                                <h5 class="basic1">Reporting Person</h5>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-5 col-md-6">
                                                                                            <div class="row text_center">
                                                                                                <p class="basic1">:&nbsp;{{$requirement->reporting_name}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-7 col-md-6">
                                                                                            <div class="row">
                                                                                                <h5 class="basic1">Reporting Person Desgn</h5>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-5 col-md-6">
                                                                                            <div class="row text_center">
                                                                                                <p class="basic1">:&nbsp;{{$requirement->reporting_desg}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-7 col-md-6">
                                                                                            <div class="row">
                                                                                                <h5 class="basic1">Contact Number</h5>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-5 col-md-6">
                                                                                            <div class="row text_center">
                                                                                                <p class="basic1">:&nbsp;{{$requirement->reporting_contact}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-7 col-md-6">
                                                                                            <div class="row">
                                                                                                <h5 class="basic1">Email</h5>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-5 col-md-6">
                                                                                            <div class="row text_center">
                                                                                                <p class="basic1">:&nbsp;{{$requirement->reporting_email}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 pad_all">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="row">
                                                                                        <h6 class="w-100 basic">Other Info</h6>
                                                                                        <div class="col-7 col-md-6">
                                                                                            <div class="row">
                                                                                                <h5 class="basic1">Mode Of Interview</h5>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-5 col-md-6">
                                                                                            <div class="row text_center">
                                                                                                <p class="basic1">:&nbsp;{{$requirement->interview_mode}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-7 col-md-6">
                                                                                            <div class="row">
                                                                                                <h5 class="basic1">Travelling Required</h5>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-5 col-md-6">
                                                                                            <div class="row text_center">
                                                                                                <p class="basic1">:&nbsp;{{$requirement->travelling}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-7 col-md-6">
                                                                                            <div class="row">
                                                                                                <h5 class="basic1">Local Driving License</h5>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-5 col-md-6">
                                                                                            <div class="row text_center">
                                                                                                <p class="basic1">:&nbsp;{{$requirement->local_driving_license}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-7 col-md-6">
                                                                                            <div class="row">
                                                                                                <h5 class="basic1">Local Exp Required</h5>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-5 col-md-6">
                                                                                            <div class="row text_center">
                                                                                                <p class="basic1">:&nbsp;{{$requirement->local_exp}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-7 col-md-6">
                                                                                            <div class="row">
                                                                                                <h5 class="basic1">Local Availability</h5>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-5 col-md-6">
                                                                                            <div class="row text_center">
                                                                                                <p class="basic1">:&nbsp;{{$requirement->local_availability}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-7 col-md-6">
                                                                                            <div class="row">
                                                                                                <h5 class="basic1">Notice</h5>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-5 col-md-6">
                                                                                            <div class="row text_center">
                                                                                                <p class="basic1">:&nbsp; <p class="basic1">&nbsp;{{$requirement->notice_period}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-7 col-md-6">
                                                                                            <div class="row">
                                                                                                <h5 class="basic1">Leave Salary</h5>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-5 col-md-6">
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
                                                        <!----------------right column ends----------------------->
                                                        @endforeach
                                                        @endif

                                                    </div>
                                                    {{ $requirementList->links() }}
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
        <script type="text/javascript">
            document.getElementById("amDashboard_item").classList.add("active1");
            document.getElementById("amDashboard_link").classList.add("active");
            document.getElementById("amDashboard_span").classList.add("active");
        </script>
        <script>
            $(document).ready(function() {
                $(".right_close").click(function() {
                    var $toggle = "#rightcolumn"+$(this).data('id');
                    var $fullength="#fullength-"+$(this).data('id');

                    $($toggle).hide();
                    $($fullength).toggleClass("col-md-7 col-md-12");
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('.leftman').click(function() {
                    var $toggle = "#rightcolumn"+$(this).data('id');
                    var $fullength="#fullength-"+$(this).data('id');
                    $($toggle).toggle("show");
                    $($fullength).toggleClass("col-md-12 col-md-7");
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $("#name").val($($(".user_listing .viewname")).text());
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
</body>

</html>
