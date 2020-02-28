<!DOCTYPE html>
<html>

<head>
    <style>
        .email_body {
            display: flex;
            justify-content: center;
        }

        .image_section {
            text-align: center;
            padding-bottom: 5px;
        }

        .table {
            border: 1px solid black;
            padding: 2em;
            width: 50%;
            background-color: #f9fafc;
        }

        .reset_text a {
            color: #f07c10;
        }

        .reset_text p {
            text-align: center;
        }

        .text h5 {
            color: #333;
            font-size: 18px;
            margin-top: 14px;
            margin-bottom: 14px;
        }
    </style>

</head>

<body>
<div class="email_body">
    <div class="table">
        <div class="image_section">
            <img class="can_logo" src="https://www.cantaloupeconsult.com/images/cantaloupe_logo.png">
        </div>
        <div class="text">
            <h5>You recently requested to rest your password for ur account. Click the link below to reset it</h5>
        </div>
        <div class="reset_text">
            <p><a href="{{url('/')}}/reset-password/{{$token}}">Reset Password</a></p>
        </div>
        <div class="text">
            <h5>If you did not request a password reset, please ignore this email. This password reset link is only valid for the next 10 minutes.</h5>
        </div>
        <div class="text">
            <h5>Thanks,<br>HRWS</h5>
        </div>
    </div>
</div>
</body>

</html>