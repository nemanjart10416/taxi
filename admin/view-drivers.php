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
    $id = $_POST["delete"];
    $csrfToken = $_POST["token"];

    if(get_csrf_token()!==$csrfToken){
        $ans = danger("wrong token");
    }else if(!is_numeric($id)){
        $ans = danger("something is wrong with id");
    }else{
        $ans = Driver::delete($id);
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

        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-sm-12">
                    <div class="bg-secondary rounded h-100 p-4">
                        <a type="button" class="m-2" href="add-driver.php">
                            <span class="en">Add new driver</span>
                            <span class="sr">Dodaj novog vozaca</span>
                            <span class="de">Neuen Treiber hinzufügen</span>
                        </a>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div class="bg-secondary rounded h-100 p-4 container-fluid">
                        <form class="d-none d-md-flex row" action="view-drivers.php" method="post">
                            <div class="col-12 col-md-6 col-lg-4 d-md-flex">
                                <input type="hidden" name="token" value="<?php echo get_csrf_token(); ?>">
                                <input <?php echo (isset($_POST["search"]))? "value='".htmlentities($_POST["search"])."'" : ""; ?>
                                        class="form-control bg-dark border-0 mt-2 mb-2" type="search" name="search" placeholder="Search" id="search">
                                <button type="submit" class="btn btn-primary m-2" id="searchBtn">
                                    <span class="en">Search</span>
                                    <span class="sr">Pretrazi</span>
                                    <span class="de">Suchen</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-sm-12">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">
                            <span class="en">System drivers</span>
                            <span class="sr">Sistemski vozaci</span>
                            <span class="de">Systemtreiber</span>
                        </h6>
                        <table class="table table-hover table-responsive">
                            <thead>
                            <tr>
                                <th scope="col">#id</th>
                                <th scope="col">
                                    <?php
                                    $orderUsername = "ASC";
                                    if(isset($_GET["orderUsername"])){
                                        if($_GET["orderUsername"]=="ASC"){
                                            $orderUsername = "DESC";
                                        }else{
                                            $orderUsername = "ASC";
                                        }
                                    }
                                    ?>
                                    <a href="view-drivers.php?orderUsername=<?php echo $orderUsername; ?>">
                                        <span class="en">Username</span>
                                        <span class="sr">Korisnicko ime</span>
                                        <span class="de">Nutzername</span>
                                    </a>
                                </th>
                                <th scope="col">
                                    <?php
                                    $orderName = "ASC";
                                    if(isset($_GET["orderName"])){
                                        if($_GET["orderName"]=="ASC"){
                                            $orderName = "DESC";
                                        }else{
                                            $orderName = "ASC";
                                        }
                                    }
                                    ?>
                                    <a href="view-drivers.php?orderName=<?php echo $orderName; ?>">
                                        <span class="en">Name</span>
                                        <span class="sr">Ime</span>
                                        <span class="de">Name</span>
                                    </a>
                                </th>
                                <th scope="col">
                                    <?php
                                    $orderLName = "ASC";
                                    if(isset($_GET["orderLName"])){
                                        if($_GET["orderLName"]=="ASC"){
                                            $orderLName = "DESC";
                                        }else{
                                            $orderLName = "ASC";
                                        }
                                    }
                                    ?>
                                    <a href="view-drivers.php?orderLName=<?php echo $orderLName; ?>">
                                        <span class="en">Last Name</span>
                                        <span class="sr">Prezime</span>
                                        <span class="de">Nachname</span>
                                    </a>
                                </th>
                                <th scope="col">
                                    <?php
                                    $orderEmail = "ASC";
                                    if(isset($_GET["orderEmail"])){
                                        if($_GET["orderEmail"]=="ASC"){
                                            $orderEmail = "DESC";
                                        }else{
                                            $orderEmail = "ASC";
                                        }
                                    }
                                    ?>
                                    <a href="view-drivers.php?orderEmail=<?php echo $orderEmail; ?>">
                                        <span class="en">Email</span>
                                        <span class="sr">Email</span>
                                        <span class="de">Email</span>
                                    </a>
                                </th>
                                <th scope="col">
                                    <span class="en">Phone</span>
                                    <span class="sr">Telefon</span>
                                    <span class="de">Telefon</span>
                                </th>
                                <th scope="col">
                                    <?php
                                    $orderJoined = "ASC";
                                    if(isset($_GET["orderJoined"])){
                                        if($_GET["orderJoined"]=="ASC"){
                                            $orderJoined = "DESC";
                                        }else{
                                            $orderJoined = "ASC";
                                        }
                                    }
                                    ?>
                                    <a href="view-drivers.php?orderJoined=<?php echo $orderJoined; ?>">
                                        <span class="en">Joined</span>
                                        <span class="sr">Pridruzio se</span>
                                        <span class="de">Beigetreten</span>
                                    </a>
                                </th>
                                <th scope="col">
                                    <span class="en">Last login</span>
                                    <span class="sr">Zadnje logovanje</span>
                                    <span class="de">Letzte Anmeldung</span>
                                </th>
                                <th scope="col">
                                    <span class="en">Status</span>
                                    <span class="sr">Status</span>
                                    <span class="de">Status</span>
                                </th>
                                <th scope="col">
                                    <span class="en">Delete</span>
                                    <span class="sr">Obrisi</span>
                                    <span class="de">Löschen</span>
                                </th>
                                <th scope="col">
                                    <span class="en">Change</span>
                                    <span class="sr">Izmeni</span>
                                    <span class="de">Ändern</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody id="tableBody">
                            <?php
                            if(isset($_GET["orderUsername"])){
                                if($_GET["orderUsername"]=="ASC"){
                                    $drivers = Driver::get_drivers("Order BY driver_username ASC");
                                }else{
                                    $drivers = Driver::get_drivers("Order BY driver_username DESC");
                                }
                            }else if(isset($_GET["orderName"])){
                                if($_GET["orderName"]=="ASC"){
                                    $drivers = Driver::get_drivers("Order BY driver_name ASC");
                                }else{
                                    $drivers = Driver::get_drivers("Order BY driver_name DESC");
                                }
                            }else if(isset($_GET["orderLName"])){
                                if($_GET["orderLName"]=="ASC"){
                                    $drivers = Driver::get_drivers("Order BY driver_last_name ASC");
                                }else{
                                    $drivers = Driver::get_drivers("Order BY driver_last_name DESC");
                                }
                            }else if(isset($_GET["orderEmail"])){
                                if($_GET["orderEmail"]=="ASC"){
                                    $drivers = Driver::get_drivers("Order BY driver_email ASC");
                                }else{
                                    $drivers = Driver::get_drivers("Order BY driver_email DESC");
                                }
                            }else if(isset($_GET["orderJoined"])){
                                if($_GET["orderJoined"]=="ASC"){
                                    $drivers = Driver::get_drivers("Order BY driver_joined ASC");
                                }else{
                                    $drivers = Driver::get_drivers("Order BY driver_joined DESC");
                                }
                            }else{
                                if(isset($_POST["search"])){
                                    $search = $_POST["search"];
                                    $csrfToken = $_POST["token"];

                                    if(get_csrf_token()!==$csrfToken){
                                        $ans = danger("wrong token");
                                        $drivers = Driver::get_drivers();
                                    }else{
                                        $drivers = Driver::search($search);
                                    }
                                }else{
                                    $drivers = Driver::get_drivers();
                                }
                            }

                            foreach ($drivers as $driver){
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $driver->getId(); ?></th>
                                    <td><?php echo $driver->getUsername(); ?></td>
                                    <td><?php echo $driver->getName(); ?></td>
                                    <td><?php echo $driver->getLastName(); ?></td>
                                    <td><?php echo $driver->getEmail(); ?></td>
                                    <td><?php echo $driver->getMobile(); ?></td>
                                    <td><?php echo $driver->getJoined(); ?></td>
                                    <td><?php echo $driver->getLastLogin(); ?></td>
                                    <td class="driver-<?php echo $driver->getStatus(); ?>"><?php echo $driver->getStatus(); ?></td>
                                    <td skip-mark>
                                        <form action="view-drivers.php" method="post">
                                            <input type="hidden" name="token" value="<?php echo get_csrf_token(); ?>">
                                            <button type="submit" name="delete" value="<?php echo $driver->getId(); ?>" class="delete-admin" title="Delete driver <?php echo $driver->getUsername(); ?>">
                                                <svg width="20" height="20" viewBox="-6.7 0 122.88 122.88" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  enable-background="new 0 0 109.484 122.88" xml:space="preserve">
                                                        <g>
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.347,9.633h38.297V3.76c0-2.068,1.689-3.76,3.76-3.76h21.144 c2.07,0,3.76,1.691,3.76,3.76v5.874h37.83c1.293,0,2.347,1.057,2.347,2.349v11.514H0V11.982C0,10.69,1.055,9.633,2.347,9.633 L2.347,9.633z M8.69,29.605h92.921c1.937,0,3.696,1.599,3.521,3.524l-7.864,86.229c-0.174,1.926-1.59,3.521-3.523,3.521h-77.3 c-1.934,0-3.352-1.592-3.524-3.521L5.166,33.129C4.994,31.197,6.751,29.605,8.69,29.605L8.69,29.605z M69.077,42.998h9.866v65.314 h-9.866V42.998L69.077,42.998z M30.072,42.998h9.867v65.314h-9.867V42.998L30.072,42.998z M49.572,42.998h9.869v65.314h-9.869 V42.998L49.572,42.998z"/>
                                                        </g>
                                                    </svg>
                                            </button>
                                        </form>
                                    </td>
                                    <td skip-mark>
                                        <form action="update-driver.php" method="get">
                                            <button type="submit" name="change" value="<?php echo $driver->getId(); ?>" class="change-admin" title="change driver <?php echo $driver->getUsername(); ?>">
                                                <svg width="20" height="20" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M20.7,5.2a1.024,1.024,0,0,1,0,1.448L18.074,9.276l-3.35-3.35L17.35,3.3a1.024,1.024,0,0,1,1.448,0Zm-4.166,5.614-3.35-3.35L4.675,15.975,3,21l5.025-1.675Z"/>
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