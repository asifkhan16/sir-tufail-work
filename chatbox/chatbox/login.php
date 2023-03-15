<?php
session_name("chatbox");
session_start();

if ( isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true ){
    header("location: index.php");
}

include("processor/login_processor.php");

$resp = "";
if (isset($_POST['login'])){
    $resp = $obj->do_login();
    if ($resp == "ok"){
        header("location:index.php");
    }
}

?>
<html>
<head>
    <meta charset="utf-8">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="assets/css/style.css" rel="stylesheet" id="bootstrap-css">

    <title></title>
</head>
<body>
    <div class="container register">
        <div class="row">
            <div class="col-md-3 register-left">
                
            </div>
            <div class="col-md-9 register-right">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Login</h3>
                        <div class="row register-form">
                            <div class="col-md-6">
                                <form action="login.php" method="post">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Email" name="email" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Password" name="password" value="" />
                                    </div>
                                    <div class="form-group">
                                        <p>Don't have account? <a href="signup.php">SignUp here</a></p>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-success" value="Login" name="login" />
                                    </div>
                                    <p  style="color:red;"><?php echo $resp; ?></p>
                                    <div class="form-group">
                                        <p>Forgot Password? <a href="forgot.php">Click Here</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
</body>
</html>