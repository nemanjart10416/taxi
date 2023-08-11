<?php
include_once("assets/php/funkcije.php");
$ans = "";

if (!isset($_SESSION["status"])) {
    header("location: login.php");
    die();
}

if ($_SESSION["status"] !== "super_administrator" && $_SESSION["status"] !== "administrator") {
    header("location: login.php");
    die();
}

$admin = Admin::getById($_SESSION["podaci"]["administrator_id"]);
if (!$admin instanceof Admin) {
    header("location: assets/php/logout.php");
    die();
}

if (isset($_POST["delete"])) {
    $ride_id = $_POST["delete"];
    $csrfToken = $_POST["token"];

    if (get_csrf_token() !== $csrfToken) {
        $ans = danger("wrong token");
    } else if (!is_numeric($ride_id)) {
        $ans = danger("something is wrong with id");
    } else {
        $ans = Ride::delete($ride_id);
    }
}

if (isset($_POST["assign"])) {
    $ride_id = $_POST["assign"];
    $driver_id = $_POST["driver_id"];
    $csrfToken = $_POST["token"];

    if (get_csrf_token() !== $csrfToken) {
        $ans = danger("wrong token");
    } else if (!is_numeric($ride_id)) {
        $ans = danger("something is wrong with id");
    } else if (!is_numeric($driver_id)) {
        $ans = danger("something is wrong with driver id");
    } else {
        $ans = Ride::assignDriver($driver_id, $ride_id);
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
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet"/>

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <link href="assets/css/style.min.css" rel="stylesheet">
</head>

<body>

<div class="container-fluid position-relative d-flex p-0 view-admins">
    <!-- Spinner Start -->
    <div id="spinner"
         class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
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
                        <form action="search.php" method="post" class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="mb-3">
                                        <?php
                                            if(isset($_POST["id"])){
                                                $id = user_input($_POST["id"]);
                                            }else{
                                                $id = "";
                                            }
                                        ?>
                                        <label for="id" class="form-label">
                                            <span class="en">Search by id</span>
                                            <span class="sr">Pretraga po id</span>
                                            <span class="de">Suche nach ID</span>
                                        </label>
                                        <input type="text" class="form-control" id="id" name="id" value="<?php echo htmlentities($id); ?>">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="mb-3">
                                        <?php
                                        if(isset($_POST["name"])){
                                            $name = user_input($_POST["name"]);
                                        }else{
                                            $name = "";
                                        }
                                        ?>
                                        <label for="name" class="form-label">
                                            <span class="en">Search by name</span>
                                            <span class="sr">Pretraga po imenu</span>
                                            <span class="de">Suche mit Name</span>
                                        </label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlentities($name); ?>">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="mb-3">
                                        <?php
                                        if(isset($_POST["email"])){
                                            $email = user_input($_POST["email"]);
                                        }else{
                                            $email = "";
                                        }
                                        ?>
                                        <label for="email" class="form-label">
                                            <span class="en">Search by email</span>
                                            <span class="sr">Pretraga po email-u</span>
                                            <span class="de">Per E-Mail suchen</span>
                                        </label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlentities($email); ?>">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="mb-3">
                                        <?php
                                        if(isset($_POST["phone"])){
                                            $phone = user_input($_POST["phone"]);
                                        }else{
                                            $phone = "";
                                        }
                                        ?>
                                        <label for="phone" class="form-label">
                                            <span class="en">Search by Search by phone</span>
                                            <span class="sr">Pretraga po mobilnom</span>
                                            <span class="de">Telefonisch suchen</span>
                                        </label>
                                        <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo htmlentities($phone); ?>">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="mb-3">
                                        <?php
                                            $status_types = get("SELECT DISTINCT status FROM rides");

                                            if (isset($_POST["status"])) {
                                                $statusLast = user_input($_POST["status"]);
                                            } else {
                                                $statusLast = "";
                                            }
                                        ?>
                                        <label for="status" class="form-label">
                                            <span class="en">Search by status</span>
                                            <span class="sr">Pretraga po statusu</span>
                                            <span class="de">Suche nach Status</span>
                                        </label>
                                        <select class="form-select form-select-sm mb-3" aria-label=".form-select-sm example" name="status">
                                            <option value=""></option>
                                            <?php
                                                foreach ($status_types as $status){
                                                    ?>
                                                        <option <?php echo ($statusLast==$status["status"])? "selected" : "" ?> value="<?php echo $status["status"]; ?>"><?php echo $status["status"]; ?></option>
                                                    <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="mb-3">
                                        <?php
                                        $drivers = get("SELECT * FROM driver WHERE driver_id IN (SELECT DISTINCT driver_id FROM rides)");
                                        if (isset($_POST["driver"])) {
                                            $selected_driver_id = user_input($_POST["driver"]);
                                        } else {
                                            $selected_driver_id = "";
                                        }
                                        ?>
                                        <label for="driver" class="form-label">
                                            <span class="en">Search by driver</span>
                                            <span class="sr">Pretraga po vozacu</span>
                                            <span class="de">Suche nach Fahrer</span>
                                        </label>
                                        <select class="form-select form-select-sm mb-3" aria-label=".form-select-sm example" name="driver">
                                            <option value=""></option>
                                            <?php
                                            foreach ($drivers as $driver){
                                                ?>
                                                <option <?php echo ($selected_driver_id==$driver["driver_id"])? "selected" : "" ?> value="<?php echo $driver["driver_id"]; ?>">
                                                    <?php echo $driver["driver_name"]; ?> <?php echo $driver["driver_last_name"]; ?> (<?php echo $driver["driver_username"]; ?>)
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="mb-3">
                                        <?php
                                        $payments = get("SELECT DISTINCT payment FROM rides");
                                        if (isset($_POST["payment"])) {
                                            $selected_payment = user_input($_POST["payment"]);
                                        } else {
                                            $selected_payment = "";
                                        }
                                        ?>
                                        <label for="payment" class="form-label">
                                            <span class="en">Search by payment</span>
                                            <span class="sr">Pretraga po nacinu placanja</span>
                                            <span class="de">Suche nach Zahlung</span>
                                        </label>
                                        <select class="form-select form-select-sm mb-3" aria-label=".form-select-sm example" name="payment">
                                            <option value=""></option>
                                            <?php
                                            foreach ($payments as $payment){
                                                ?>
                                                <option <?php echo ($selected_payment==$payment["payment"])? "selected" : "" ?> value="<?php echo $payment["payment"]; ?>">
                                                    <?php echo $payment["payment"]; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="mb-3">
                                        <?php
                                        $payments = get("SELECT DISTINCT payment FROM rides");
                                        if (isset($_POST["direction"])) {
                                            $selected_direction = user_input($_POST["direction"]);
                                        } else {
                                            $selected_direction = "";
                                        }
                                        ?>
                                        <label for="direction" class="form-label">
                                            <span class="en">Search by direction</span>
                                            <span class="sr">Pretraga po npravcu</span>
                                            <span class="de">Suche nach Zahlung</span>
                                        </label>
                                        <select class="form-select form-select-sm mb-3" aria-label=".form-select-sm example" name="direction">
                                            <option value=""></option>
                                            <option value="from" <?php echo ($selected_direction=="from")? "selected" : ""; ?>>from airport</option>
                                            <option value="to" <?php echo ($selected_direction=="to")? "selected" : ""; ?>>to airport</option>
                                        </select>
                                    </div>
                                </div>
                                <!--
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="mb-3">
                                        <label for="city" class="form-label">Search by city</label>
                                        <input type="text" class="form-control" id="city" name="city">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="mb-3">
                                        <label for="district" class="form-label">Search by district</label>
                                        <input type="text" class="form-control" id="district" name="district">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="mb-3">
                                        <label for="street" class="form-label">Search by street</label>
                                        <input type="text" class="form-control" id="street" name="street">
                                    </div>
                                </div>
                                -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="mb-3">
                                        <?php
                                        if (isset($_POST["address"])) {
                                            $selected_address = user_input($_POST["address"]);
                                        } else {
                                            $selected_address = "";
                                        }
                                        ?>
                                        <label for="address" class="form-label">
                                            <span class="en">Search by address</span>
                                            <span class="sr">Pretraga po adresi</span>
                                            <span class="de">Suche nach Adresse</span>
                                        </label>
                                        <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlentities($selected_address); ?>">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="mb-3">
                                        <div class="form-check form-check-inline">
                                            <input <?php echo (isset($_POST["checkdate"]))? "checked" : ""; ?> class="form-check-input" type="checkbox" name="checkdate" id="checkdate">
                                            <label class="form-check-label" for="checkdate">
                                                <span class="en">Search by ride date</span>
                                                <span class="sr">Pretraga po datumu</span>
                                                <span class="de">Suche nach Fahrtdatum</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4 checkdate <?php echo (!isset($_POST["checkdate"]))? "visually-hidden" : ""; ?>">
                                    <div class="row mb-3">
                                        <?php
                                        if (isset($_POST["dateFrom"])) {
                                            $dateFrom = user_input($_POST["dateFrom"]);
                                        } else {
                                            $dateFrom = "";
                                        }
                                        ?>
                                        <label for="dateFrom" class="col-sm-2 col-form-label">
                                            <span class="en">from the</span>
                                            <span class="sr">Od</span>
                                            <span class="de">vom</span>
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" id="dateFrom" name="dateFrom" value="<?php echo htmlentities($dateFrom); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4 checkdate <?php echo (!isset($_POST["checkdate"]))? "visually-hidden" : ""; ?>">
                                    <div class="row mb-3">
                                        <?php
                                        if (isset($_POST["dateTo"])) {
                                            $dateTo = user_input($_POST["dateTo"]);
                                        } else {
                                            $dateTo = "";
                                        }
                                        ?>
                                        <label for="dateTo" class="col-sm-2 col-form-label">
                                            <span class="en">to the</span>
                                            <span class="sr">do</span>
                                            <span class="de">zum</span>
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" id="dateTo" name="dateTo" value="<?php echo htmlentities($dateTo); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success m-2" name="search" type="submit">
                                        <span class="en">Search</span>
                                        <span class="sr">Pretrazi</span>
                                        <span class="de">Suchen</span>
                                    </button>
                                    <a href="search.php" class="btn btn-primary m-2">
                                        <span class="en">Clear filters</span>
                                        <span class="sr">Ocisti filtere</span>
                                        <span class="de">Filter löschen</span>
                                    </a>
                                </div>
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
                            <span class="en">Search results</span>
                            <span class="sr">Rezultati pretrage</span>
                            <span class="de">Suchergebnisse</span>
                        </h6>
                        <table class="table table-hover table-responsive table-striped table-striped">
                            <thead>
                            <tr>
                                <th scope="col">
                                    <span class="en">#id/status</span>
                                    <span class="sr">#id/status</span>
                                    <span class="de">#id/status</span>
                                </th>
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
                                    <span class="en">trash</span>
                                    <span class="sr">smece</span>
                                    <span class="de">Müll</span>
                                </th>
                                <th scope="col">
                                    <span class="en">delete</span>
                                    <span class="sr">obrisi</span>
                                    <span class="de">löschen</span>
                                </th>
                                <th scope="col">
                                    <span class="en">Change</span>
                                    <span class="sr">Izmeni</span>
                                    <span class="de">Ändern</span>
                                </th>
                                <th scope="col">
                                    <span class="en">restore</span>
                                    <span class="sr">obnovi</span>
                                    <span class="de">wiederherstellen</span>
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


                            if(isset($_POST["search"])){
                                $rides = Ride::search();
                            }else{
                                $rides = Ride::getAssignedAll();
                            }

                            $active_drivers = Driver::get_active_drivers();
                            foreach ($rides as $ride) {
                                /** @var Ride $ride */

                                if($ride->getStatus()=="new_ride"){
                                    $street = $ride->getStreet();
                                    $district = $ride->getDistrict();
                                    $city = $ride->getCity();
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $ride->getId(); ?><hr><?php echo $ride->getStatus(); ?></th>
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
                                        <td></td>
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
                                        <td></td>
                                        <td>
                                            <form action="update-ride.php" method="get">
                                                <button type="submit" name="change" value="<?php echo $ride->getId(); ?>" class="change-admin" title="change ride number <?php echo $ride->getId(); ?>">
                                                    <svg width="20" height="20" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M20.7,5.2a1.024,1.024,0,0,1,0,1.448L18.074,9.276l-3.35-3.35L17.35,3.3a1.024,1.024,0,0,1,1.448,0Zm-4.166,5.614-3.35-3.35L4.675,15.975,3,21l5.025-1.675Z"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <?php
                                }
                                if($ride->getStatus()=="success" || $ride->getStatus()=="failed"){
                                    $street = $ride->getStreet();
                                    $district = $ride->getDistrict();
                                    $city = $ride->getCity();

                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $ride->getId(); ?><hr><?php echo $ride->getStatus(); ?></th>
                                        <td>
                                            <?php echo $ride->getRideInfo(); ?>
                                        </td>
                                        <td>
                                            <?php echo  $ride->getAddressInfo(); ?>
                                        </td>
                                        <td>
                                            <?php echo $ride->getAdditional(); ?>
                                        </td>
                                        <td></td>
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
                                        <td></td>
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
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <?php
                                }
                                if($ride->getStatus()=="deleted"){
                                    $street = $ride->getStreet();
                                    $district = $ride->getDistrict();
                                    $city = $ride->getCity();

                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $ride->getId(); ?><hr><?php echo $ride->getStatus(); ?></th>
                                        <td>
                                            <?php echo $ride->getRideInfo(); ?>
                                        </td>
                                        <td>
                                            <?php echo  $ride->getAddressInfo(); ?>
                                        </td>
                                        <td>
                                            <?php echo $ride->getAdditional(); ?>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <?php echo $ride->getPrice(); ?>
                                        </td>
                                        <td></td>
                                        <td>
                                            <form action="trash-rides.php" method="post">
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
                                        <td></td>
                                        <td>
                                            <form action="trash-rides.php" method="post">
                                                <input type="hidden" name="token" value="<?php echo get_csrf_token(); ?>">
                                                <button type="submit" name="restore" value="<?php echo $ride->getId(); ?>" class="change-admin" title="restore ride number <?php echo $ride->getId(); ?>">
                                                    <svg width="30" height="30" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M18.43 4.25C18.2319 4.25259 18.0426 4.33244 17.9025 4.47253C17.7625 4.61263 17.6826 4.80189 17.68 5V7.43L16.84 6.59C15.971 5.71363 14.8924 5.07396 13.7067 4.73172C12.5209 4.38948 11.2673 4.35604 10.065 4.63458C8.86267 4.91312 7.7515 5.49439 6.83703 6.32318C5.92255 7.15198 5.23512 8.20078 4.84001 9.37C4.79887 9.46531 4.77824 9.56821 4.77947 9.67202C4.7807 9.77583 4.80375 9.87821 4.84714 9.97252C4.89052 10.0668 4.95326 10.151 5.03129 10.2194C5.10931 10.2879 5.20087 10.3392 5.30001 10.37C5.38273 10.3844 5.4673 10.3844 5.55001 10.37C5.70646 10.3684 5.85861 10.3186 5.98568 10.2273C6.11275 10.136 6.20856 10.0078 6.26001 9.86C6.53938 9.0301 7.00847 8.27681 7.63001 7.66C8.70957 6.58464 10.1713 5.98085 11.695 5.98085C13.2188 5.98085 14.6805 6.58464 15.76 7.66L16.6 8.5H14.19C13.9911 8.5 13.8003 8.57902 13.6597 8.71967C13.519 8.86032 13.44 9.05109 13.44 9.25C13.44 9.44891 13.519 9.63968 13.6597 9.78033C13.8003 9.92098 13.9911 10 14.19 10H18.43C18.5289 10.0013 18.627 9.98286 18.7186 9.94565C18.8102 9.90844 18.8934 9.85324 18.9633 9.78333C19.0333 9.71341 19.0885 9.6302 19.1257 9.5386C19.1629 9.44699 19.1814 9.34886 19.18 9.25V5C19.18 4.80109 19.101 4.61032 18.9603 4.46967C18.8197 4.32902 18.6289 4.25 18.43 4.25Z" fill="#000000"/>
                                                        <path d="M18.68 13.68C18.5837 13.6422 18.4808 13.6244 18.3774 13.6277C18.274 13.6311 18.1724 13.6555 18.0787 13.6995C17.9851 13.7435 17.9015 13.8062 17.8329 13.8836C17.7643 13.9611 17.7123 14.0517 17.68 14.15C17.4006 14.9799 16.9316 15.7332 16.31 16.35C15.2305 17.4254 13.7688 18.0291 12.245 18.0291C10.7213 18.0291 9.25957 17.4254 8.18001 16.35L7.34001 15.51H9.81002C10.0089 15.51 10.1997 15.431 10.3403 15.2903C10.481 15.1497 10.56 14.9589 10.56 14.76C10.56 14.5611 10.481 14.3703 10.3403 14.2297C10.1997 14.089 10.0089 14.01 9.81002 14.01H5.57001C5.47115 14.0086 5.37302 14.0271 5.28142 14.0643C5.18982 14.1016 5.1066 14.1568 5.03669 14.2267C4.96677 14.2966 4.91158 14.3798 4.87436 14.4714C4.83715 14.563 4.81867 14.6611 4.82001 14.76V19C4.82001 19.1989 4.89903 19.3897 5.03968 19.5303C5.18034 19.671 5.3711 19.75 5.57001 19.75C5.76893 19.75 5.95969 19.671 6.10034 19.5303C6.241 19.3897 6.32001 19.1989 6.32001 19V16.57L7.16001 17.41C8.02901 18.2864 9.10761 18.926 10.2934 19.2683C11.4791 19.6105 12.7327 19.6439 13.935 19.3654C15.1374 19.0869 16.2485 18.5056 17.163 17.6768C18.0775 16.848 18.7649 15.7992 19.16 14.63C19.1926 14.5362 19.2061 14.4368 19.1995 14.3377C19.1929 14.2386 19.1664 14.1418 19.1216 14.0532C19.0768 13.9645 19.0146 13.8858 18.9387 13.8217C18.8629 13.7576 18.7749 13.7094 18.68 13.68Z" fill="#000000"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <?php
                                }
                                if($ride->getStatus()=="assigned" || $ride->getStatus()=="accepted"){
                                    $street = $ride->getStreet();
                                    $district = $ride->getDistrict();
                                    $city = $ride->getCity();

                                    ?>
                                    <tr class="<?php echo ($ride->getStatus()=="accepted")? "bg-success text-dark" : ""; ?>">
                                        <th scope="row"><?php echo $ride->getId(); ?> <hr> <?php echo $ride->getStatus(); ?></th>
                                        <td>
                                            <?php echo $ride->getRideInfo(); ?>
                                        </td>
                                        <td>
                                            <?php echo  $ride->getAddressInfo(); ?>
                                        </td>
                                        <td>
                                            <?php echo $ride->getAdditional(); ?>
                                        </td>
                                        <td></td>
                                        <td>
                                            <?php
                                            $driver = Driver::getById($ride->getDriverId());
                                            if($driver instanceof Driver){
                                                ?>
                                                <form action="assigned-rides.php" method="post" class="d-inline-block">
                                                    <input type="hidden" name="token" value="<?php echo get_csrf_token(); ?>">
                                                    <div class="row mb-3">

                                                        <div class="col-9 pe-0">
                                                            <?php echo $driver->getUsername(); ?>
                                                        </div>
                                                        <div class="col-3 ps-0">
                                                            <button type="submit" name="unassign" value="<?php echo $ride->getId(); ?>" class="change-admin bg-transparent border-none" title="Remove driver">
                                                                <svg class="fill1" width="25" height="25" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm3.707,12.293a1,1,0,1,1-1.414,1.414L12,13.414,9.707,15.707a1,1,0,0,1-1.414-1.414L10.586,12,8.293,9.707A1,1,0,0,1,9.707,8.293L12,10.586l2.293-2.293a1,1,0,0,1,1.414,1.414L13.414,12Z"/>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <?php
                                            }else{
                                                echo danger("something is wrong,assigned driver not found");
                                            }
                                            ?>


                                        </td>
                                        <td>
                                            <?php echo $ride->getPrice(); ?>
                                        </td>

                                        <td>
                                            <form action="assigned-rides.php" method="post">
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
                                        <td></td>
                                        <td>
                                            <form action="update-ride.php" method="get">
                                                <button type="submit" name="change" value="<?php echo $ride->getId(); ?>" class="change-admin" title="change ride number <?php echo $ride->getId(); ?>">
                                                    <svg width="20" height="20" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M20.7,5.2a1.024,1.024,0,0,1,0,1.448L18.074,9.276l-3.35-3.35L17.35,3.3a1.024,1.024,0,0,1,1.448,0Zm-4.166,5.614-3.35-3.35L4.675,15.975,3,21l5.025-1.675Z"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                        <td></td>
                                        <td>
                                            <?php
                                                $status = $ride->getStatus();

                                                if($status==="accepted"){
                                                    ?>
                                                    <form action="assigned-rides.php" method="post" class="d-inline-block">
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
                                            ?>

                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                    <?php
                                }
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