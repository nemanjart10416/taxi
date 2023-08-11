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

if(isset($_POST["delete"])){
    $ride_id = $_POST["delete"];
    $csrfToken = $_POST["token"];

    if(get_csrf_token()!==$csrfToken){
        $ans = danger("wrong token");
    }else if(!is_numeric($ride_id)){
        $ans = danger("something is wrong with id");
    }else{
        $ans = Ride::deleteForever($ride_id);
    }
}

$ride_status = "success";
if(isset($_POST["ride_status"])){
    $ride_status = user_input($_POST["ride_status"]);
}

/*
if(isset($_POST["delete"])){
    $id = $_POST["delete"];
    $csrfToken = $_POST["token"];

    if(get_csrf_token()!==$csrfToken){
        $ans = danger("wrong token");
    }else if(!is_numeric($id)){
        $ans = danger("something is wrong with id");
    }else{
        $ans = Admin::delete($id);
    }
}*/

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

        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <?php echo $ans; ?>
                </div>
            </div>
        </div>
        <!-- Navbar End -->

        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-sm-12">
                    <div class="bg-secondary rounded h-100 p-4">
                        <a type="button" class="btn btn-success m-2" href="add-ride.php">
                            <span class="en">add new ride</span>
                            <span class="sr">Dodaj novu voznju</span>
                            <span class="de">neue Fahrt hinzufügen</span>
                            <svg width="25" height="25" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 12H20M12 4V20" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-sm-12">
                    <div class="bg-secondary rounded h-100 p-4">
                        <?php
                            if($ride_status=="success"){
                                $rides = Ride::getSuccessRides();
                                ?>
                                    <h6 class="mb-4">
                                        <span class="en">Showing successful rides</span>
                                        <span class="sr">Prikaz uspesnih voznji</span>
                                        <span class="de">Erfolgreiche Fahrten zeigen</span>
                                    </h6>
                                    <form action="history.php" method="post">
                                        <button type="submit" class="btn btn-primary" name="ride_status" value="failed">
                                            <span class="en">Show failed</span>
                                            <span class="sr">Prikazi neuspesne</span>
                                            <span class="de">Anzeigen fehlgeschlagen</span>
                                        </button>
                                    </form>
                                <?php
                            }else {
                                $rides = Ride::getFailedRides();
                                ?>
                                    <h6 class="mb-4">
                                        <span class="en">Showing failed rides</span>
                                        <span class="sr">Prikaz neuspesnih voznji</span>
                                        <span class="de">Fehlgeschlagene Fahrten werden angezeigt</span>
                                    </h6>
                                    <form action="history.php" method="post">
                                        <button type="submit" class="btn btn-primary" name="ride_status" value="success">
                                            <span class="en">Show successful</span>
                                            <span class="sr">Prikazi uspesne</span>
                                            <span class="de">Erfolgreich zeigen</span>
                                        </button>
                                    </form>
                                <?php
                            }
                        ?>

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
                                    <span class="en">driver</span>
                                    <span class="sr">vozac</span>
                                    <span class="de">Fahrer</span>
                                </th>
                                <th scope="col">
                                    <span class="en">price</span>
                                    <span class="sr">cena</span>
                                    <span class="de">preis</span>
                                </th>
                                <th scope="col">
                                    <span class="en">delete</span>
                                    <span class="sr">obrisi</span>
                                    <span class="de">löschen</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($rides as $ride){
                                /** @var Ride $ride */

                                $street = $ride->getStreet();
                                $district = $ride->getDistrict();
                                $city = $ride->getCity();

                                ?>
                                <tr>
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
                                        <form action="assigned-rides.php" method="post" class="d-inline-block">
                                            <input type="hidden" name="token" value="<?php echo get_csrf_token(); ?>">
                                            <div class="row mb-3">

                                                <div class="col-9 pe-0">
                                                    <?php echo $driver->getUsername(); ?>
                                                </div>
                                                <div class="col-3 ps-0">

                                                </div>
                                            </div>
                                        </form>

                                    </td>
                                    <td>
                                        <?php echo $ride->getPrice(); ?>
                                    </td>
                                    <td>
                                        <form action="history.php" method="post">
                                            <input type="hidden" name="token" value="<?php echo get_csrf_token(); ?>">
                                            <button type="submit" name="delete" value="<?php echo $ride->getId(); ?>" class="delete-admin" title="Delete forever ride number <?php echo $ride->getId(); ?>">
                                                <svg width="20" height="20" viewBox="-6.7 0 122.88 122.88" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 109.484 122.88" xml:space="preserve">
                                                        <g>
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.347,9.633h38.297V3.76c0-2.068,1.689-3.76,3.76-3.76h21.144 c2.07,0,3.76,1.691,3.76,3.76v5.874h37.83c1.293,0,2.347,1.057,2.347,2.349v11.514H0V11.982C0,10.69,1.055,9.633,2.347,9.633 L2.347,9.633z M8.69,29.605h92.921c1.937,0,3.696,1.599,3.521,3.524l-7.864,86.229c-0.174,1.926-1.59,3.521-3.523,3.521h-77.3 c-1.934,0-3.352-1.592-3.524-3.521L5.166,33.129C4.994,31.197,6.751,29.605,8.69,29.605L8.69,29.605z M69.077,42.998h9.866v65.314 h-9.866V42.998L69.077,42.998z M30.072,42.998h9.867v65.314h-9.867V42.998L30.072,42.998z M49.572,42.998h9.869v65.314h-9.869 V42.998L49.572,42.998z"></path>
                                                        </g>
                                                    </svg>
                                            </button>
                                        </form>
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