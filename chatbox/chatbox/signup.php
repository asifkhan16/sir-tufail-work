<?php

include("processor/login_processor.php");

$resp = "";
if (isset($_POST['signup'])){
    $resp = $obj->register();
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
                <p>Already Have Account? <a href="login.php">Login here</a></p>
            </div>
            <div class="col-md-9 register-right">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Sign Up</h3>
                        <form action="signup.php" method="post">
                            <div class="row register-form">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="First Name *" name="fname" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Last Name *" name="lname" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Password *" name="password" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control"  placeholder="Confirm Password *" name="cpassword" value="" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Your Email *" name="email" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" minlength="11" maxlength="13"  class="form-control" placeholder="Your Phone *" name="contact" value="" />
                                    </div>
                                    <input type="submit" class="btnRegister" name="signup" value="Register"/>
                                    <p><?php echo $resp; ?></p>
                                </div>
                            </div>
                        </form>
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