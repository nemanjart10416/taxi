<?php
include_once("assets/php/funkcije.php");
$ans = "";

if(!isset($_SESSION["status"])){
    header("location: login.php");
    die();
}

if($_SESSION["status"]!=="super_administrator" && $_SESSION["status"]!=="administrator"){
    header("location: login.php");
    die();
}

$admin = Admin::getById($_SESSION["podaci"]["administrator_id"]);
if(!$admin instanceof Admin){
    header("location: assets/php/logout.php");
    die();
}

if(isset($_POST["change"])){
    $csrfToken = $_POST["token"];

    if(get_csrf_token()!==$csrfToken){
        $ans = danger("wrong token");
    }else{
        $password = user_input($_POST["password"]);
        $confirm = user_input($_POST["confirm"]);

        if($password!==$confirm){
            $ans = danger("pasword and confirmation do not match");
        }else{
            Admin::change_password($admin->getId(),$password);
            logout();
            header("Refresh:0");
            die();
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

    <!-- Icon Font Stylesheet -->
    <link href="css/fonts.css" rel="stylesheet">
    <link href="css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <link href="assets/css/style.min.css" rel="stylesheet">
</head>

<body>
<div class="container-fluid position-relative d-flex p-0 view-admins">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text- spin1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Sidebar Start -->
    <div class="sidebar pe-4 pb-3">
        <?php include_once("assets/php/sidebar.php"); ?>
    </div>
    <!-- Sidebar End -->

    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        <?php include_once("assets/php/navigacija.php"); ?>
        <!-- Navbar End -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <?php echo $ans; ?>
                </div>
            </div>
        </div>

        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-sm-12">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">Change password</h6>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-sm-12">
                    <div class="bg-secondary rounded h-100 p-4">
                        <form action="change-password.php" method="post">
                            <input type="hidden" name="token" value="<?php echo get_csrf_token(); ?>">
                            <div class="mb-3">
                                <label for="password" class="form-label">password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="mb-3">
                                <label for="confirm" class="form-label">confirm password</label>
                                <input type="confirm" class="form-control" name="confirm">
                            </div>
                            <button type="submit" class="btn btn-warning" name="change">change</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Start -->
        <div class="container-fluid pt-4 px-4">
            <?php include_once("assets/php/footer.php"); ?>
        </div>
        <!-- Footer End -->
    </div>
    <!-- Content End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
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
<script src="assets/js/script.js"></script>
</body>

</html>