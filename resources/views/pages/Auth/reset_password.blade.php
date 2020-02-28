<!DOCTYPE html>
<html>

<head>
    <title>HRWS | Reset Password Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="stylesheet" href="/sweetalert/sweetalert.css">

    <script type="text/javascript" src="/jquery/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="/jquery/jquery-ui-1.11.4.js"></script>
    <script type="text/javascript" src="/js/common.js"></script>
    <script type="text/javascript" src="/sweetalert/sweetalert.min.js"></script>
</head>

<body>
<div class="container-fluid new_log">
    <div class="row">
        <div class="container login_page">
            <div class="col-md-12 col-xs-12">
                <div class="row">
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-12">
                                <div class="row d_center">
                                    <img class="can_logo" src="/images/cantaloupe_logo.png">
                                </div>
                            </div>
                            <?php $curr_date = date('Y-m-d H:i:s'); //dd($curr_date); ?>
                            @include('pages-message.notify-msg-error')
                            @include('pages-message.form-submit')
                            @if($user_details->expired_at >= $curr_date)
                                <div class="col-md-12 log_form">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row d_center">
                                            <p>Reset Password</p>
                                        </div>
                                    </div>
                                    <form id="changePassword" class="w-100" action=""  onsubmit="return false;">
                                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="user_id" id="reset-pw-user-id" value="{{$user_details->user_id}}">
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <input id="new-password" placeholder="New Password" class="s_form form-control" type="password" name="user_forgot_new_password"><i class="new_holder fas fa-lock"></i>
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <input id="password_confirmation" placeholder="Confirm Password" class="s_form form-control" type="password" name="user_forgot_conf_password"><i class="new_holder fas fa-lock"></i>
                                                
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row d_center">
                                                <button type="submit" class="std_but btn btn-primary" name="changePasswordBtn" id="changePasswordBtn">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @else
                                <h3 class="text-center">Sorry! This link has expired.</h3>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-7 hr_sec">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <img class="hr_logo" src="/images/icon.png">
                                </div>
                            </div>
                            <div class="col-12 hr_info">
                                <div class="row">
                                    <h4>HR Connect</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>