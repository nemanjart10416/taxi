<?php
include_once("assets/php/funkcije.php");

$ans = "";

if(isset($_POST["book"])){
    //$ans = Validate::addNewRide();
    $ans = add_new_ride();
    $rideAdded = true;
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
    <meta property="og:description" content=" Flughafentransfer: Buchen Sie jetzt und starten Sie Ihre Reise bequem und stressfrei. Unser zuverlässiger Service bringt Sie pünktlich zum Flughafen✅."/>
    <meta name="description" content="Flughafentransfer: Buchen Sie jetzt und starten Sie Ihre Reise bequem und stressfrei. Unser zuverlässiger Service bringt Sie pünktlich zum Flughafen✅."/>

    <title>Taxi zum Flughafen | Taxi Airport Driver Vienna 24</title>
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WXXKB3J" height="0" width="0" style="display: none; visibility: hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<div class="container booking-form mt-5 mb-5">
    <div class="row">
        <div class="col-12 text-center">
            <?php echo $ans; ?>
        </div>
    </div>
    <div><h1 class="heading-primary align colotext">taksi do aerodruma</h1></div>
    <div class="row">
        <div class="col-12 col-md-6">
            <form class="container-fluid text-center form_1" method="POST">
                <input type="hidden" name="from_to" value="to">
                <!-- Date and pickup time -->
                <div class="row section">
                    <div class="col-12">
                        <p class="mb-0 text-uppercase title text-shadow-2 title mt-5 h3">datum i vreme</p>
                        <div class="dlab-separator-outer mb-0">
                            <div class="dlab-separator bg-dark style-skew mb-2 mt-2"></div>
                        </div>
                    </div>
                    <div class="col-12 text-start">
                        <div class="form-group">
                            <label class="text-start d-inline-block mt-3 mb-0">Datum*</label>
                            <input type="date" id="date" name="date" class="form-control" placeholder="date">
                        </div>
                    </div>

                    <div class="col-12 col-md-6 text-start">
                        <label class="text-start d-inline-block mt-3 mb-0">sat*</label>
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

                    <div class="col-12 col-md-6 text-start">
                        <label class="text-start d-inline-block mt-3 mb-0">minut*</label>

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

                <!-- PICKUP ADDRESS -->
                <div class="row section">
                    <div class="col-12">
                        <p class="mb-0 text-uppercase title text-shadow-2 title mt-3 h3">adresa</p>
                        <div class="dlab-separator-outer mb-0">
                            <div class="dlab-separator bg-dark style-skew mb-2 mt-2"></div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6  mt-3">
                        <input type="text" class="form-control" placeholder="adresa" name="number" id="number">
                    </div>
                </div>


                <!-- CONTACT -->
                <div class="row section">
                    <div class="col-12">
                        <p class="mb-0 text-uppercase title text-shadow-2 title mt-3 mb-3 h3">kontakt</p>
                        <div class="dlab-separator-outer mb-0">
                            <div class="dlab-separator bg-dark style-skew mb-2 mt-2"></div>
                        </div>
                    </div>
                </div>

                <div class="row section">
                    <div class="col-12 col-md-6 mt-3">
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
                            <input type="text" class="form-control" id="mobile" placeholder="telefon" name="mobile">
                        </div>
                    </div>
                </div>

                <!-- OPTIONS -->
                <div class="row section">
                    <div class="col-12">
                        <p class="mb-0 text-uppercase title text-shadow-2 title mt-3 h3">opcije</p>
                        <div class="dlab-separator-outer mb-0">
                            <div class="dlab-separator bg-dark style-skew mb-2 mt-2"></div>
                        </div>
                    </div>
                </div>

                <div class="row section">
                    <div class="col-12 col-md-6 mt-3 text-start">
                        <label for="suitcases">broj kofera</label>
                        <select class="form-control" name="suitcases" id="suitcases">
                            <option value="0">0</option>
                            <?php
                            for($i=1;$i<=$enviroment->getMaxSuitcases();$i++){
                                ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-12 mt-3">
                        <textarea class="form-control" placeholder="komentar" name="comment" id="comment"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-12 mb-4 mt-3">
                            <button type="submit" class="btn btn-primary mt-2 mb-2 d-block w-100" id="bookTo" name="book">
                                button
                            </button>

                            <p class="text-danger">
                                Важно је да проверите своју спам фасциклу за потврду.
                            </p>
                        </div>
                        <div class="col-12 mb-4">
                            <div class="form-check" id="checkbox_accept_ride_div">
                                <input class="form-check-input" type="checkbox" value="" id="checkbox_accept_ride">
                                <!--<label class="form-check-label" for="checkbox_accept_ride">-->
                                <label class="form-check-label" for="checkbox_accept_ride">
                                    Ich habe die
                                    <span class="modal_link d-inline-block color1" data-bs-toggle="modal" data-bs-target="#agb" data-backdrop="false" tabindex="0">
                                                    AGB</span>
                                    ound
                                    <span class="modal_link d-inline-block color1" data-bs-toggle="modal" data-bs-target="#agb" data-backdrop="false" tabindex="0">
                                                    Datenschutzerklärung
                                                </span>
                                    gelesen und akzeptiere diese.
                                </label>
                            </div>
                        </div>
                    </div>

                </div>


            </form>
        </div>
        <div class="col-12 col-md-6">
            <h2 class="heading-secondary align margint">Wichtige Informationen!
            </h2>
            <p class="text margb24 padding bgcol"> Fahrten, die bis 22.00 Uhr am selben Tag stattfinden sollen, mindestens 4 Stunden vorher reservieren.</p>
            <p class="text margb24 padding bgcol"> Fahrten, die zwischen 22.00 und 6.00 stattfinden sollen, mindestens 6 Stunden vorher reservieren.</p>
            <p class="text margb24 padding bgcol"> Im Falle zu später Reservierung können wir die Verfügbarkeit eines Wagens – trotz automatischer Bestätigung über Internet – nicht garantieren.</p>
            <p class="text margb24 padding bgcol"> Flughafentaxi Wien Wartezeit bis 5 Minuten gratis, danach pro angefangene 5 Minuten je € 5,- extra (Richtung ZUM Flughafen)</p>
            <p class="text margb24 padding bgcol"> WICHTIG!! Bitte schalten Sie Ihr Telefon nach der Landung ein damit Ihr zuständiger Fahrer Sie kontaktieren kann ! ACHTUNG: Der Treffpunkt wird vom Chauffeur bekannt gegeben.</p>

        </div>
    </div>
</div>


</body>
</html>
