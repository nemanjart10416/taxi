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

$rideAdded = false;
if(isset($_POST["book"])){
    @$csrfToken = $_POST["token"];

    if(get_csrf_token()!==$csrfToken){
        $ans = danger("wrong token");
    }else{
        $ans = Validate::addNewRide();

        if($ans===true){
            $ans = add_new_ride();
            $rideAdded = true;
        }
    }
}

$enviroment = new Enviroment();
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
                            <span class="en">add new ride</span>
                            <span class="sr">Dodaj novu voznju</span>
                            <span class="de">neue Fahrt hinzufügen</span>
                        </h6>
                        <a href="view-rides.php">
                            <span class="en">back to rides</span>
                            <span class="sr">nazad na voznje</span>
                            <span class="de">zurück zu Fahrten</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-sm-12">
                    <div class="bg-secondary rounded h-100 p-4">

                        <?php
                            $cities = City::getAll();
                        ?>

                        <form class="container-fluid" action="add-ride.php" method="post">
                            <input type="hidden" name="token" value="<?php echo get_csrf_token(); ?>">

                            <div class="row">
                                <div class="col-12 text-center mb-3">
                                    <div class="btn-group" role="group">
                                        <input type="radio" class="btn-check" name="from_to" id="to" value="to" autocomplete="off" checked="">
                                        <label class="btn btn-outline-primary" for="to">
                                            <span class="en">To airport</span>
                                            <span class="sr">Do aerodruma</span>
                                            <span class="de">Zum Flughafen</span>
                                        </label>

                                        <input type="radio" class="btn-check" value="from" name="from_to" id="from" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="from">
                                            <span class="en">From airport</span>
                                            <span class="sr">Od aerodruma</span>
                                            <span class="de">Vom Flughafen</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="container-fluid">
                                        <!-- date and time -->
                                        <div class="row section">
                                            <div class="col-12">
                                                <h6 class="mt-4">
                                                    <span class="en">Date and time</span>
                                                    <span class="sr">Datum i vreme</span>
                                                    <span class="de">Datum und Uhrzeit</span>
                                                </h6>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <div class="form-group">
                                                    <input value="<?php echo ($rideAdded==false && isset($_POST["date"]))? $_POST["date"] : ""; ?>" type="date" id="date" name="date" class="form-control" placeholder="pickup date">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <select class="form-select form-select-sm mb-3" name="hour" id="hour">
                                                    <option value="-1">Hour</option>
                                                    <?php
                                                        for($i=0;$i<=23;$i++){
                                                            if($i<10){
                                                                ?>
                                                                <option <?php echo ($rideAdded==false && isset($_POST["hour"]) && $_POST["hour"]==$i)? "selected" : ""; ?> value="0<?php echo $i; ?>">
                                                                    0<?php echo $i; ?>
                                                                </option>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <option <?php echo ($rideAdded==false && isset($_POST["hour"]) && $_POST["hour"]==$i)? "selected" : ""; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <select class="form-select form-select-sm mb-3" name="minute" id="minute">
                                                    <option value="-1">Minute</option>
                                                    <?php
                                                        for($i=0;$i<=55;$i+=5){
                                                            if($i<10){
                                                                ?>
                                                                <option <?php echo ($rideAdded==false && isset($_POST["minute"]) && $_POST["minute"]==$i)? "selected" : ""; ?> value="0<?php echo $i; ?>">0<?php echo $i; ?></option>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <option <?php echo ($rideAdded==false && isset($_POST["minute"]) && $_POST["minute"]==$i)? "selected" : ""; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- pickup address -->
                                        <div class="row section">
                                            <div class="col-12">
                                                <h6 class="mt-4">
                                                    <span class="en">address</span>
                                                    <span class="sr">adresa</span>
                                                    <span class="de">Adresse</span>
                                                </h6>
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <select class="form-select form-select-sm mb-3" name="location" id="location">
                                                    <option value="0">Location</option>
                                                    <?php
                                                    foreach ($cities as $city){
                                                        ?>
                                                            <option value="<?php echo $city->getId(); ?>"><?php echo $city->getName(); ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <select class="form-select form-select-sm mb-3" name="postcode" id="postcode" disabled>
                                                    <option value="0">Postcode</option>
                                                </select>
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <select class="form-select form-select-sm mb-3" name="street" id="street" disabled>
                                                    <option value="0">Street</option>
                                                </select>
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <input type="text" class="form-control form-select-sm mb-3" placeholder="House number" name="number" id="number">
                                            </div>
                                        </div>

                                        <!-- additional address -->
                                        <div class="row section">
                                            <div class="col-12">
                                                <h6 class="mt-4">
                                                    <span class="en">additional address</span>
                                                    <span class="sr">dodatna adresa</span>
                                                    <span class="de">zusätzliche Adresse</span>
                                                </h6>

                                                <input type="checkbox" name="additional_address" id="additional_address" class="form-check-input">

                                                <div class="container-fluid closed ps-0 pe-0 additional" id="additional_address_field">
                                                    <div class="row">

                                                        <div class="col-12 col-md-6">
                                                            <select class="form-select form-select-sm mb-3" name="locationAditional" id="locationAditional">
                                                                <option value="0">Location</option>
                                                                <?php
                                                                foreach ($cities as $city){
                                                                    ?>
                                                                    <option value="<?php echo $city->getId(); ?>"><?php echo $city->getName(); ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="col-12 col-md-6">
                                                            <select class="form-select form-select-sm mb-3" name="postcodeAditional" id="postcodeAditional" disabled>
                                                                <option value="0">Postcode</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-12 col-md-6">
                                                            <select class="form-select form-select-sm mb-3" name="streetAditional" id="streetAditional" disabled>
                                                                <option value="0">Street</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-12 col-md-6">
                                                            <input type="text" class="form-control form-select-sm ToCheck" placeholder="House number" name="numberAditional" id="numberAditional">
                                                        </div>

                                                        <div class="col-12">
                                                            <h6 class="mt-4">
                                                                <span class="en">additional address</span>
                                                                <span class="sr">dodatna adresa</span>
                                                                <span class="de">zusätzliche Adresse</span>
                                                            </h6>
                                                            <div class="dlab-separator-outer mb-0">
                                                                <div class="dlab-separator bg-dark style-skew mt-2"></div>
                                                            </div>
                                                            <input class="form-check-input mb-0" type="checkbox" name="additional_address2" id="additional_address2">
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- additional address 2 -->
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <div class="container-fluid closed ps-0 pe-0 additional" id="additional_address_field2">
                                                    <div class="row">
                                                        <div class="col-12 col-md-6">
                                                            <select class="form-select form-select-sm mb-3" name="locationAditional2" id="locationAditional2">
                                                                <option value="0">Location</option>
                                                                <?php
                                                                foreach ($cities as $city){
                                                                    ?>
                                                                    <option value="<?php echo $city->getId(); ?>"><?php echo $city->getName(); ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="col-12 col-md-6">
                                                            <select class="form-select form-select-sm mb-3" name="postcodeAditional2" id="postcodeAditional2" disabled>
                                                                <option value="0">Postcode</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-12 col-md-6">
                                                            <select class="form-select form-select-sm mb-3" name="streetAditional2" id="streetAditional2" disabled>
                                                                <option value="0">Street</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-12 col-md-6">
                                                            <input type="text" class="ToCheck form-control form-select-sm" placeholder="House number" name="numberAditional2" id="numberAditional2">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="container-fluid">
                                        <!-- contact info -->
                                        <div class="row section">
                                            <div class="col-12">
                                                <h6 class="mt-4">
                                                    <span class="en">contact</span>
                                                    <span class="sr">kontakt</span>
                                                    <span class="de">Kontakt</span>
                                                </h6>
                                                <div class="dlab-separator-outer mb-0">
                                                    <div class="dlab-separator bg-dark style-skew mb-2 mt-2"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row section">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <input value="<?php echo ($rideAdded==false && isset($_POST["name"]))? $_POST["name"] : ""; ?>" type="text" class="form-control mb-3" id="name" placeholder="name" name="name">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <input value="<?php echo ($rideAdded==false && isset($_POST["email"]))? $_POST["email"] : ""; ?>" type="email" class="form-control mb-3" id="email" aria-describedby="emailHelp" placeholder="e-mail" name="email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row section">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <input value="<?php echo ($rideAdded==false && isset($_POST["mobile"]))? $_POST["mobile"] : ""; ?>" type="text" class="form-control form-select-sm mb-3" id="mobile" placeholder="mobile" name="mobile">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- options -->
                                        <div class="row section">
                                            <div class="col-12">
                                                <h6 class="mt-4">
                                                    <span class="en">options</span>
                                                    <span class="sr">opcije</span>
                                                    <span class="de">Optionen</span>
                                                </h6>
                                            </div>
                                        </div>

                                        <div class="row section">
                                            <div class="col-12 col-md-6">
                                                <label for="people">
                                                    <span class="en">People</span>
                                                    <span class="sr">Broj osoba</span>
                                                    <span class="de">Personen</span>
                                                </label>
                                                <select name="people" id="people" class="form-select form-select-sm mb-3">
                                                    <?php
                                                        for($i=1;$i<=$enviroment->getMaxPeople();$i++){
                                                            ?>
                                                            <option <?php echo (!$rideAdded && isset($_POST["people"]) && $_POST["people"]==$i)? "selected" : ""; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="suitcases">
                                                    <span class="en">suitcases</span>
                                                    <span class="sr">koferi</span>
                                                    <span class="de">Koffer</span>
                                                </label>
                                                <select class="form-select form-select-sm mb-3" name="suitcases" id="suitcases">
                                                    <option value="0">0</option>
                                                    <?php
                                                    for($i=0;$i<=$enviroment->getMaxSuitcases();$i++){
                                                        ?>
                                                        <option <?php echo (!$rideAdded && isset($_POST["suitcases"]) && $_POST["suitcases"]==$i)? "selected" : ""; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <!-- visually-hidden -->
                                            <div class="col-12 col-md-6 child_seats">
                                                <label for="babySeat">baby seat</label>
                                                <select class="form-select form-select-sm mb-3" name="babySeat" id="babySeat">
                                                    <option value="0">0</option>
                                                    <?php
                                                    for($i=1;$i<=$enviroment->getMaxChildSeat();$i++){
                                                        ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-12 col-md-6 child_seats">
                                                <label for="childSeat">child seat</label>
                                                <select class="form-select form-select-sm mb-3" name="childSeat" id="childSeat">
                                                    <option value="0">0</option>
                                                    <?php
                                                    for($i=1;$i<=$enviroment->getMaxChildSeat();$i++){
                                                        ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-12 col-md-6 child_seats">
                                                <label for="raisedSeat">raised seat</label>
                                                <select class="form-select form-select-sm mb-3" name="raisedSeat" id="raisedSeat">
                                                    <option value="0">0</option>
                                                    <?php
                                                    for($i=1;$i<=$enviroment->getMaxChildSeat();$i++){
                                                        ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <label></label>
                                                <input type="text" class="form-control form-select-sm mb-3 visually-hidden" placeholder="flight number" name="flightnumber" id="flightnumber">
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <label for="payment">
                                                    <span class="en">Payment method</span>
                                                    <span class="sr">nacin placanja</span>
                                                    <span class="de">Bezahlverfahren</span>
                                                </label>
                                                <select class="form-select form-select-sm mb-3" name="payment" id="payment">
                                                    <option value="cash">Payment/CASH</option>
                                                    <option value="card">Payment/CARD</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <textarea class="form-control" placeholder="comment" name="comment" id="comment"><?php echo ($rideAdded==false && isset($_POST["comment"]))? $_POST["comment"] : ""; ?></textarea>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-12">
                                                    <div class="form-check form-switch text-start">
                                                        <input class="form-check-input" type="checkbox" id="povratnaCheck" name="returnride">
                                                        <label class="form-check-label " for="flexSwitchCheckChecked">
                                                            <span class="en">return trip</span>
                                                            <span class="sr">povratna voznja</span>
                                                            <span class="de">Hin-und Rückfahrt</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- POVRATNA VOZNJA END -->
                            <?php include_once("assets/php/return_ride.php"); ?>
                            <!-- POVRATNA VOZNJA END -->

                            <div class="row">
                                <div class="col-12 col-md-6 offset-md-3 col-lg-4 offset-lg-4">
                                    <button type="submit" class="btn btn-primary mt-2 mb-2 d-block w-100" id="book" name="book">
                                        <span class="en">Order</span>
                                        <span class="sr">Naruci</span>
                                        <span class="de">Befehl</span>
                                    </button>
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