<?php
include_once(dirname(__FILE__)."/assets/php/funkcije.php");
include_once(dirname(__FILE__)."/test/faker/faker.php");

$ans = "";

if(!isset($_SESSION["status"])){
    header("location: login.php");
    die();
}

if($_SESSION["status"]!=="super_administrator"){
    header("location: login.php");
    die();
}

$admin = Admin::getById($_SESSION["podaci"]["administrator_id"]);
if(!$admin instanceof Admin){
    header("location: assets/php/logout.php");
    die();
}

if(isset($_POST["add_admins"])){
    $csrfToken = $_POST["token"];
    $number = $_POST["number"];

    if(get_csrf_token()!==$csrfToken) {
        $ans = danger("wrong token");
    }else if(!is_numeric($number)){
        $ans = danger("wrong data");
    }else{
        $ans = add_admins($number);
    }
}

if(isset($_POST["add_drivers"])){
    $csrfToken = $_POST["token"];
    $number = $_POST["number"];

    if(get_csrf_token()!==$csrfToken) {
        $ans = danger("wrong token");
    }else if(!is_numeric($number)){
        $ans = danger("wrong data");
    }else{
        $ans = add_drivers($number);
    }
}

if(isset($_POST["add_rides"])){
    $csrfToken = $_POST["token"];
    $number = $_POST["number"];

    if(get_csrf_token()!==$csrfToken) {
        $ans = danger("wrong token");
    }else if(!is_numeric($number)){
        $ans = danger("wrong data");
    }else{
        $ans = add_new_rides($number);
    }
}

/*
if(isset($_POST["add"])){
    $csrfToken = $_POST["token"];

    if(get_csrf_token()!==$csrfToken){
        $ans = danger("wrong token");
    }else{
        $username = user_input($_POST["username"]);
        $name = user_input($_POST["name"]);
        $lname = user_input($_POST["lname"]);
        $email = user_input($_POST["email"]);
        $phone = user_input($_POST["phone"]);
        $password = user_input($_POST["password"]);
        $confirm = user_input($_POST["confirm"]);

        if($password!==$confirm){
            $ans = danger("Password does not match confirmation");
        }else {
            $salt = get_salt();

            $ans = Admin::create($username,$password,$salt,$name,$lname,$email,$phone);

            if($ans){
                $ans = success("Admin added");
            }else {
                $ans = danger("error");
            }
        }
    }
}
*/

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
                        <h6 class="mb-4">
                            <span class="en">This page is for adding test data to get familiar with system</span>
                            <span class="sr">Ova stranica je za dodavanje test podataka za upoznavamnje sa sistemom</span>
                            <span class="de">Diese Seite dient zum Hinzufügen von Testdaten, um sich mit dem System vertraut zu machen</span>
                        </h6>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-sm-12 col-md-8 col-lg-6">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">
                            <span class="en">ADD system dministrators</span>
                            <span class="sr">Dodaj sistemske administratore</span>
                            <span class="de">ADD-Systemadministratoren</span>
                        </h6>
                        <p>
                            <span class="en">password:</span>
                            <span class="sr">Lozinka:</span>
                            <span class="de">Passwort:</span>
                            administrator</p>
                        <div class="container-fluid ps-0 pe-0">
                            <div class="row">
                                <div class="col-12 text- ps-0 pe-0">
                                    <form class="bg-secondary rounded h-100" action="test-data.php" method="post">
                                        <input type="hidden" name="token" value="<?php echo get_csrf_token(); ?>">
                                        <div class="row mb-3">
                                            <div class="col-9 d-flex align-content-center align-items-center">
                                                <input type="text" class="form-control" name="number" placeholder="Number to add">
                                            </div>
                                            <div class="col-3">
                                                <div class="d-flex align-content-center align-items-center">
                                                    <button type="submit" class="btn btn-warning" name="add_admins">
                                                        <span class="en">add</span>
                                                        <span class="sr">dodaj</span>
                                                        <span class="de">hinzufügen</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-8 col-lg-6">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">
                            <span class="en">ADD drivers:</span>
                            <span class="sr">dodaj vozace:</span>
                            <span class="de">Treiber HINZUFÜGEN:</span>
                        </h6>
                        <p>
                            <span class="en">password:</span>
                            <span class="sr">Lozinka:</span>
                            <span class="de">Passwort:</span>
                            driver</p>
                        <div class="container-fluid ps-0 pe-0">
                            <div class="row">
                                <div class="col-12 text- ps-0 pe-0">
                                    <form class="bg-secondary rounded h-100" action="test-data.php" method="post">
                                        <input type="hidden" name="token" value="<?php echo get_csrf_token(); ?>">
                                        <div class="row mb-3">
                                            <div class="col-9 d-flex align-content-center align-items-center">
                                                <input type="text" class="form-control" name="number" placeholder="Number to add">
                                            </div>
                                            <div class="col-3">
                                                <div class="d-flex align-content-center align-items-center">
                                                    <button type="submit" class="btn btn-warning" name="add_drivers">
                                                        <span class="en">add</span>
                                                        <span class="sr">dodaj</span>
                                                        <span class="de">hinzufügen</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-8 col-lg-6 mt-3">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">
                            <span class="en">ADD new rides</span>
                            <span class="sr">dodaj nove voznje</span>
                            <span class="de">HINZUFÜGEN neuer Fahrten</span>
                        </h6>
                        <div class="container-fluid ps-0 pe-0">
                            <div class="row">
                                <div class="col-12 text- ps-0 pe-0">
                                    <form class="bg-secondary rounded h-100" action="test-data.php" method="post">
                                        <input type="hidden" name="token" value="<?php echo get_csrf_token(); ?>">
                                        <div class="row mb-3">
                                            <div class="col-9 d-flex align-content-center align-items-center">
                                                <input type="text" class="form-control" name="number" placeholder="Number to add">
                                            </div>
                                            <div class="col-3">
                                                <div class="d-flex align-content-center align-items-center">
                                                    <button type="submit" class="btn btn-warning" name="add_rides">
                                                        <span class="en">add</span>
                                                        <span class="sr">dodaj</span>
                                                        <span class="de">hinzufügen</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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