<?php
include_once("assets/php/funkcije.php");

$ans = "";

if(isset($_SESSION["status"])){
    logout();
}

$emailFound = false;
if(isset($_POST["email"])){
    $email = user_input($_POST["email"]);

    if(Admin::emailTaken($email)){
        //admin reset
        $emailFound = true;
        $token = PasswordReset::generateToken();
        $ans = PasswordReset::add($email,$token);
    }else if(Driver::emailTaken($email)){
        //driver reset
        $emailFound = true;
        $token = PasswordReset::generateToken();
        $ans = PasswordReset::add($email,$token);
    }else{
        $ans = danger("email is not found");
    }
}

if(isset($_GET["token"]) && !empty($_GET["token"])){
    $token = user_input($_GET["token"]);
    $passReset = PasswordReset::getByToken($token);

    if($passReset===false){
        $ans = danger("token not found");
    }else if($passReset->getStatus()!=="new"){
        $ans = danger("token has expired");
    }else{
        $email = $passReset->getEmail();
        if(Admin::emailTaken($email)){
            //admin reset
            $ans = Admin::setRandomPassword($email);
            PasswordReset::expireToken($token);
        }else if(Driver::emailTaken($email)){
            //driver reset
            $ans = Driver::setRandomPassword($email);
            PasswordReset::expireToken($token);
        }else{
            $ans = danger("Something happened please try again later");
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DarkPan - Bootstrap 5 Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 text-center">
            <?php echo $ans; ?>
        </div>
    </div>
</div>
<div class="container-fluid position-relative d-flex p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div id="load1" class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Sign In Start -->
    <?php
        if((!isset($_POST["email"]) || (isset($_POST["email"]) && $emailFound===false)) && !isset($_GET["token"])){
            ?>
            <div class="container-fluid mt-5">
                <form class="row h-100 align-items-center justify-content-center mt-5" method="post" action="forgot-password.php">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                        <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Password reset</h3>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" placeholder="email" name="email">
                                <label for="floatingInput">Email</label>
                            </div>
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4" name="reset">reset</button>
                        </div>
                    </div>
                </form>
            </div>
            <?php
        }
    ?>

    <!-- Sign In End -->
</div>

<!-- JavaScript Libraries -->
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="lib/chart/chart.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/tempusdominus/js/moment.min.js"></script>
<script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
</body>

</html>