<?php
include_once("assets/php/funkcije.php");
$ans = "";

if (!isset($_SESSION["status"])) {
    header("location: login.php");
    die();
}

if ($_SESSION["status"] !== "administrator" && $_SESSION["status"] !== "super_administrator") {
    header("location: login.php");
    die();
}

$admin = Admin::getById($_SESSION["podaci"]["administrator_id"]);
if (!$admin instanceof Admin) {
    header("location: assets/php/logout.php");
    die();
}

if(isset($_POST["changecsprice"])){
    $cs_price = user_input($_POST["csprice"]);
    $csrfToken = $_POST["token"];

    if(get_csrf_token()!==$csrfToken){
        $ans = danger("wrong token");
    }else if(!is_numeric($cs_price) || $cs_price<=0){
        $ans = danger("something is wrong with price");
    }else{
        $enviroment = new Enviroment();
        $enviroment->setChildSeatPrice($cs_price);
        $ans = $enviroment->update();
    }
}

if(isset($_POST["changebsprice"])){
    $bs_price = user_input($_POST["bsprice"]);
    $csrfToken = $_POST["token"];

    if(get_csrf_token()!==$csrfToken){
        $ans = danger("wrong token");
    }else if(!is_numeric($bs_price) || $bs_price<=0){
        $ans = danger("something is wrong with price");
    }else{
        $enviroment = new Enviroment();
        $enviroment->setBabySeatPrice($bs_price);
        $ans = $enviroment->update();
    }
}

if(isset($_POST["changersprice"])){
    $rs_price = user_input($_POST["rsprice"]);
    $csrfToken = $_POST["token"];

    if(get_csrf_token()!==$csrfToken){
        $ans = danger("wrong token");
    }else if(!is_numeric($rs_price) || $rs_price<=0){
        $ans = danger("something is wrong with price");
    }else{
        $enviroment = new Enviroment();
        $enviroment->setRaisedSeatPrice($rs_price);
        $ans = $enviroment->update();
    }
}

//changemaxsuitcases
if(isset($_POST["changemaxsuitcases"])){
    $maxsuitcases = user_input($_POST["maxsuitcases"]);
    $csrfToken = $_POST["token"];

    if(get_csrf_token()!==$csrfToken){
        $ans = danger("wrong token");
    }else if(!is_numeric($maxsuitcases) || $maxsuitcases<=0){
        $ans = danger("something is wrong with number");
    }else{
        $enviroment = new Enviroment();
        $enviroment->setMaxSuitcases($maxsuitcases);
        $ans = $enviroment->update();
    }
}

//changemaxmaxcs
if(isset($_POST["changemaxmaxcs"])){
    $maxcs = user_input($_POST["maxcs"]);
    $csrfToken = $_POST["token"];

    if(get_csrf_token()!==$csrfToken){
        $ans = danger("wrong token");
    }else if(!is_numeric($maxcs) || $maxcs<=0){
        $ans = danger("something is wrong with number");
    }else{
        $enviroment = new Enviroment();
        $enviroment->setMaxChildSeat($maxcs);
        $ans = $enviroment->update();
    }
}

//changemaxPeople
if(isset($_POST["changemaxPeople"])){
    $max_people = user_input($_POST["maxpeople"]);
    $csrfToken = $_POST["token"];

    if(get_csrf_token()!==$csrfToken){
        $ans = danger("wrong token");
    }else if(!is_numeric($max_people) || $max_people<=0){
        $ans = danger("something is wrong with number");
    }else{
        $enviroment = new Enviroment();
        $enviroment->setMaxPeople($max_people);
        $ans = $enviroment->update();
    }
}

if(isset($_POST["changeaaprice"])){
    $aa_price = user_input($_POST["aaprice"]);
    $csrfToken = $_POST["token"];

    if(get_csrf_token()!==$csrfToken){
        $ans = danger("wrong token");
    }else if(!is_numeric($aa_price) || $aa_price<=0){
        $ans = danger("something is wrong with price");
    }else{
        $enviroment = new Enviroment();
        $enviroment->setAdditionalAddressPrice($aa_price);
        $ans = $enviroment->update();
    }
}

$enviroment = new Enviroment();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DarkPan - Bootstrap 5 Admin Template</title>
    <!--
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    -->
    <meta name="viewport" content="width=1024">

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
<div class="container-fluid">
    <div class="row">
        <div class="col-12 text-center">
            <?php echo $ans; ?>
        </div>
    </div>
</div>
<div class="container-fluid position-relative d-flex p-0">
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
        <!-- Navbar End -->

        <div class="container-fluid pt-4 px-4" id="google_translate_element">
            <div class="row g-4">
                <div class="col-sm-12">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">
                            <span class="en">options</span>
                            <span class="sr">opcije</span>
                            <span class="de">optionen</span>
                        </h6>
                    </div>
                </div>
            </div>

            <div class="row mt-5">

                <div class="col-12 col-md-6">
                    <form class="bg-secondary rounded h-100 p-4" action="options.php" method="post">
                        <input type="hidden" name="token" value="<?php echo get_csrf_token(); ?>">
                        <div class="row mb-3">
                            <div class="col-9 d-flex align-content-center align-items-center">
                                <label for="aaprice" class="col-sm-5 col-form-label">
                                    <span class="en">Additional address price</span>
                                    <span class="sr visually-hidden">Cena dodatne adrese</span>
                                    <span class="de visually-hidden">Zusätzlicher Adresspreis</span>
                                </label>
                                <input type="text" class="form-control" id="aaprice" name="aaprice" required=""
                                       value="<?php echo htmlentities($enviroment->getAdditionalAddressPrice()); ?>">
                            </div>
                            <div class="col-3">
                                <div class="d-flex align-content-center align-items-center">
                                    <button type="submit" name="changeaaprice" class="btn btn-warning m-2">
                                        <span class="en">change</span>
                                        <span class="sr visually-hidden">promeni</span>
                                        <span class="de visually-hidden">ändern</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-12 col-md-6">
                    <div class="bg-secondary rounded h-100">
                        <form class="bg-secondary rounded h-100 p-4" action="options.php" method="post">
                            <input type="hidden" name="token" value="<?php echo get_csrf_token(); ?>">
                            <div class="row mb-3">
                                <div class="col-9 d-flex align-content-center align-items-center">
                                    <label for="bsprice" class="col-sm-5 col-form-label">
                                        <span class="en">baby seat price</span>
                                        <span class="sr visually-hidden">Cena sedista za bebe</span>
                                        <span class="de visually-hidden">babysitz preis</span>
                                    </label>
                                    <input type="text" class="form-control" id="bsprice" name="bsprice" required=""
                                           value="<?php echo htmlentities($enviroment->getBabySeatPrice()); ?>">
                                </div>
                                <div class="col-3">
                                    <div class="d-flex align-content-center align-items-center">
                                        <button type="submit" name="changebsprice" class="btn btn-warning m-2">
                                            <span class="en">change</span>
                                            <span class="sr visually-hidden">promeni</span>
                                            <span class="de visually-hidden">ändern</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-md-6 mt-5">
                    <div class="bg-secondary rounded h-100">
                        <form class="bg-secondary rounded h-100 p-4" action="options.php" method="post">
                            <input type="hidden" name="token" value="<?php echo get_csrf_token(); ?>">
                            <div class="row mb-3">
                                <div class="col-9 d-flex align-content-center align-items-center">
                                    <label for="maxpeople" class="col-sm-5 col-form-label">
                                        <span class="en">max people for ride</span>
                                        <span class="sr visually-hidden">maksimalan broj ljudi za voznju</span>
                                        <span class="de visually-hidden">max Personen für die Fahrt</span>
                                    </label>
                                    <input type="text" class="form-control" id="maxpeople" name="maxpeople" required=""
                                           value="<?php echo htmlentities($enviroment->getMaxPeople()); ?>">
                                </div>
                                <div class="col-3">
                                    <div class="d-flex align-content-center align-items-center">
                                        <button type="submit" name="changemaxPeople" class="btn btn-warning m-2" href="add-city.php">
                                            <span class="en">change</span>
                                            <span class="sr visually-hidden">promeni</span>
                                            <span class="de visually-hidden">ändern</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-md-6 mt-5">
                    <div class="bg-secondary rounded h-100">
                        <form class="bg-secondary rounded h-100 p-4" action="options.php" method="post">
                            <input type="hidden" name="token" value="<?php echo get_csrf_token(); ?>">
                            <div class="row mb-3">
                                <div class="col-9 d-flex align-content-center align-items-center">
                                    <label for="csprice" class="col-sm-5 col-form-label">
                                        <span class="en">Child seat price</span>
                                        <span class="sr visually-hidden">Cena decjeg sedista</span>
                                        <span class="de visually-hidden">Kindersitz preis</span>
                                    </label>
                                    <input type="text" class="form-control" id="csprice" name="csprice" required=""
                                           value="<?php echo htmlentities($enviroment->getChildSeatPrice()); ?>">
                                </div>
                                <div class="col-3">
                                    <div class="d-flex align-content-center align-items-center">
                                        <button type="submit" name="changecsprice" class="btn btn-warning m-2" href="add-city.php">
                                            <span class="en">change</span>
                                            <span class="sr visually-hidden">promeni</span>
                                            <span class="de visually-hidden">ändern</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-md-6 mt-5">
                    <div class="bg-secondary rounded h-100">
                        <form class="bg-secondary rounded h-100 p-4" action="options.php" method="post">
                            <input type="hidden" name="token" value="<?php echo get_csrf_token(); ?>">
                            <div class="row mb-3">
                                <div class="col-9 d-flex align-content-center align-items-center">
                                    <label for="maxpeople" class="col-sm-5 col-form-label">
                                        <span class="en">max child seat for ride</span>
                                        <span class="sr visually-hidden">maksimalan broj decjih sedista za voznju</span>
                                        <span class="de visually-hidden">max kindersitz zum fahren</span>
                                    </label>
                                    <input type="text" class="form-control" id="maxcs" name="maxcs" required=""
                                           value="<?php echo htmlentities($enviroment->getMaxChildSeat()); ?>">
                                </div>
                                <div class="col-3">
                                    <div class="d-flex align-content-center align-items-center">
                                        <button type="submit" name="changemaxmaxcs" class="btn btn-warning m-2" href="add-city.php">
                                            <span class="en">change</span>
                                            <span class="sr visually-hidden">promeni</span>
                                            <span class="de visually-hidden">ändern</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-md-6 mt-5">
                    <div class="bg-secondary rounded h-100">
                        <form class="bg-secondary rounded h-100 p-4" action="options.php" method="post">
                            <input type="hidden" name="token" value="<?php echo get_csrf_token(); ?>">
                            <div class="row mb-3">
                                <div class="col-9 d-flex align-content-center align-items-center">
                                    <label for="rsprice" class="col-sm-5 col-form-label">
                                        <span class="en">raised seat price</span>
                                        <span class="sr visually-hidden">Cena povecanog sedista</span>
                                        <span class="de visually-hidden">erhöhten Sitzplatzpreis</span>
                                    </label>
                                    <input type="text" class="form-control" id="rsprice" name="rsprice" required=""
                                           value="<?php echo htmlentities($enviroment->getRaisedSeatPrice()); ?>">
                                </div>
                                <div class="col-3">
                                    <div class="d-flex align-content-center align-items-center">
                                        <button type="submit" name="changersprice" class="btn btn-warning m-2">
                                            <span class="en">change</span>
                                            <span class="sr visually-hidden">promeni</span>
                                            <span class="de visually-hidden">ändern</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-md-6 mt-5">
                    <div class="bg-secondary rounded h-100">
                        <form class="bg-secondary rounded h-100 p-4" action="options.php" method="post">
                            <input type="hidden" name="token" value="<?php echo get_csrf_token(); ?>">
                            <div class="row mb-3">
                                <div class="col-9 d-flex align-content-center align-items-center">
                                    <label for="maxsuitcases" class="col-sm-5 col-form-label">
                                        <span class="en">max suitcases for ride</span>
                                        <span class="sr visually-hidden">maksimalan broj kofera sedista za voznju</span>
                                        <span class="de visually-hidden">max Koffer für die Fahrt</span>
                                    </label>
                                    <input type="text" class="form-control" id="maxsuitcases" name="maxsuitcases" required=""
                                           value="<?php echo htmlentities($enviroment->getMaxSuitcases()); ?>">
                                </div>
                                <div class="col-3">
                                    <div class="d-flex align-content-center align-items-center">
                                        <button type="submit" name="changemaxsuitcases" class="btn btn-warning m-2" href="add-city.php">
                                            <span class="en">change</span>
                                            <span class="sr visually-hidden">promeni</span>
                                            <span class="de visually-hidden">ändern</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
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