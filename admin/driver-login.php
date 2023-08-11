<?php
include_once("assets/php/funkcije.php");

$ans = "";

if(isset($_SESSION["status"])){
    logout();
}

if(isset($_POST["login"]) && isset($_POST["user"]) && isset($_POST["password"])){
    $user = user_input($_POST["user"]);
    $password = user_input($_POST["password"]);

    $ans = Driver::login($user,$password);
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
    <div class="container-fluid mt-5">
        <form class="row h-100 align-items-center justify-content-center mt-5" method="post" action="driver-login.php">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <a href="index.html" class="">
                            <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Driver login</h3>
                        </a>
                        <h3>Login</h3>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="user" name="user" value="driver1">
                        <label for="floatingInput">user</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" value="driver1driver1">
                        <label for="floatingPassword">password</label>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <a href="forgot-password.php">Forgot Password</a>
                    </div>
                    <button type="submit" class="btn btn-primary py-3 w-100 mb-4" name="login">Login</button>
                </div>
            </div>
        </form>
    </div>
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