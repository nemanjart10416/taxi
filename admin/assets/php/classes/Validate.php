<?php

class Validate{
    public static function checkIsAValidDate($myDateString){
        return (bool)strtotime($myDateString);
    }

    public static function changeRideOptions(){
        //PICKUP ADDRESS
        //location
        if(!isset($_POST["location"]) || empty($_POST["location"]) || $_POST["location"]==0 || !is_numeric($_POST["location"])){
            return danger("you must chose location");
        }

        //postcode
        if(!isset($_POST["postcode"]) || empty($_POST["postcode"]) || $_POST["postcode"]==0 || !is_numeric($_POST["postcode"])){
            return danger("you must chose postcode");
        }

        //street
        if(!isset($_POST["street"]) || empty($_POST["street"]) || $_POST["street"]==0 || !is_numeric($_POST["street"])){
            return danger("you must chose street");
        }

        //house number
        if(!isset($_POST["number"])){
            return danger("you must chose house number");
        }

        $house_number = user_input($_POST["number"]);
        if(empty($house_number)){
            return danger("you must chose house number");
        }

        //ADDITIONAL ADDRESS 1
        if(isset($_POST["additional_address"])){
            //location
            if(!isset($_POST["locationAditional"]) || empty($_POST["locationAditional"]) || $_POST["locationAditional"]==0 || !is_numeric($_POST["locationAditional"])){
                return danger("you must chose location for additional address");
            }

            //postcode
            if(!isset($_POST["postcodeAditional"]) || empty($_POST["postcodeAditional"]) || $_POST["postcodeAditional"]==0 || !is_numeric($_POST["postcodeAditional"])){
                return danger("you must chose postcode for additional address");
            }

            //street
            if(!isset($_POST["streetAditional"]) || empty($_POST["streetAditional"]) || $_POST["streetAditional"]==0 || !is_numeric($_POST["streetAditional"])){
                return danger("you must chose street for additional address");
            }

            //house number
            if(!isset($_POST["numberAditional"])){
                return danger("you must chose house number for additional address");
            }

            $house_number = user_input($_POST["numberAditional"]);
            if(empty($house_number)){
                return danger("you must chose house number for additional address");
            }
        }

        //ADDITIONAL ADDRESS 2
        if(isset($_POST["additional_address2"])){
            //location
            if(!isset($_POST["locationAditional2"]) || empty($_POST["locationAditional2"]) || $_POST["locationAditional2"]==0 || !is_numeric($_POST["locationAditional2"])){
                return danger("you must chose location for second additional address");
            }

            //postcode
            if(!isset($_POST["postcodeAditional2"]) || empty($_POST["postcodeAditional2"]) || $_POST["postcodeAditional2"]==0 || !is_numeric($_POST["postcodeAditional2"])){
                return danger("you must chose postcode for second additional address");
            }

            //street
            if(!isset($_POST["streetAditional2"]) || empty($_POST["streetAditional2"]) || $_POST["streetAditional2"]==0 || !is_numeric($_POST["streetAditional2"])){
                return danger("you must chose street for second additional address");
            }

            //house number
            if(!isset($_POST["numberAditional2"])){
                return danger("you must chose house number for second additional address");
            }

            $house_number = user_input($_POST["numberAditional2"]);
            if(empty($house_number)){
                return danger("you must chose house number for second additional address");
            }
        }

        if(!isset($_POST["people"])){
            return danger("you must have number of people");
        }

        $number_people = user_input($_POST["people"]);
        if(empty($number_people) || !is_numeric($number_people)){
            return danger("you must have number of people");
        }

        if($number_people<1 || $number_people>8){
            return danger("something is wrong here");
        }

        if(!isset($_POST["suitcases"])){
            return danger("you must have number of suitcases");
        }

        $number_suitcases = user_input($_POST["suitcases"]);
        if((empty($number_suitcases) && $number_suitcases!=="0") || !is_numeric($number_suitcases)){
            return danger("you must have number of suitcases");
        }

        if($number_suitcases<0 || $number_suitcases>8){
            return danger("something is wrong here");
        }

        if(!isset($_POST["childSeat"])){
            return danger("you must have number of child seats");
        }

        $number_childSeat = user_input($_POST["childSeat"]);
        if((empty($number_childSeat) && $number_childSeat!=="0") || !is_numeric($number_childSeat)){
            return danger("you must have number of child seats");
        }

        if($number_childSeat<0 || $number_childSeat>3){
            return danger("something is wrong here");
        }

        return true;
    }

    public static function changeRidePrice(){
        if(!isset($_POST["price"])){
            return danger("you must enter price");
        }

        $price = user_input($_POST["price"]);

        if(empty($price)){
            return danger("you must enter price");
        }

        if(!is_numeric($price) || $price<0){
            return danger("price is wrong");
        }

        return true;
    }

    public static function changeRideInfo(){


        //date and rime
        if(!isset($_POST["date"])){
            return danger("you must chose pickup date");
        }

        $date = user_input($_POST["date"]);

        if(!self::checkIsAValidDate($date) || empty($date)){
            return danger("invalid date format");
        }

        if(!isset($_POST["hour"]) || empty($_POST["hour"]) || $_POST["hour"]<0){
            return danger("you must chose pickup hour");
        }
        $hour = user_input($_POST["hour"]);

        if(!isset($_POST["minute"]) || empty($_POST["minute"]) || $_POST["minute"]<0){
            return danger("you must chose pickup minute");
        }
        $minute = user_input($_POST["minute"]);

        $ride_time = $date." ".$hour.":".$minute.":00";

        if(!self::checkIsAValidDate($ride_time)){
            return danger("invalid date or time format");
        }

        $currentDateTime = date("Y-m-d h:i").":00";
        $datetime = new DateTime($currentDateTime);
        $datetime->modify('+6 hour');
        $checkDateTime = $datetime->format('Y-m-d h:i').":00";;

        if($currentDateTime>$ride_time){
            return danger("You can't order ride in the past");
        }

        if($checkDateTime>$ride_time){
            return danger("You can't order ride for less than 6 hours in future");
        }

        //contact
        if(!isset($_POST["name"])){
            return danger("you must enter name");
        }

        $name = user_input($_POST["name"]);

        if(empty($name)){
            return danger("you must enter name");
        }

        if(strlen($name)<2 || strlen($name)>30){
            return danger("name not proper size");
        }

        if(!isset($_POST["email"])){
            return danger("you must enter email");
        }

        $email = user_input($_POST["email"]);

        if(empty($email)){
            return danger("you must enter email");
        }

        if(strlen($email)<2 || strlen($email)>70){
            return danger("name not proper size");
        }

        if(!isset($_POST["mobile"])){
            return danger("you must enter mobile phone");
        }

        $mobile = user_input($_POST["mobile"]);

        if(empty($mobile)){
            return danger("you must enter mobile");
        }

        if(strlen($mobile)<2 || strlen($mobile)>30){
            return danger("mobile not proper size");
        }

        $payment = user_input($_POST["payment"]);
        if($payment!=="cash" && $payment!=="card"){
            return danger("How in the hell is possible that you have managed for payment to select something else than card or cash");
        }

        return true;
    }

    public static function addReturnRide(){
        //ride date and time
        if(!isset($_POST["returndate"])){
            return danger("you must chose pickup date for return ride");
        }

        $date = user_input($_POST["returndate"]);

        if(!self::checkIsAValidDate($date) || empty($date)){
            return danger("invalid date format for return ride.");
        }

        if(!isset($_POST["returnhour"]) || empty($_POST["returnhour"]) || $_POST["returnhour"]<0){
            return danger("you must chose pickup hour for return ride");
        }
        $hour = user_input($_POST["returnhour"]);

        if(!isset($_POST["returnminute"]) || empty($_POST["returnminute"]) || $_POST["returnminute"]<0){
            return danger("you must chose pickup minute for return ride");
        }
        $minute = user_input($_POST["returnminute"]);

        $ride_time = $date." ".$hour.":".$minute.":00";

        if(!self::checkIsAValidDate($ride_time)){
            return danger("invalid date or time format for return ride");
        }

        $currentDateTime = date("Y-m-d h:i").":00";
        $datetime = new DateTime($currentDateTime);
        $datetime->modify('+6 hour');
        $checkDateTime = $datetime->format('Y-m-d h:i').":00";;

        if($currentDateTime>$ride_time){
            return danger("You can't order ride in the past for return ride");
        }

        if($checkDateTime>$ride_time){
            return danger("You can't order ride for less than 6 hours in future for return ride");
        }

        //PICKUP ADDRESS
        //location
        if(!isset($_POST["returnlocation"]) || empty($_POST["returnlocation"]) || $_POST["returnlocation"]==0 || !is_numeric($_POST["returnlocation"])){
            return danger("you must chose location for return ride");
        }

        //postcode
        if(!isset($_POST["returnpostcode"]) || empty($_POST["returnpostcode"]) || $_POST["returnpostcode"]==0 || !is_numeric($_POST["returnpostcode"])){
            return danger("you must chose postcode for return ride");
        }

        //street
        if(!isset($_POST["returnstreet"]) || empty($_POST["returnstreet"]) || $_POST["returnstreet"]==0 || !is_numeric($_POST["returnstreet"])){
            return danger("you must chose street for return ride");
        }

        //house number
        if(!isset($_POST["returnnumber"])){
            return danger("you must chose house number for return ride");
        }

        $house_number = user_input($_POST["returnnumber"]);
        if(empty($house_number)){
            return danger("you must chose house number for return ride");
        }

        //ADDITIONAL ADDRESS 1
        if(isset($_POST["returnadditional_address"])){
            //location
            if(!isset($_POST["returnlocationAditional"]) || empty($_POST["returnlocationAditional"]) || $_POST["returnlocationAditional"]==0 || !is_numeric($_POST["returnlocationAditional"])){
                return danger("you must chose location for additional address for return ride");
            }

            //postcode
            if(!isset($_POST["returnpostcodeAditional"]) || empty($_POST["returnpostcodeAditional"]) || $_POST["returnpostcodeAditional"]==0 || !is_numeric($_POST["returnpostcodeAditional"])){
                return danger("you must chose postcode for additional address for return ride");
            }

            //street
            if(!isset($_POST["returnstreetAditional"]) || empty($_POST["returnstreetAditional"]) || $_POST["returnstreetAditional"]==0 || !is_numeric($_POST["returnstreetAditional"])){
                return danger("you must chose street for additional address for return ride");
            }

            //house number
            if(!isset($_POST["returnstreetAditional"])){
                return danger("you must chose house number for additional address for return ride");
            }

            $house_number = user_input($_POST["returnstreetAditional"]);
            if(empty($house_number)){
                return danger("you must chose house number for additional address for return ride");
            }
        }

        //OPTIONS
        if(!isset($_POST["returnpeople"])){
            return danger("you must have number of people for return ride");
        }

        $number_people = user_input($_POST["returnpeople"]);
        if(empty($number_people) || !is_numeric($number_people)){
            return danger("you must have number of people for return ride");
        }

        if($number_people<1 || $number_people>8){
            return danger("something is wrong here(for return ride)");
        }

        if(!isset($_POST["returnsuitcases"])){
            return danger("you must have number of suitcases for return ride");
        }

        $number_suitcases = user_input($_POST["returnsuitcases"]);
        if((empty($number_suitcases) && $number_suitcases!=="0") || !is_numeric($number_suitcases)){
            return danger("you must have number of suitcases for return ride");
        }

        if($number_suitcases<0 || $number_suitcases>8){
            return danger("something is wrong here(for return ride)");
        }

        if(!isset($_POST["returnchildSeat"])){
            return danger("you must have number of child seats for return ride");
        }

        $number_childSeat = user_input($_POST["returnchildSeat"]);
        if((empty($number_childSeat) && $number_childSeat!=="0") || !is_numeric($number_childSeat)){
            return danger("you must have number of child seats for return ride");
        }

        if($number_childSeat<0 || $number_childSeat>3){
            return danger("something is wrong here(for return ride)");
        }

        return true;
    }

    public static function addNewRide(){
        //from/to
        if(!isset($_POST["from_to"])){
            return danger("unknown direction");
        }

        $from_to = user_input($_POST["from_to"]);
        if($from_to!=="from" && $from_to!=="to"){
            return danger("unknown direction");
        }

        //ride date and time
        if(!isset($_POST["date"])){
            return danger("you must chose pickup date");
        }

        $date = user_input($_POST["date"]);

        if(!self::checkIsAValidDate($date) || empty($date)){
            return danger("invalid date format");
        }

        if(!isset($_POST["hour"]) || empty($_POST["hour"]) || $_POST["hour"]<0){
            return danger("you must chose pickup hour");
        }
        $hour = user_input($_POST["hour"]);

        if(!isset($_POST["minute"]) || empty($_POST["minute"]) || $_POST["minute"]<0){
            return danger("you must chose pickup minute");
        }
        $minute = user_input($_POST["minute"]);

        $ride_time = $date." ".$hour.":".$minute.":00";

        if(!self::checkIsAValidDate($ride_time)){
            return danger("invalid date or time format");
        }

        $currentDateTime = date("Y-m-d h:i").":00";
        $datetime = new DateTime($currentDateTime);
        $datetime->modify('+6 hour');
        $checkDateTime = $datetime->format('Y-m-d h:i').":00";;

        if($currentDateTime>$ride_time){
            return danger("You can't order ride in the past");
        }

        if($checkDateTime>$ride_time){
            return danger("You can't order ride for less than 6 hours in future");
        }

        //PICKUP ADDRESS
        //location
        if(!isset($_POST["location"]) || empty($_POST["location"]) || $_POST["location"]==0 || !is_numeric($_POST["location"])){
            return danger("you must chose location");
        }

        //postcode
        if(!isset($_POST["postcode"]) || empty($_POST["postcode"]) || $_POST["postcode"]==0 || !is_numeric($_POST["postcode"])){
            return danger("you must chose postcode");
        }

        //street
        if(!isset($_POST["street"]) || empty($_POST["street"]) || $_POST["street"]==0 || !is_numeric($_POST["street"])){
            return danger("you must chose street");
        }

        //house number
        if(!isset($_POST["number"])){
            return danger("you must chose house number");
        }

        $house_number = user_input($_POST["number"]);
        if(empty($house_number)){
            return danger("you must chose house number");
        }

        //ADDITIONAL ADDRESS 1
        if(isset($_POST["additional_address"])){
            //location
            if(!isset($_POST["locationAditional"]) || empty($_POST["locationAditional"]) || $_POST["locationAditional"]==0 || !is_numeric($_POST["locationAditional"])){
                return danger("you must chose location for additional address");
            }

            //postcode
            if(!isset($_POST["postcodeAditional"]) || empty($_POST["postcodeAditional"]) || $_POST["postcodeAditional"]==0 || !is_numeric($_POST["postcodeAditional"])){
                return danger("you must chose postcode for additional address");
            }

            //street
            if(!isset($_POST["streetAditional"]) || empty($_POST["streetAditional"]) || $_POST["streetAditional"]==0 || !is_numeric($_POST["streetAditional"])){
                return danger("you must chose street for additional address");
            }

            //house number
            if(!isset($_POST["numberAditional"])){
                return danger("you must chose house number for additional address");
            }

            $house_number = user_input($_POST["numberAditional"]);
            if(empty($house_number)){
                return danger("you must chose house number for additional address");
            }
        }

        //ADDITIONAL ADDRESS 2
        if(isset($_POST["additional_address2"])){
            //location
            if(!isset($_POST["locationAditional2"]) || empty($_POST["locationAditional2"]) || $_POST["locationAditional2"]==0 || !is_numeric($_POST["locationAditional2"])){
                return danger("you must chose location for second additional address");
            }

            //postcode
            if(!isset($_POST["postcodeAditional2"]) || empty($_POST["postcodeAditional2"]) || $_POST["postcodeAditional2"]==0 || !is_numeric($_POST["postcodeAditional2"])){
                return danger("you must chose postcode for second additional address");
            }

            //street
            if(!isset($_POST["streetAditional2"]) || empty($_POST["streetAditional2"]) || $_POST["streetAditional2"]==0 || !is_numeric($_POST["streetAditional2"])){
                return danger("you must chose street for second additional address");
            }

            //house number
            if(!isset($_POST["numberAditional2"])){
                return danger("you must chose house number for second additional address");
            }

            $house_number = user_input($_POST["numberAditional2"]);
            if(empty($house_number)){
                return danger("you must chose house number for second additional address");
            }
        }

        //contact
        if(!isset($_POST["name"])){
            return danger("you must enter name");
        }

        $name = user_input($_POST["name"]);

        if(empty($name)){
            return danger("you must enter name");
        }

        if(strlen($name)<2 || strlen($name)>30){
            return danger("name not proper size");
        }

        if(!isset($_POST["email"])){
            return danger("you must enter email");
        }

        $email = user_input($_POST["email"]);

        if(empty($email)){
            return danger("you must enter email");
        }

        if(strlen($email)<2 || strlen($email)>70){
            return danger("name not proper size");
        }

        if(!isset($_POST["mobile"])){
            return danger("you must enter mobile phone");
        }

        $mobile = user_input($_POST["mobile"]);

        if(empty($mobile)){
            return danger("you must enter mobile");
        }

        if(strlen($mobile)<2 || strlen($mobile)>30){
            return danger("mobile not proper size");
        }

        //OPTIONS
        if(!isset($_POST["people"])){
            return danger("you must have number of people");
        }

        $number_people = user_input($_POST["people"]);
        if(empty($number_people) || !is_numeric($number_people)){
            return danger("you must have number of people");
        }

        if($number_people<1 || $number_people>8){
            return danger("something is wrong here");
        }

        if(!isset($_POST["suitcases"])){
            return danger("you must have number of suitcases");
        }

        $number_suitcases = user_input($_POST["suitcases"]);
        if((empty($number_suitcases) && $number_suitcases!=="0") || !is_numeric($number_suitcases)){
            return danger("you must have number of suitcases");
        }

        if($number_suitcases<0 || $number_suitcases>8){
            return danger("something is wrong here");
        }

        if(!isset($_POST["childSeat"])){
            return danger("you must have number of child seats");
        }

        $number_childSeat = user_input($_POST["childSeat"]);
        if((empty($number_childSeat) && $number_childSeat!=="0") || !is_numeric($number_childSeat)){
            return danger("you must have number of child seats");
        }

        if($number_childSeat<0 || $number_childSeat>3){
            return danger("something is wrong here");
        }

        if(!isset($_POST["payment"])){
            return danger("somehow payment type is missing");
        }

        $payment = user_input($_POST["payment"]);
        if($payment!=="cash" && $payment!=="card"){
            return danger("How in the hell is possible that you have managed for payment to select something else than card or cash");
        }

        if(isset($_POST["returnride"])){
            return self::addReturnRide();
        }else{
            return true;
        }
    }

    public static function changeAdminPassword(){
        //password
        if(!isset($_POST["password"])){
            return danger("password is required");
        }

        $password = user_input($_POST["password"]);
        if(empty($password)){
            return danger("password is required");
        }

        if(strlen($password)<8 || strlen($password)>20){
            return danger("password must be between 8 and 20 characters long");
        }

        //confirmation
        if(!isset($_POST["confirm"])){
            return danger("conformation password is required");
        }

        $confirm = user_input($_POST["confirm"]);
        if(empty($confirm)){
            return danger("conformation password is required");
        }

        if($password!==$confirm){
            return danger("password and confirmation do not match");
        }

        return true;
    }

    public static function changeAdminInfo(){
        //name
        if(!isset($_POST["name"])){
            return danger("name is required");
        }

        $name = user_input($_POST["name"]);
        if(empty($name)){
            return danger("name is required");
        }

        if(strlen($name)<2 || strlen($name)>20){
            return danger("name must be between 2 and 20 characters long");
        }

        //last name
        if(!isset($_POST["lname"])){
            return danger("last name is required");
        }

        $lname = user_input($_POST["lname"]);
        if(empty($lname)){
            return danger("last name is required");
        }

        if(strlen($lname)<2 || strlen($lname)>20){
            return danger("last name must be between 2 and 20 characters long");
        }

        //phone
        if(!isset($_POST["phone"])){
            return danger("mobile number is required");
        }

        $phone = user_input($_POST["phone"]);
        if(empty($phone)){
            return danger("mobile number is required");
        }

        if(strlen($phone)<5 || strlen($phone)>20){
            return danger("mobile number must be between 5 and 20 characters long");
        }

        return true;
    }

    public static function addAdmin(){
        //username
        if(!isset($_POST["username"])){
            return danger("username is required");
        }

        $username = user_input($_POST["username"]);
        if(empty($username)){
            return danger("username is required");
        }

        if(strlen($username)<3 || strlen($username)>20){
            return danger("username must be between 3 and 20 characters long");
        }

        if(Admin::usernameTaken($username)===true){
            return danger("username is taken");
        }

        //name
        if(!isset($_POST["name"])){
            return danger("name is required");
        }

        $name = user_input($_POST["name"]);
        if(empty($name)){
            return danger("name is required");
        }

        if(strlen($name)<2 || strlen($name)>20){
            return danger("name must be between 2 and 20 characters long");
        }

        //last name
        if(!isset($_POST["lname"])){
            return danger("last name is required");
        }

        $lname = user_input($_POST["lname"]);
        if(empty($lname)){
            return danger("last name is required");
        }

        if(strlen($lname)<2 || strlen($lname)>20){
            return danger("last name must be between 2 and 20 characters long");
        }

        //email
        if(!isset($_POST["email"])){
            return danger("email is required");
        }

        $email = user_input($_POST["email"]);
        if(empty($email)){
            return danger("email is required");
        }

        if(strlen($email)<3 || strlen($email)>70){
            return danger("email must be between 3 and 70 characters long");
        }

        if(Admin::emailTaken($email)===true){
            return danger("email is taken");
        }

        //phone
        if(!isset($_POST["phone"])){
            return danger("mobile number is required");
        }

        $phone = user_input($_POST["phone"]);
        if(empty($phone)){
            return danger("mobile number is required");
        }

        if(strlen($phone)<5 || strlen($phone)>20){
            return danger("mobile number must be between 5 and 20 characters long");
        }

        //password
        if(!isset($_POST["password"])){
            return danger("password is required");
        }

        $password = user_input($_POST["password"]);
        if(empty($password)){
            return danger("password is required");
        }

        if(strlen($password)<8 || strlen($password)>20){
            return danger("password must be between 8 and 20 characters long");
        }

        //confirmation
        if(!isset($_POST["confirm"])){
            return danger("conformation password is required");
        }

        $confirm = user_input($_POST["confirm"]);
        if(empty($confirm)){
            return danger("conformation password is required");
        }

        if($password!==$confirm){
            return danger("password and confirmation do not match");
        }

        return true;
    }

    public static function changeDriverPassword(){
        //password
        if(!isset($_POST["password"])){
            return danger("password is required");
        }

        $password = user_input($_POST["password"]);
        if(empty($password)){
            return danger("password is required");
        }

        if(strlen($password)<8 || strlen($password)>20){
            return danger("password must be between 8 and 20 characters long");
        }

        //confirmation
        if(!isset($_POST["confirm"])){
            return danger("conformation password is required");
        }

        $confirm = user_input($_POST["confirm"]);
        if(empty($confirm)){
            return danger("conformation password is required");
        }

        if($password!==$confirm){
            return danger("password and confirmation do not match");
        }

        return true;
    }

    public static function changeDriverInfo(){
        //name
        if(!isset($_POST["name"])){
            return danger("name is required");
        }

        $name = user_input($_POST["name"]);
        if(empty($name)){
            return danger("name is required");
        }

        if(strlen($name)<2 || strlen($name)>20){
            return danger("name must be between 2 and 20 characters long");
        }

        //last name
        if(!isset($_POST["lname"])){
            return danger("last name is required");
        }

        $lname = user_input($_POST["lname"]);
        if(empty($lname)){
            return danger("last name is required");
        }

        if(strlen($lname)<2 || strlen($lname)>20){
            return danger("last name must be between 2 and 20 characters long");
        }

        //phone
        if(!isset($_POST["phone"])){
            return danger("mobile number is required");
        }

        $phone = user_input($_POST["phone"]);
        if(empty($phone)){
            return danger("mobile number is required");
        }

        if(strlen($phone)<5 || strlen($phone)>20){
            return danger("mobile number must be between 5 and 20 characters long");
        }

        return true;
    }

    public static function addCity(){
        //username
        if(!isset($_POST["city_name"])){
            return danger("city name is required");
        }

        $city_name = user_input($_POST["city_name"]);
        if(empty($city_name)){
            return danger("city name is required");
        }

        if(strlen($city_name)<2 || strlen($city_name)>20){
            return danger("city name must be between 2 and 20 characters long");
        }

        if(City::cityNameExist($city_name)===true){
            return danger("city name already exist");
        }

        return true;
    }

    public static function addStreet(){
        //username
        if(!isset($_POST["street_name"])){
            return danger("street name is required");
        }

        $street_name = user_input($_POST["street_name"]);
        if(empty($street_name)){
            return danger("street name is required");
        }

        if(strlen($street_name)<2 || strlen($street_name)>20){
            return danger("street name must be between 2 and 20 characters long");
        }

        if(Street::streetNameExist($street_name)===true){
            return danger("street name already exist");
        }

        return true;
    }

    public static function addDistrict(){
        //name
        if(!isset($_POST["name"])){
            return danger("District name is required");
        }

        $district_name = user_input($_POST["name"]);
        if(empty($district_name)){
            return danger("District name is required");
        }

        if(strlen($district_name)<2 || strlen($district_name)>20){
            return danger("District name must be between 2 and 20 characters long");
        }

        if(District::districtNameExist($district_name)===true){
            return danger("District name already exist");
        }

        //limo
        if(!isset($_POST["limo"])){
            return danger("limo price is required");
        }

        $limo = user_input($_POST["limo"]);
        if(empty($limo)){
            return danger("limo price is required");
        }

        if(!is_numeric($limo)){
            return danger("limo price is broken");
        }

        if($limo<0){
            return danger("cant set negative number as price");
        }

        //kombi
        if(!isset($_POST["kombi"])){
            return danger("kombi price is required");
        }

        $kombi = user_input($_POST["kombi"]);
        if(empty($kombi)){
            return danger("kombi price is required");
        }

        if(!is_numeric($kombi)){
            return danger("kombi price is broken");
        }

        if($kombi<0){
            return danger("cant set negative number as price");
        }

        //van
        if(!isset($_POST["van"])){
            $van = user_input($_POST["van"]);
            if(!empty($van)){
                if(!is_numeric($van)){
                    return danger("van price is broken");
                }

                if($van<0){
                    return danger("cant set negative number as price");
                }
            }
        }

        //autobus
        if(!isset($_POST["autobus"])){
            $autobus = user_input($_POST["autobus"]);
            if(!empty($autobus)){
                if(!is_numeric($autobus)){
                    return danger("autobus price is broken");
                }

                if($autobus<0){
                    return danger("cant set negative number as price");
                }
            }
        }

        return true;
    }

    public static function addDriver(){
        //username
        if(!isset($_POST["username"])){
            return danger("username is required");
        }

        $username = user_input($_POST["username"]);
        if(empty($username)){
            return danger("username is required");
        }

        if(strlen($username)<3 || strlen($username)>20){
            return danger("username must be between 3 and 20 characters long");
        }

        if(Driver::usernameTaken($username)===true){
            return danger("username is taken");
        }

        //name
        if(!isset($_POST["name"])){
            return danger("name is required");
        }

        $name = user_input($_POST["name"]);
        if(empty($name)){
            return danger("name is required");
        }

        if(strlen($name)<2 || strlen($name)>20){
            return danger("name must be between 2 and 20 characters long");
        }

        //last name
        if(!isset($_POST["lname"])){
            return danger("last name is required");
        }

        $lname = user_input($_POST["lname"]);
        if(empty($lname)){
            return danger("last name is required");
        }

        if(strlen($lname)<2 || strlen($lname)>20){
            return danger("last name must be between 2 and 20 characters long");
        }

        //email
        if(!isset($_POST["email"])){
            return danger("email is required");
        }

        $email = user_input($_POST["email"]);
        if(empty($email)){
            return danger("email is required");
        }

        if(strlen($email)<3 || strlen($email)>70){
            return danger("email must be between 3 and 70 characters long");
        }

        if(Driver::emailTaken($email)===true){
            return danger("email is taken");
        }

        //phone
        if(!isset($_POST["phone"])){
            return danger("mobile number is required");
        }

        $phone = user_input($_POST["phone"]);
        if(empty($phone)){
            return danger("mobile number is required");
        }

        if(strlen($phone)<5 || strlen($phone)>20){
            return danger("mobile number must be between 5 and 20 characters long");
        }

        //password
        if(!isset($_POST["password"])){
            return danger("password is required");
        }

        $password = user_input($_POST["password"]);
        if(empty($password)){
            return danger("password is required");
        }

        if(strlen($password)<8 || strlen($password)>20){
            return danger("password must be between 8 and 20 characters long");
        }

        //confirmation
        if(!isset($_POST["confirm"])){
            return danger("conformation password is required");
        }

        $confirm = user_input($_POST["confirm"]);
        if(empty($confirm)){
            return danger("conformation password is required");
        }

        if($password!==$confirm){
            return danger("password and confirmation do not match");
        }

        return true;
    }
}