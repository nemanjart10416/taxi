<?php
include_once("assets/php/funkcije.php");

$ans = "";
/*
if(isset($_POST["book"])){
    $ans = Validate::addNewRide();

    if($ans===true){
        $ans = add_new_ride();
        $rideAdded = true;
    }
}
*/

if(isset($_POST["posalji_voznju"])){
    $ans = add_new_ride2();
}

$enviroment = new Enviroment();

?>

<!DOCTYPE html>
<html lang="de-AT">
<head>
    <!-- End Google Tag Manager -->
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="style.css"/>

    <meta property="og:title" content="Flughafentransfer Wien | Taxi Airport Driver Vienna 24"/>

    <link rel="canonical" href="https://airportdrivervienna24.at/taxi-vom-flughafen"/>
    <link rel="icon" href="img/logolink.png"/>

    <meta property="og:description" content=" Flughafentransfer: Buchen Sie jetzt und starten Sie Ihre Reise bequem und stressfrei. Unser zuverlässiger Service bringt Sie pünktlich zum Flughafen✅."/>
    <meta name="description" content="Flughafentransfer: Buchen Sie jetzt und starten Sie Ihre Reise bequem und stressfrei. Unser zuverlässiger Service bringt Sie pünktlich zum Flughafen✅."/>

    <title>Taxi vom Flughafen | Taxi Airport Driver Vienna 24</title>
</head>
<body>

<div class="container booking-form mt-5 mb-5">
    <div class="row">
        <div class="col-12 text-center">
            <?php echo $ans; ?>
        </div>
    </div>
    <div><h1 class="heading-primary align colotext">Narucivanje voznje</h1></div>
    <div class="row">
        <div class="col-12 col-md-6">
            <form class="container-fluid text-center form_1" method="POST" id="order_ride">

                <div class="row section">
                    <div class="col-12">
                        <p class="mb-0 text-uppercase title text-shadow-2 title mt-3 h3">kontakt podaci</p>
                        <div class="dlab-separator-outer mb-0">
                            <div class="dlab-separator bg-dark style-skew mb-2 mt-2"></div>
                        </div>
                    </div>
                </div>

                <div class="row section">
                    <div class="col-12 col-md-6  mt-3">
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" placeholder="ime" name="name">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mt-3">
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" placeholder="E-mail" name="email">
                        </div>
                    </div>
                </div>

                <div class="row section">
                    <div class="col-12 col-md-6 mt-3">
                        <div class="form-group">
                            <input type="text" class="form-control" id="mobile" placeholder="broj telefona" name="mobile">
                        </div>
                    </div>
                </div>

                <!-- Date and pickup time -->
                <div class="row section">
                    <div class="col-12">
                        <p class="mb-0 text-uppercase title text-shadow-2 title mt-5 h3">datum i vreme</p>
                        <div class="dlab-separator-outer mb-0">
                            <div class="dlab-separator bg-dark style-skew mb-2 mt-2"></div>
                        </div>
                    </div>

                    <div class="col-12 text-start">
                        <div class="form-group d-flex align-items-center">
                            <label class="text-start d-inline-block mb-0 me-3" for="instant_ride">Trenutno narucivanje</label>
                            <input type="checkbox" name="instant_ride" id="instant_ride" class="form-check-input">
                        </div>
                    </div>

                    <div class="col-12 text-start ride_time">
                        <div class="form-group">
                            <label class="text-start d-inline-block mt-3 mb-0">Datum*</label>
                            <input type="date" id="date" name="date" class="form-control"  placeholder="Date">
                        </div>
                    </div>

                    <div class="col-12 col-md-6 text-start ride_time">
                        <label class="text-start d-inline-block mt-4 mb-0">Sat*</label>

                        <select class="form-control" name="hour" id="hour">
                            <?php
                            for($i=0;$i<=23;$i++){
                                if($i<10){
                                    ?>
                                    <option value="0<?php echo $i; ?>">0<?php echo $i; ?></option>
                                    <?php
                                }else{
                                    ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 text-start ride_time">
                        <label class="text-start d-inline-block mt-4 mb-0">Minut*</label>

                        <select class="form-control" name="minute" id="minute">

                            <?php
                            for($i=0;$i<=55;$i+=5){
                                if($i<10){
                                    ?>
                                    <option value="0<?php echo $i; ?>">0<?php echo $i; ?></option>
                                    <?php
                                }else{
                                    ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row section">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="text-start d-inline-block mt-4 mb-0">Vasa adresa</label>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <textarea class="form-control" placeholder="Kommentar" name="comment" id="comment"></textarea>
                </div>

                <button type="submit" name="posalji_voznju" class="btn btn-primary mt-3 mb-3">
                    Naruci
                </button>

            </form>
        </div>
        <div class="col-12 col-md-6">
            <h2 class="heading-secondary align margint">Wichtige Informationen!
            </h2>
            <p class="text margb24 padding bgcol"> Fahrten, die bis 22.00 Uhr am selben Tag stattfinden sollen, mindestens 4 Stunden vorher reservieren.</p>
            <p class="text margb24 padding bgcol">  Fahrten, die zwischen 22.00 und 6.00 stattfinden sollen, mindestens 10 Stunden vorher reservieren.</p>
            <p class="text margb24 padding bgcol">  Im Falle zu später Reservierung können wir die Verfügbarkeit eines Wagens – trotz automatischer Bestätigung über Internet – nicht garantieren.</p>
            <p class="text margb24 padding bgcol">  WICHTIG!! Bitte schalten Sie Ihr Telefon nach der Landung ein damit Ihr zuständiger Fahrer Sie kontaktieren kann ! ACHTUNG: Der Treffpunkt wird vom Chauffeur bekannt gegeben.</p>


        </div>
    </div>
</div>

<script src="assets/js/script.js" defer></script>
</body>
</html>
