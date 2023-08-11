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

//unassign
/*
if(isset($_POST["unassign"])){
    $ride_id = $_POST["unassign"];
    $csrfToken = $_POST["token"];

    if(get_csrf_token()!==$csrfToken){
        $ans = danger("wrong token");
    }else if(!is_numeric($ride_id)){
        $ans = danger("something is wrong with id");
    }else{
        $ans = Ride::unasign($ride_id);
    }
}
*/

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

//restore

if(isset($_POST["restore"])){
    $ride_id = $_POST["restore"];
    $csrfToken = $_POST["token"];

    if(get_csrf_token()!==$csrfToken){
        $ans = danger("wrong token");
    }else if(!is_numeric($ride_id)){
        $ans = danger("something is wrong with id");
    }else{
        $ans = Ride::restore($ride_id);
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

        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-sm-12">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">Trash rides</h6>
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
                                    <span class="en">price</span>
                                    <span class="sr">cena</span>
                                    <span class="de">preis</span>
                                </th>
                                <th scope="col">
                                    <span class="en">Delete</span>
                                    <span class="sr">obrisi</span>
                                    <span class="de">Löschen</span>
                                </th>
                                <th scope="col">
                                    <span class="en">restore</span>
                                    <span class="sr">obnovi</span>
                                    <span class="de">wiederherstellen</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            $rides = Ride::getTrashRides();
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
                                        <?php echo $ride->getPrice(); ?>
                                    </td>
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