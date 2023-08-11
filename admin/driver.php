<?php
include_once("assets/php/funkcije.php");
$ans = "";

if(!isset($_SESSION["status"])){
    header("location: login.php");
    die();
}

if($_SESSION["status"]!=="driver"){
    header("location: driver-login.php");
    die();
}

$driver = Driver::getById($_SESSION["podaci"]["driver_id"]);
if(!$driver instanceof Driver){
    logout();
    header("location: driver-login.php");
    die();
}

if(isset($_POST["status"]) && isset($_POST["change_status"])){
    $ride_id = $_POST["change_status"];
    $csrfToken = $_POST["token"];
    $status = user_input($_POST["status"]);

    if(get_csrf_token()!==$csrfToken){
        $ans = danger("wrong token");
    }else if(!is_numeric($ride_id)){
        $ans = danger("something is wrong with id");
    }else{
        if($status=="failed"){
            $ans = Ride::fail($ride_id);
        }

        if($status=="finished"){
            $ans = Ride::success($ride_id);
        }


    }
}

if(isset($_POST["unassign"])){
    $ride_id = $_POST["unassign"];
    $csrfToken = $_POST["token"];
    $driver_id = $driver->getId();

    if(get_csrf_token()!==$csrfToken){
        $ans = danger("wrong token");
    }else if(!is_numeric($ride_id)){
        $ans = danger("something is wrong with id");
    }else{
        $ans = Ride::decline($ride_id,$driver_id);
    }
}

if(isset($_POST["accept"])){
    $ride_id = $_POST["accept"];
    $driver_id = $driver->getId();
    $csrfToken = $_POST["token"];

    if(get_csrf_token()!==$csrfToken){
        $ans = danger("wrong token");
    }else if(!is_numeric($ride_id)){
        $ans = danger("something is wrong with id");
    }else{
        $ans = Ride::accept($ride_id,$driver_id);
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

<div class="container-fluid position-relative d-flex p-0 view-admins" id="driver_notification">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text- spin1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Sidebar Start -->
    <!-- Sidebar End -->
    <div class="sidebar pe-4 pb-3">
        <?php include_once("assets/php/sidebar.php"); ?>
    </div>
    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        <?php include_once("assets/php/navigacija.php"); ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <?php echo $ans; ?>
                </div>
            </div>
        </div>

        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-sm-12">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">
                            <span class="en">Assigned rides</span>
                            <span class="sr">Dodeljene voznje</span>
                            <span class="de">Zugewiesene Fahrten</span>
                        </h6>
                        <table class="table table-hover table-responsive table-striped table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#id</th>
                                <th scope="col">
                                    <span class="en">info</span>
                                    <span class="sr">informacije</span>
                                    <span class="de">die Info</span>
                                </th>
                                <th scope="col">
                                    <span class="en">address</span>
                                    <span class="sr">adresa</span>
                                    <span class="de">Adresse</span>
                                </th>
                                <th scope="col">
                                    <span class="en">additional</span>
                                    <span class="sr">dodatno</span>
                                    <span class="de">zusätzlich</span>
                                </th>
                                <th scope="col">
                                    <span class="en">decline</span>
                                    <span class="sr">odbij</span>
                                    <span class="de">Abfall</span>
                                </th>
                                <th scope="col">
                                    <span class="en">price</span>
                                    <span class="sr">cena</span>
                                    <span class="de">preis</span>
                                </th>
                                <th scope="col">
                                    <span class="en">set status</span>
                                    <span class="sr">postavi status</span>
                                    <span class="de">Zustand setzen</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            $rides = Ride::getAssignedRidesByDriverId($driver->getId());
                            foreach ($rides as $ride){
                                /** @var Ride $ride */

                                $street = $ride->getStreet();
                                $district = $ride->getDistrict();
                                $city = $ride->getCity();

                                ?>
                                <tr class="<?php echo ($ride->getStatus()=="accepted")? "bg-success text-dark" : ""; ?>">
                                    <th scope="row"><?php echo $ride->getId(); ?></th>
                                    <td>
                                        <?php echo $ride->getRideInfo(); ?>
                                    </td>
                                    <td>
                                        <?php echo  $ride->getAddressInfo(); ?>
                                    </td>
                                    <td>
                                        <?php echo $ride->getAdditional(); ?>
                                    </td>
                                    <td>
                                        <?php
                                        $driver = Driver::getById($ride->getDriverId());
                                        ?>
                                        <form action="driver.php" method="post" class="d-block">
                                            <input type="hidden" name="token" value="<?php echo get_csrf_token(); ?>">
                                            <div class="row mb-3">
                                                <div class="col-12 ps-0 pe-0 text-center">
                                                    <button type="submit" name="unassign" value="<?php echo $ride->getId(); ?>" class="mx-auto change-admin bg-transparent border-none" title="Decline ride">
                                                        <svg class="fill1" width="25" height="25" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path class="fill1" d="M12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm3.707,12.293a1,1,0,1,1-1.414,1.414L12,13.414,9.707,15.707a1,1,0,0,1-1.414-1.414L10.586,12,8.293,9.707A1,1,0,0,1,9.707,8.293L12,10.586l2.293-2.293a1,1,0,0,1,1.414,1.414L13.414,12Z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>

                                    </td>
                                    <td>
                                        <?php echo $ride->getPrice(); ?>
                                    </td>
                                    <td>
                                        <?php
                                            $status = $ride->getStatus();

                                            if($status==="accepted"){
                                                ?>
                                                <form action="driver.php" method="post" class="d-inline-block">
                                                    <input type="hidden" name="token" value="<?php echo get_csrf_token(); ?>">
                                                    <div class="row mb-3">
                                                        <div class="col-9 pe-0">
                                                            <select class="form-select form-select-sm mb-3" aria-label=".form-select-sm example" name="status">
                                                                <option value="finished">finished</option>
                                                                <option value="failed">failed</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-3 ps-0">
                                                            <button type="submit" name="change_status" value="<?php echo $ride->getId(); ?>" class="change-admin bg-transparent border-none" title="Remove driver">
                                                                <svg width="25" height="25" viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve">
                                                            <rect x="-512" y="-64" width="25" height="25"/>
                                                                    <path d="M56.103,16.824l-33.296,33.297l-14.781,-14.78l2.767,-2.767l11.952,11.952l30.53,-30.53c0.943,0.943 1.886,1.886 2.828,2.828Z" style="fill-rule:nonzero;"/>
                                                        </svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <?php
                                            }

                                            if($status==="assigned"){
                                                ?>
                                                <form action="driver.php" method="post" class="d-inline-block">
                                                    <input type="hidden" name="token" value="<?php echo get_csrf_token(); ?>">
                                                    <div class="row mb-3">
                                                        <div class="col-3 ps-0">
                                                            <button type="submit" name="accept" value="<?php echo $ride->getId(); ?>"
                                                                    class="change-admin border-none btn btn-outline-success" title="Remove driver">
                                                                <span class="en">accept</span>
                                                                <span class="sr">prihvati</span>
                                                                <span class="de">akzeptieren</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <?php
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
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