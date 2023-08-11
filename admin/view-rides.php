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
        $ans = Ride::delete($ride_id);
    }
}

if(isset($_POST["assign"])){
    $ride_id = $_POST["assign"];
    $driver_id = $_POST["driver_id"];
    $csrfToken = $_POST["token"];

    if(get_csrf_token()!==$csrfToken){
        $ans = danger("wrong token");
    }else if(!is_numeric($ride_id)){
        $ans = danger("something is wrong with id");
    }else if(!is_numeric($driver_id)){
        $ans = danger("something is wrong with driver id");
    }else{
        $ans = Ride::assignDriver($driver_id,$ride_id);
    }
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

        <div class="container-fluid mt-5" id="new_rides_section">
            <div class="row">
                <div class="col-sm-12">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">
                            <span class="en">New rides</span>
                            <span class="sr">Nove voznje</span>
                            <span class="de">Neue Fahrten</span>
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
                                    <span class="en">assign driver</span>
                                    <span class="sr">dodeli vozaca</span>
                                    <span class="de">Fahrer zuweisen</span>
                                </th>
                                <th scope="col">
                                    <span class="en">price</span>
                                    <span class="sr">cena</span>
                                    <span class="de">preis</span>
                                </th>
                                <th scope="col">
                                    <span class="en">trash</span>
                                    <span class="sr">smece</span>
                                    <span class="de">Müll</span>
                                </th>
                                <th scope="col">
                                    <span class="en">Change</span>
                                    <span class="sr">Izmeni</span>
                                    <span class="de">Ändern</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $active_drivers = Driver::get_active_drivers();

                            $rides = Ride::getNewRides();
                            foreach ($rides as $ride){
                                /** @var Ride $ride */

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
                                        <form action="view-rides.php" method="post" class="d-inline-block">
                                            <input type="hidden" name="token" value="<?php echo get_csrf_token(); ?>">
                                            <div class="row mb-3">

                                                <div class="col-9 pe-0">
                                                    <select class="form-select form-select-sm mb-3" aria-label="form-select-sm example" name="driver_id">
                                                        <option selected="">Select driver</option>
                                                        <?php
                                                            for($i=0;$i<count($active_drivers);$i++){
                                                                ?>
                                                                    <option value="<?php echo $active_drivers[$i]->getId(); ?>"><?php echo $active_drivers[$i]->getUsername(); ?></option>
                                                                <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-3 ps-0">
                                                    <button type="submit" name="assign" value="<?php echo $ride->getId(); ?>" class="change-admin" title="Assign ride number <?php echo $ride->getId(); ?>">
                                                        <svg width="25" height="25" viewBox="0 0 1024 1024" class="icon"  version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M905.92 237.76a32 32 0 0 0-52.48 36.48A416 416 0 1 1 96 512a418.56 418.56 0 0 1 297.28-398.72 32 32 0 1 0-18.24-61.44A480 480 0 1 0 992 512a477.12 477.12 0 0 0-86.08-274.24z"  />
                                                            <path d="M630.72 113.28A413.76 413.76 0 0 1 768 185.28a32 32 0 0 0 39.68-50.24 476.8 476.8 0 0 0-160-83.2 32 32 0 0 0-18.24 61.44zM489.28 86.72a36.8 36.8 0 0 0 10.56 6.72 30.08 30.08 0 0 0 24.32 0 37.12 37.12 0 0 0 10.56-6.72A32 32 0 0 0 544 64a33.6 33.6 0 0 0-9.28-22.72A32 32 0 0 0 505.6 32a20.8 20.8 0 0 0-5.76 1.92 23.68 23.68 0 0 0-5.76 2.88l-4.8 3.84a32 32 0 0 0-6.72 10.56A32 32 0 0 0 480 64a32 32 0 0 0 2.56 12.16 37.12 37.12 0 0 0 6.72 10.56zM230.08 467.84a36.48 36.48 0 0 0 0 51.84L413.12 704a36.48 36.48 0 0 0 51.84 0l328.96-330.56A36.48 36.48 0 0 0 742.08 320l-303.36 303.36-156.8-155.52a36.8 36.8 0 0 0-51.84 0z" />
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
                                        <form action="view-rides.php" method="post">
                                            <input type="hidden" name="token" value="<?php echo get_csrf_token(); ?>">
                                            <button type="submit" name="delete" value="<?php echo $ride->getId(); ?>" class="delete-admin" title="Move to trash ride number <?php echo $ride->getId(); ?>">
                                                <svg width="20" height="20" viewBox="-6.7 0 122.88 122.88" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 109.484 122.88" xml:space="preserve">
                                                        <g>
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.347,9.633h38.297V3.76c0-2.068,1.689-3.76,3.76-3.76h21.144 c2.07,0,3.76,1.691,3.76,3.76v5.874h37.83c1.293,0,2.347,1.057,2.347,2.349v11.514H0V11.982C0,10.69,1.055,9.633,2.347,9.633 L2.347,9.633z M8.69,29.605h92.921c1.937,0,3.696,1.599,3.521,3.524l-7.864,86.229c-0.174,1.926-1.59,3.521-3.523,3.521h-77.3 c-1.934,0-3.352-1.592-3.524-3.521L5.166,33.129C4.994,31.197,6.751,29.605,8.69,29.605L8.69,29.605z M69.077,42.998h9.866v65.314 h-9.866V42.998L69.077,42.998z M30.072,42.998h9.867v65.314h-9.867V42.998L30.072,42.998z M49.572,42.998h9.869v65.314h-9.869 V42.998L49.572,42.998z"></path>
                                                        </g>
                                                    </svg>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="update-ride.php" method="get">
                                            <button type="submit" name="change" value="<?php echo $ride->getId(); ?>" class="change-admin" title="change ride number <?php echo $ride->getId(); ?>">
                                                <svg width="20" height="20" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M20.7,5.2a1.024,1.024,0,0,1,0,1.448L18.074,9.276l-3.35-3.35L17.35,3.3a1.024,1.024,0,0,1,1.448,0Zm-4.166,5.614-3.35-3.35L4.675,15.975,3,21l5.025-1.675Z"></path>
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