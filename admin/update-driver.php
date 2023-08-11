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

if(!isset($_GET["change"])){
    header("location: view-admins.php");
    die();
}else {
    $id = $_GET["change"];
    if(!is_numeric($id)){
        header("location: view-admins.php");
        die();
    }

    $driver_to_change = Driver::getById($id);
}

if(!$driver_to_change instanceof Driver){
    header("location: assets/php/logout.php");
    die();
}

if(isset($_POST["change_password"])){
    $id = $_POST["change_password"];
    $csrfToken = $_POST["token"];

    if(get_csrf_token()!==$csrfToken){
        $ans = danger("wrong token");
    }else if(!is_numeric($id)) {
        $ans = danger("something is wrong with id");
    }else{
        $ans = Validate::changeDriverPassword();

        if($ans===true){
            $password = user_input($_POST["password"]);
            $confirm = user_input($_POST["confirm"]);
            $ans = Driver::change_password($id,$password);
        }
    }
}

if(isset($_POST["change"])){
    $id = $_POST["change"];
    $csrfToken = $_POST["token"];

    if(get_csrf_token()!==$csrfToken){
        $ans = danger("wrong token");
    }else if(!is_numeric($id)){
        $ans = danger("something is wrong with id");
    }else{
        $ans = Validate::changeDriverInfo();

        if($ans===true){
            $username = user_input($_POST["username"]);
            $name = user_input($_POST["name"]);
            $lname = user_input($_POST["lname"]);
            $email = user_input($_POST["email"]);
            $phone = user_input($_POST["phone"]);

            $driver_to_change = new Driver($id,$username,$name,$lname,$email,$phone);
            $ans = $driver_to_change->update();
            $driver_to_change = Driver::getById($id);
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
                        <h6 class="mb-4">
                            <span class="en">Update driver</span>
                            <span class="sr">Izmeni vozaca</span>
                            <span class="de">Treiber aktualisieren</span><b><?php echo $driver_to_change->getUsername(); ?></b></h6>
                        <p>
                            <span class="en">Name</span>
                            <span class="sr">Ime</span>
                            <span class="de">Name</span>: <b><?php echo $driver_to_change->getName(); ?></b></p>
                        <p><span class="en">Last Name</span>
                            <span class="sr">Prezime</span>
                            <span class="de">Nachname</span>: <b><?php echo $driver_to_change->getLastName(); ?></b></p>
                        <p>
                            <span class="en">Status: </span>
                            <span class="sr">Status: </span>
                            <span class="de">Status: </span> <b class="driver-<?php echo $driver_to_change->getStatus(); ?>"><?php echo $driver_to_change->getStatus(); ?></b>
                        </p>
                        <?php

                        ?>
                        <a href="view-drivers.php">
                            <span class="en">back to drivers</span>
                            <span class="sr">nazad na vozace</span>
                            <span class="de">zurück zu den Treibern</span>
                        </a>
                        <a href="#basic_info" class="ps-3">
                            <span class="en">change information</span>
                            <span class="sr">izmeni informacije</span>
                            <span class="de">Informationen ändern</span>
                        </a>
                        <a href="#passwd" class="ps-3">
                            <span class="en">change password</span>
                            <span class="sr">izmeni lozinku</span>
                            <span class="de">Kennwort ändern</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-sm-12 col-md-6">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-5" id="basic_info">
                            <span class="en">Change basic information</span>
                            <span class="sr">Izmeni osnovne informacije</span>
                            <span class="de">Ändern Sie grundlegende Informationen</span>
                        </h6>
                        <form action="update-driver.php?change=<?php echo htmlentities($driver_to_change->getId()); ?>" method="post">
                            <input type="hidden" name="token" value="<?php echo get_csrf_token(); ?>">
                            <div class="mb-3">
                                <label for="username" class="form-label">
                                    <span class="en">Username</span>
                                    <span class="sr">Korisnicko ime</span>
                                    <span class="de">Nutzername</span>
                                </label>
                                <input type="text" class="form-control" name="username" value="<?php echo htmlentities($driver_to_change->getUsername()); ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">
                                    <span class="en">Name</span>
                                    <span class="sr">Ime</span>
                                    <span class="de">Name</span>
                                </label>
                                <input type="text" class="form-control" name="name" value="<?php echo htmlentities($driver_to_change->getName()); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="lname" class="form-label">
                                    <span class="en">Last Name</span>
                                    <span class="sr">Prezime</span>
                                    <span class="de">Nachname</span>
                                </label>
                                <input type="text" class="form-control" name="lname" value="<?php echo htmlentities($driver_to_change->getLastName()); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <span class="en">Email</span>
                                    <span class="sr">Email</span>
                                    <span class="de">Email</span>
                                </label>
                                <input type="email" class="form-control" name="email" value="<?php echo htmlentities($driver_to_change->getEmail()); ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">
                                    <span class="en">Phone</span>
                                    <span class="sr">Telefon</span>
                                    <span class="de">Telefon</span>
                                </label>
                                <input type="text" class="form-control" name="phone" value="<?php echo htmlentities($driver_to_change->getMobile()); ?>">
                            </div>
                            <button type="submit" class="btn btn-warning" name="change" value="<?php echo htmlentities($driver_to_change->getId()); ?>">
                                <span class="en">change</span>
                                <span class="sr">izmeni</span>
                                <span class="de">ändern</span>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-5" id="passwd">
                            <span class="en">change password</span>
                            <span class="sr">izmeni lozinku</span>
                            <span class="de">Kennwort ändern</span>
                        </h6>
                        <form action="update-driver.php?change=<?php echo htmlentities($driver_to_change->getId()); ?>" method="post">
                            <input type="hidden" name="token" value="<?php echo get_csrf_token(); ?>">
                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    <span class="en">Password</span>
                                    <span class="sr">Lozinka</span>
                                    <span class="de">Passwort</span>
                                </label>
                                <input type="text" class="form-control" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm" class="form-label">
                                    <span class="en">Confirm password</span>
                                    <span class="sr">Potvrdi lozinku</span>
                                    <span class="de">Bestätige das Passwort</span>
                                </label>
                                <input type="text" class="form-control" name="confirm" required>
                            </div>
                            <button type="submit" class="btn btn-warning" name="change_password" value="<?php echo htmlentities($driver_to_change->getId()); ?>">
                                <span class="en">change</span>
                                <span class="sr">izmeni</span>
                                <span class="de">ändern</span>
                            </button>
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