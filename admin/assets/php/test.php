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

if (!isset($_GET["change"])) {
    header("location: view-rides.php");
    die();
} else {
    $ride_id = $_GET["change"];
    if (!is_numeric($ride_id)) {
        header("location: view-rides.php");
        die();
    }

    $ride_to_change = Ride::getById($ride_id);
}

if (!$ride_to_change instanceof Ride) {
    header("location: assets/php/logout.php");
    die();
}

if (isset($_POST["options"])) {
//$ride_id = $_GET["change"];
    $csrfToken = $_POST["token"];

    if (get_csrf_token() !== $csrfToken) {
        $ans = danger("wrong token");
    } else if (!is_numeric($ride_id)) {
        $ans = danger("something is wrong with id");
    } else {
        $from_to = user_input($_POST["from_to"]);

        $from_to = user_input($_POST["from_to"]);
        $price = 0;

        if ($from_to == "to") {
            $flight_number = NULL;
        } else {
            $flight_number = user_input($_POST["flightnumber"]);
        }


    }
}

if (isset($_POST["basic_info"])) {
    //$ride_id = $_GET["change"];
    $csrfToken = $_POST["token"];

    if (get_csrf_token() !== $csrfToken) {
        $ans = danger("wrong token");
    } else if (!is_numeric($ride_id)) {
        $ans = danger("something is wrong with id");
    } else {
        $name = user_input($_POST["name"]);
        $email = user_input($_POST["email"]);
        $mobile = user_input($_POST["mobile"]);
        $payment = user_input($_POST["payment"]);
        $comment = user_input($_POST["comment"]);
        //data for ride
        $date = user_input($_POST["date"]);
        $hour = user_input($_POST["hour"]);
        $minute = user_input($_POST["minute"]);

        $ride_time = $date . " " . $hour . ":" . $minute . ":00";

        $ans = Ride::updateBasicInfo($ride_id, $name, $email, $mobile, $payment, $comment, $ride_time);
        $ride_to_change = Ride::getById($ride_id);
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
        <!-- Navbar End -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <?php echo $ans; ?>
                    <?php
                    $cities = City::getAll();
                    ?>
                </div>
            </div>
        </div>

        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-sm-12">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">Change ride</h6>
                        <a href="view-rides.php">back to rides</a>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-sm-12 col-md-6">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">Change basic information</h6>

                        <form class="container-fluid" action="update-ride.php?change=<?php echo $ride_id; ?>"
                              method="post">
                            <input type="hidden" name="token" value="<?php echo get_csrf_token(); ?>">
                            <!-- contact info -->
                            <div class="row section">
                                <div class="col-12">
                                    <h6 class="mt-4">CONTACT</h6>
                                    <div class="dlab-separator-outer mb-0">
                                        <div class="dlab-separator bg-dark style-skew mb-2 mt-2"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row section">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text"
                                               value="<?php echo htmlentities($ride_to_change->getName()); ?>"
                                               class="form-control mb-3" id="name" placeholder="Surname" name="name">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email"
                                               value="<?php echo htmlentities($ride_to_change->getEmail()); ?>"
                                               class="form-control mb-3" id="email" aria-describedby="emailHelp"
                                               placeholder="e-mail" name="email">
                                    </div>
                                </div>
                            </div>
                            <div class="row section">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Mobile</label>
                                        <input type="text"
                                               value="<?php echo htmlentities($ride_to_change->getMobile()); ?>"
                                               class="form-control form-select-sm mb-3" id="mobile" placeholder="mobile"
                                               name="mobile">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label>Payment</label>
                                    <select class="form-select form-select-sm mb-3" name="payment" id="payment">
                                        <option value="cash" <?php echo ($ride_to_change->getPayment() == "cash") ? "selected" : ""; ?>>
                                            Payment/CASH
                                        </option>
                                        <option value="card" <?php echo ($ride_to_change->getPayment() == "card") ? "selected" : ""; ?>>
                                            Payment/CARD
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="row section">

                                <div class="col-12">
                                    <label>Comment</label>
                                    <textarea class="form-control" placeholder="comment" name="comment"
                                              id="comment"><?php echo user_input($ride_to_change->getComment()); ?></textarea>
                                </div>

                                <!-- date and time -->
                                <div class="col-12">
                                    <h6 class="mt-4">DATE AND PICKUP TIME</h6>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <input type="date" value="<?php echo $ride_to_change->getDate(); ?>" id="date"
                                               name="date" class="form-control" placeholder="pickup date">
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <select class="form-select form-select-sm mb-3" name="hour" id="hour">
                                        <option>Hour</option>
                                        <?php
                                        for ($i = 0; $i <= 23; $i++) {
                                            if ($i < 10) {
                                                ?>
                                                <option <?php echo ($ride_to_change->getHour() == "0" . $i) ? "selected" : "" ?>
                                                    value="0<?php echo $i; ?>">0<?php echo $i; ?></option>
                                                <?php
                                            } else {
                                                ?>
                                                <option <?php echo ($ride_to_change->getHour() == $i) ? "selected" : "" ?>
                                                    value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-12 col-md-6">
                                    <select class="form-select form-select-sm mb-3" name="minute" id="minute">
                                        <option>Minute</option>
                                        <?php
                                        for ($i = 0; $i <= 55; $i += 5) {
                                            if ($i < 10) {
                                                ?>
                                                <option <?php echo ($ride_to_change->getMinute() == "0" . $i) ? "selected" : "" ?>
                                                    value="0<?php echo $i; ?>">0<?php echo $i; ?></option>
                                                <?php
                                            } else {
                                                ?>
                                                <option <?php echo ($ride_to_change->getMinute() == $i) ? "selected" : "" ?>
                                                    value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-12 col-md-6 offset-md-3 col-lg-4 offset-lg-4">
                                    <button type="submit" class="btn btn-primary mt-2 mb-2 d-block w-100" id="book"
                                            name="basic_info">
                                        Update
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">Change options</h6>

                        <form class="container-fluid" action="update-ride.php?change=<?php echo $ride_id; ?>"
                              method="post">
                            <input type="hidden" name="token" value="<?php echo get_csrf_token(); ?>">

                            <form class="container-fluid" action="update-ride.php?change=<?php echo $ride_id; ?>"
                                  method="post">
                                <input type="hidden" name="token" value="<?php echo get_csrf_token(); ?>">

                                <div class="row">
                                    <div class="col-12 text-center mb-3">
                                        <div class="btn-group" role="group">
                                            <input type="radio" class="btn-check" name="from_to" id="to" value="to"
                                                   autocomplete="off"
                                                <?php echo ($ride_to_change->getFromTo() == "to") ? "checked" : "" ?>
                                            >
                                            <label class="btn btn-outline-primary" for="to">To airport</label>

                                            <input type="radio" class="btn-check" value="from" name="from_to" id="from"
                                                   autocomplete="off"
                                                <?php echo ($ride_to_change->getFromTo() == "from") ? "checked" : "" ?>
                                            >
                                            <label class="btn btn-outline-primary" for="from">From airport</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- pickup address -->
                                <div class="row section">
                                    <div class="col-12">
                                        <h6 class="mt-4">PICKUP ADDRESS</h6>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <select class="form-select form-select-sm mb-3" name="location" id="location">
                                            <?php
                                            $chosen_street_id = $ride_to_change->getStreetsId();
                                            $chosen_district_id = $ride_to_change->getStreet()->getDistrictId();
                                            $chosen_city_id = $ride_to_change->getStreet()->getDistrict()->getCityId();
                                            ?>
                                            <option value="0">Location</option>
                                            <?php
                                            foreach ($cities as $city) {
                                                ?>
                                                <option <?php echo ($city->getId() == $chosen_city_id) ? "selected" : ""; ?>
                                                    value="<?php echo $city->getId(); ?>"><?php echo $city->getName(); ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <select class="form-select form-select-sm mb-3" name="postcode" id="postcode">
                                            <option value="0">Postcode</option>
                                            <?php
                                            $districts = District::getAllByCity($chosen_city_id);
                                            foreach ($districts as $district) {
                                                ?>
                                                <option <?php echo ($district->getId() == $chosen_district_id) ? "selected" : ""; ?>
                                                    value="<?php echo $district->getId(); ?>"><?php echo $district->getName(); ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <select class="form-select form-select-sm mb-3" name="street" id="street">
                                            <option value="0">Street</option>
                                            <?php
                                            $streets = Street::getAllByDistrict($chosen_district_id);
                                            foreach ($streets as $street) {
                                                ?>
                                                <option <?php echo ($street->getId() == $chosen_street_id) ? "selected" : ""; ?>
                                                    value="<?php echo $street->getId(); ?>"><?php echo $street->getName(); ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <input type="text"
                                               value="<?php echo htmlentities($ride_to_change->getStreetNumber()); ?>"
                                               class="form-control form-select-sm mb-3" placeholder="House number"
                                               name="number" id="number">
                                    </div>
                                </div>

                                <!-- additional address -->
                                <div class="row section">
                                    <div class="col-12">
                                        <h6 class="mt-4">ADDITIONAL ADDRESS</h6>

                                        <?php
                                        if (!is_null($ride_to_change->getAdditionalAddress1())) {
                                            $aa1_street_id = $ride_to_change->getAdditionalAddress1();

                                            $aa1_street_id = $ride_to_change->getAdditionalAddress1();
                                            $aa1_district_id = Street::getById($aa1_street_id)->getDistrictId();
                                            $aa1_city_id = District::getById($aa1_district_id)->getCityId();
                                        }
                                        ?>

                                        <input type="checkbox" <?php echo (!is_null($ride_to_change->getAdditionalAddress1())) ? "checked" : ""; ?>
                                               name="additional_address" id="additional_address"
                                               class="form-check-input">

                                        <div class="container-fluid <?php echo (is_null($ride_to_change->getAdditionalAddress1())) ? "closed" : ""; ?> ps-0 pe-0 additional"
                                             id="additional_address_field">
                                            <div class="row">

                                                <div class="col-12 col-md-6">
                                                    <select class="form-select form-select-sm mb-3"
                                                            name="locationAditional" id="locationAditional">
                                                        <option value="0">Location</option>
                                                        <?php
                                                        foreach ($cities as $city) {
                                                            if (is_null($ride_to_change->getAdditionalAddress1())) {
                                                                ?>
                                                                <option value="<?php echo $city->getId(); ?>"><?php echo $city->getName(); ?></option>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <option <?php echo ($city->getId() == $aa1_city_id) ? "selected" : ""; ?>
                                                                    value="<?php echo $city->getId(); ?>"><?php echo $city->getName(); ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="col-12 col-md-6">
                                                    <?php
                                                    $state = "";
                                                    if (is_null($ride_to_change->getAdditionalAddress1())) {
                                                        $state = "disabled";
                                                    }
                                                    ?>
                                                    <select class="form-select form-select-sm mb-3"
                                                            name="postcodeAditional"
                                                            id="postcodeAditional" <?php echo $state; ?>>
                                                        <option value="0">Postcode</option>
                                                        <?php
                                                        if (!is_null($ride_to_change->getAdditionalAddress1())) {
                                                            $districts = District::getAllByCity($chosen_city_id);
                                                            foreach ($districts as $district) {
                                                                ?>
                                                                <option <?php echo ($district->getId() == $aa1_district_id) ? "selected" : ""; ?>
                                                                    value="<?php echo $district->getId(); ?>"><?php echo $district->getName(); ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="col-12 col-md-6">
                                                    <select class="form-select form-select-sm mb-3"
                                                            name="streetAditional" id="streetAditional" <?php echo $state; ?>>
                                                        <option value="0">Street</option>
                                                        <?php
                                                        if (!is_null($ride_to_change->getAdditionalAddress1())) {
                                                            foreach ($streets as $street) {
                                                                ?>
                                                                <option <?php echo ($street->getId() == $aa1_street_id) ? "selected" : ""; ?>
                                                                    value="<?php echo $street->getId(); ?>"><?php echo $street->getName(); ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="col-12 col-md-6">
                                                    <input type="text" class="form-control form-select-sm ToCheck"
                                                           placeholder="House number" name="numberAditional"
                                                           id="numberAditional" value="<?php echo htmlentities($ride_to_change->getAdditionalAddress1StreetNumber()); ?>">
                                                </div>

                                                <div class="col-12">
                                                    <h6 class="mt-4">additional address</h6>
                                                    <div class="dlab-separator-outer mb-0">
                                                        <div class="dlab-separator bg-dark style-skew mt-2"></div>
                                                    </div>
                                                    <input class="form-check-input mb-0" type="checkbox"
                                                           name="additional_address2" id="additional_address2" <?php echo (!is_null($ride_to_change->getAdditionalAddress2())) ? "checked" : ""; ?>>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- additional address 2 -->
                                <?php
                                if (!is_null($ride_to_change->getAdditionalAddress2())) {
                                    $aa2_street_id = $ride_to_change->getAdditionalAddress2();

                                    $aa2_street_id = $ride_to_change->getAdditionalAddress2();
                                    $aa2_district_id = Street::getById($aa2_street_id)->getDistrictId();
                                    $aa2_city_id = District::getById($aa2_district_id)->getCityId();
                                }
                                ?>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <div class="container-fluid <?php echo (is_null($ride_to_change->getAdditionalAddress1())) ? "closed" : ""; ?> ps-0 pe-0 additional"
                                             id="additional_address_field2">
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <select class="form-select form-select-sm mb-3"
                                                            name="locationAditional2" id="locationAditional2">
                                                        <option value="0">Location</option>
                                                        <?php
                                                        foreach ($cities as $city) {
                                                            ?>
                                                            <option value="<?php echo $city->getId(); ?>"><?php echo $city->getName(); ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="col-12 col-md-6">
                                                    <select class="form-select form-select-sm mb-3"
                                                            name="postcodeAditional2" id="postcodeAditional2" disabled>
                                                        <option value="0">Postcode</option>
                                                    </select>
                                                </div>

                                                <div class="col-12 col-md-6">
                                                    <select class="form-select form-select-sm mb-3"
                                                            name="streetAditional2" id="streetAditional2" disabled>
                                                        <option value="0">Street</option>
                                                    </select>
                                                </div>

                                                <div class="col-12 col-md-6">
                                                    <input type="text" class="ToCheck form-control form-select-sm"
                                                           placeholder="House number" name="numberAditional2"
                                                           id="numberAditional2">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- options -->
                                <div class="row section">
                                    <div class="col-12">
                                        <h6 class="mt-4">OPTIONS</h6>
                                    </div>
                                </div>

                                <div class="row section">
                                    <div class="col-12 col-md-6">
                                        <label for="people">persons</label>
                                        <select name="people" id="people" class="form-select form-select-sm mb-3">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8th</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="suitcases">Suitcase</label>
                                        <select class="form-select form-select-sm mb-3" name="suitcases" id="suitcases">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8th</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="suitcases">carry-on baggage</label>
                                        <select class="form-select form-select-sm mb-3" name="handgepack"
                                                id="handgepack">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8th</option>
                                        </select>
                                    </div>

                                    <!-- visually-hidden -->
                                    <div class="col-12 col-md-6 child_seats">
                                        <label for="suitcases">child seat</label>
                                        <select class="form-select form-select-sm mb-3" name="childSeat" id="childSeat">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6 child_seats">
                                        <label for="babyschale">baby seat</label>
                                        <select class="form-select form-select-sm mb-3" name="babyschale"
                                                id="babyschale">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6 child_seats">
                                        <label for="babyschale">RAISED SEAT</label>
                                        <select class="form-select form-select-sm mb-3" name="kindersitzerhohung"
                                                id="kindersitzerhohung">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label></label>
                                        <input type="text" class="form-control form-select-sm mb-3 visually-hidden"
                                               placeholder="flight number" name="flightnumber" id="flightnumber">
                                    </div>


                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <div class="form-check form-switch text-start">
                                                <input class="form-check-input" type="checkbox" id="povratnaCheck"
                                                       name="returnride">
                                                <label class="form-check-label " for="flexSwitchCheckChecked">return
                                                    trip</label>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-6 offset-md-3 col-lg-4 offset-lg-4">
                                        <button type="submit" class="btn btn-primary mt-2 mb-2 d-block w-100" id="book"
                                                name="options">
                                            Update
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