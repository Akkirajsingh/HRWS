<!DOCTYPE html>
<html>

<head>
    <title>HRWS | Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">

    <script type="text/javascript" src="/jquery/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="/jquery/jquery-ui-1.11.4.js"></script>
    <script type="text/javascript" src="/js/common.js"></script>

    <link rel="stylesheet" href="/sweetalert/sweetalert.css">
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
                                        <img class="can_logo" src="images/cantaloupe_logo.png">
                                    </div>
                                </div>
                                <div class="row d_center">
                                    @include('pages-message.notify-msg-error')
                                </div>
                                <div class="col-md-12 log_form">
                                    <div class="row">
                                        <form class="w-100" method="post" action="login" enctype="multipart/form-data" id="login" name="login">
                                            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="s_form form-control" placeholder="Email" name="login_email" required oninvalid="this.setCustomValidity('Please Enter Valid E-mail')" oninput="this.setCustomValidity('')"><i class="new_holder far fa-envelope"></i>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <input type="password" class="s_form form-control" placeholder="Password" name="login_password" id="login_password" required required oninvalid="this.setCustomValidity('Please Enter Valid Password')" oninput="this.setCustomValidity('')"><i class="new_holder fas fa-lock"></i>
                                                </div>
                                            </div>
                                            <div class="col-12 form-group form-check">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="">
                                                            <label class="form-check-label">
                                                                    <input class="form-check-input" type="checkbox" name="login_remember_me"> Remember me
                                                                  </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="row">
                                                            <a href="/forgot-password">I forgot my password</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row d_center">
                                                    <a href=""><button type="submit" class="std_but btn btn-primary">LOGIN</button></a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 hr_sec">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <img class="hr_logo" src="images/icon.png">
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