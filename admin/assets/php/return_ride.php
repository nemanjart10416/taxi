<div id="povratna_voznja" class="closed">
    <div class="row">
        <div class="col-12 text-center">
            <hr>
            <h6 class="mb-4">
                <span class="en">return trip</span>
                <span class="sr">povratna voznja</span>
                <span class="de">Hin-und Rückfahrt</span>
            </h6>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="container-fluid">
                <!-- date and time -->
                <div class="row section">
                    <div class="col-12 text-center mt-3">
                        <h6 class="mt-4">
                            <span class="en">Date and time</span>
                            <span class="sr">Datum i vreme</span>
                            <span class="de">Datum und Uhrzeit</span>
                        </h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input value="<?php /** @var TYPE_NAME $rideAdded */
                            echo ($rideAdded==false && isset($_POST["returndate"]))? $_POST["returndate"] : ""; ?>" name="returndate" id="returndate" type="date" class="form-control mb-3" placeholder="Abholdatum">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <select class="form-select form-select-sm mb-3" name="returnhour" id="returnhour">
                            <option value="-1">Hour</option>
                            <?php
                            for($i=0;$i<=23;$i++){
                                if($i<10){
                                    ?>
                                    <option <?php echo ($rideAdded==false && isset($_POST["returnhour"]) && $_POST["returnhour"]==$i)? "selected" : ""; ?> value="0<?php echo $i; ?>">
                                        0<?php echo $i; ?>
                                    </option>
                                    <?php
                                }else{
                                    ?>
                                    <option <?php echo ($rideAdded==false && isset($_POST["returnhour"]) && $_POST["returnhour"]==$i)? "selected" : ""; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <select class="form-select form-select-sm mb-3" name="returnminute" id="returnminute">
                            <option value="-1">Minute</option>
                            <?php
                            for($i=0;$i<=55;$i+=5){
                                if($i<10){
                                    ?>
                                    <option <?php echo ($rideAdded==false && isset($_POST["returnminute"]) && $_POST["returnminute"]==$i)? "selected" : ""; ?> value="0<?php echo $i; ?>">0<?php echo $i; ?></option>
                                    <?php
                                }else{
                                    ?>
                                    <option <?php echo ($rideAdded==false && isset($_POST["returnminute"]) && $_POST["returnminute"]==$i)? "selected" : ""; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- PICK-UP ADDRESS -->
                <div class="row section">
                    <div class="col-12 text-center">
                        <h6 class="mb-4">
                            <span class="en">address</span>
                            <span class="sr">adresa</span>
                            <span class="de">Adresse</span>
                        </h6>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6">
                        <select class="form-select form-select-sm mb-3" name="returnlocation" id="returnlocation">
                            <option value="0">Location</option>
                            <?php
                            /** @var TYPE_NAME $cities */
                            foreach ($cities as $city){
                                ?>
                                <option value="<?php echo $city->getId(); ?>"><?php echo $city->getName(); ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <select class="form-select form-select-sm mb-3" name="returnpostcode" id="returnpostcode" disabled>
                            <option value="0">Postcode</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <select class="form-select form-select-sm mb-3" name="returnstreet" id="returnstreet" disabled>
                            <option value="0">Street</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <input type="text" class="form-control form-select-sm mb-3" placeholder="Hausnummer" name="returnnumber" id="returnnumber">
                    </div>
                </div>

                <!-- ADDITIONAL ADDRESS -->
                <div class="row section">
                    <div class="col-12 text-center">
                        <h6 class="mb-4">
                            <span class="en">additional address</span>
                            <span class="sr">dodatna adresa</span>
                            <span class="de">zusätzliche Adresse</span>
                        </h6>
                        <input type="checkbox" name="returnadditional_address" id="returnadditional_address" class="form-check-input form-select-sm mb-3">
                    </div>
                </div>

                <div class="row closed" id="returnadditional_address_field">
                    <div class="col-12 col-md-6">
                        <select class="form-select form-select-sm mb-3" name="returnlocationAditional" id="returnlocationAditional">
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
                        <select class="form-select form-select-sm mb-3" name="returnpostcodeAditional" id="returnpostcodeAditional" disabled>
                            <option value="0">Postcode</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <select class="form-select form-select-sm mb-3" name="returnstreetAditional" id="returnstreetAditional" disabled>
                            <option value="0">Street</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <input type="text" class="ToCheck form-control form-select-sm mb-3" placeholder="Hausnummer" name="returnnumberAditional" id="returnnumberAditional">
                    </div>
                </div>


            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="container-fluid">
                <div class="row section">
                    <div class="col-12 text-center">
                        <h6 class="mb-4">
                            <span class="en">options</span>
                            <span class="sr">opcije</span>
                            <span class="de">Optionen</span>
                        </h6>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="returnpeople">
                            <span class="en">People</span>
                            <span class="sr">Broj osoba</span>
                            <span class="de">Personen</span>
                        </label>
                        <select name="returnpeople" id="returnpeople" class="form-select form-select-sm mb-3">
                            <?php
                            /** @var Enviroment $enviroment */
                            for($i=1; $i<=$enviroment->getMaxPeople(); $i++){
                                ?>
                                <option <?php echo (!$rideAdded && isset($_POST["returnpeople"]) && $_POST["returnpeople"]==$i)? "selected" : ""; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="returnsuitcases">
                            <span class="en">suitcases</span>
                            <span class="sr">koferi</span>
                            <span class="de">Koffer</span>
                        </label>
                        <select class="form-select form-select-sm mb-3" name="returnsuitcases" id="returnsuitcases">
                            <option value="0">0</option>
                            <?php
                            for($i=0;$i<=$enviroment->getMaxSuitcases();$i++){
                                ?>
                                <option <?php echo (!$rideAdded && isset($_POST["returnsuitcases"]) && $_POST["returnsuitcases"]==$i)? "selected" : ""; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 return_child_seats">
                        <label for="returnbabySeat">baby seats</label>
                        <select class="form-select form-select-sm mb-3" name="returnbabySeat" id="returnbabySeat">
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
                    <div class="col-12 col-md-6 return_child_seats">
                        <label for="returnchildSeat">child seats</label>
                        <select class="form-select form-select-sm mb-3" name="returnchildSeat" id="returnchildSeat">
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
                    <div class="col-12 col-md-6 return_child_seats">
                        <label for="returnraisedSeat">raised seats</label>
                        <select class="form-select form-select-sm mb-3" name="returnraisedSeat" id="returnraisedSeat">
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
                        <input type="text" class="form-control form-select-sm mb-3" placeholder="flight number" name="returnflightnumber" id="returnflightnumber">
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>