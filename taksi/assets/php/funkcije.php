<?php
date_default_timezone_set("Europe/Belgrade");

ini_set('session.cookie_httponly', 1);  //The 'httpOnly' flag
session_name('__Secure-PHPSESSID'); //cookies that have the __Secure- prefix:
session_start(['cookie_lifetime' => 43200, 'cookie_secure' => true, 'cookie_httponly' => true, 'cookie_samesite' => "Strict"]); //session

include_once("classes/load.php");
include_once("errors.php");
include_once("headers.php");
include_once("templates/templates.php");

$db_servername= "localhost";
$db_username = "root";
$db_password = "";
$db_database = "airport_taxi_2";

if(true){
    $db_servername = "localhost";
    $db_username = "devnoobsrs_nemanjart10416";
    $db_password = "XULPWrXrY7p95jQ";
    $db_database = "devnoobsrs_airport_taxi_2";
    /*
     * database: u225122db1
     * username: u225122db1
     * password: .ho9cijj0hoe
     *
     * */
}

function konekcija_prepared(){
    global $db_username, $db_password, $db_servername, $db_database;

    $dbh = new PDO('mysql:host='.$db_servername.';dbname='.$db_database.";charset=utf8mb4", $db_username, $db_password);
    /**
     * Use PDO::ERRMODE_EXCEPTION, to capture errors and write them to
     * a log file for later inspection instead of printing them to the screen.
     */
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $dbh;
}

function konekcija(){
    global $db_username, $db_password, $db_servername, $db_database;

    // Create connection
    $conn = new mysqli($db_servername, $db_username, $db_password, $db_database);
    $conn->set_charset("utf8");
    // Check connection
    if ($conn->connect_error) {
        //die("Connection failed: " . $conn->connect_error);
        die("Error 173");
    }


    return $conn;
}

function error_login($err){
    //check if error_logs table exist
    $konekcija = konekcija();
    $val = $konekcija->query("SELECT * FROM error_logs");
    if($val===false){
        set("
            CREATE TABLE error_logs(
                error_logs_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                error_logs_date TIMESTAMP NOT NULL,
                error_logs_message VARCHAR(600) NOT NULL
            )
        ");
    }

    try{
        $konekcija_prepared = konekcija_prepared();
        $query = "INSERT INTO error_logs (error_logs_id,error_logs_date,error_logs_message) VALUES (NULL,:err_date,:message)";
        $sth = $konekcija_prepared->prepare($query);
        $date = date("Y/m/d h:i:sa");
        $sth->bindParam(':err_date', $date);
        $sth->bindParam(':message', $err);
        $sth->execute();
    }catch(PDOException $e){}
}

function get($sql){
    $conn = konekcija();
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

function set($sql){
    $conn = konekcija();
    $ans = $conn->query($sql);
    $conn->close();

    return $ans;
}

function sanitise($string) {
    //preg_replace('/[^a-zA-Z0-9]+/', '', $text)
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

function user_input($data) {
    $data = trim($data);
    $data = strip_tags($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    //NULL byte %00
    $data = str_replace(chr(0), '', $data);
    $data = str_replace("%00", "", $data);
    $data = str_replace("%0", "", $data);
    $data = str_replace("\0", "", $data);

    return $data;
}

function make_email_headers(){
    $headers = array();
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/html; charset=ISO/IEC 8859-15";
    $headers[] = "From:  <office@devnoobs.rs>";
    $headers[] = "Reply-To: <office@devnoobs.rs>";
    $headers[] = "Return-Path: <office@devnoobs.rs>";
    $headers[] = "CC: office@devnoobs.rs";
    $headers[] = "BCC: office@devnoobs.rs";
    $headers[] = "X-MSMail-Priority: High";
    $headers[] = "Organization: airporttransfer-wien";
    $headers[] = "X-Mailer: PHP/" . phpversion();

    return $headers;
}

function generate_csrf_token(){
    return md5(uniqid(mt_rand(), true));
}

function get_csrf_token(){
    return $_SESSION["token"];
}

function check_current($curr){
    $page = ucfirst(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME));
    $page = strtolower($page);

    if($page==$curr){
        echo "active";
    }
}

function success($txt){
    return '<div class="alert alert-success alert-dismissible fade show" role="alert">
              '.$txt.'
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
}

function danger($txt){
    return '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              '.$txt.'
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
}

function nazad($s){
    return $s." <a href='javascript:history.back()'>nazad</a>";
}

function send_mail($subject,$name,$email,$message){
    $to = "devnoobs404@gmail.com";

    $message = "<b>".wordwrap($message,70)."</b>";

    $header = "<From:office@devnoobs.rs> \r\n";
    $header .= "<Cc:office@devnoobs.rs> \r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";

    $retval = mail ($to,$subject,$message,$header);

    if( $retval == true ) {
        return false;
    }else {
        return false;
    }
}

function send_mail_driver($subject,$name,$email,$message){

    $message = "<b>".wordwrap($message,70)."</b>";

    $header = "<From:office@devnoobs.rs> \r\n";
    $header .= "<Cc:office@devnoobs.rs> \r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";

    $retval = mail ($email,$subject,$message,$header);

    if( $retval == true ) {
        return false;
    }else {
        return false;
    }
}

function send_mail_to_customer($subject,$name,$email,$message){
    $message = "<b>".wordwrap($message,70)."</b>";

    $headers = make_email_headers();

    //$retval = mail ($email,$subject,$message,$header);
    $retval = mail($email, $subject, $message, implode("\r\n", $headers));

    if( $retval == true ) {
        return false;
    }else {
        return false;
    }
}

function send_mail_admin($subject,$name,$email,$message){
    $to = "devnoobs404@gmail.com"; //admin email
    $headers = make_email_headers();

    $message = "<b>".wordwrap($message,70)."</b>";

    //$retval = mail ($to,$subject,$message,$headers);

    $retval = mail($to, date("Y/m/d"), $message, implode("\r\n", $headers));

    if( $retval == true ) {
        return false;
    }else {
        return false;
    }
}

function add_new_ride2(){
    $enviroment = new Enviroment();

    //user data
    $name = user_input($_POST["name"]);
    $email = user_input($_POST["email"]);
    $mobile = user_input($_POST["mobile"]);

    //address
    $address = user_input($_POST["address"]);

    //comment
    $comment = user_input($_POST["comment"]);

    //ride date and time
    if(isset($_POST["instant_ride"])){
        $currentDate = date("Y-m-d"); // Get current date in 'YYYY-MM-DD' format
        $currentHour = date("H");      // Get current hour in 24-hour format
        $currentMinute = date("i");    // Get current minute
        $ride_time = $currentDate . " " . $currentHour . ":" . $currentMinute . ":00";
        $current_ride = true;
    }else{
        $date = user_input($_POST["date"]);
        $hour = user_input($_POST["hour"]);
        $minute = user_input($_POST["minute"]);
        $ride_time = $date." ".$hour.":".$minute.":00";
        $current_ride = false;
    }


    $ans = Ride2::add($name, $email, $mobile, $ride_time, $address, $comment, $current_ride);

    if($ans==true){
        return success("ordered successfuly");
    }else{
        return $ans;
    }
}

function add_new_ride(){
    $enviroment = new Enviroment();

    //Primary ride
    $return_ride=NULL;
    $status = "new_ride";

    //from/to
    $from_to = user_input($_POST["from_to"]);
    $price = 0;

    if($from_to=="to"){
        $flight_number = NULL;
    }else{
        $flight_number = NULL;
    }

    var_dump("ovde");

    //data for ride
    $date = user_input($_POST["date"]);
    $hour = user_input($_POST["hour"]);
    $minute = user_input($_POST["minute"]);

    //if ride between 22 and o4 +5 eur
    /*
    if($hour=="22" || $hour=="23" || $hour=="00" || $hour=="01" || $hour=="02" || $hour=="03"){
        $price += 5;
    }*/

    $ride_time = $date." ".$hour.":".$minute.":00";

    $address_full = user_input($_POST["number"]);

    //for email

    $name = user_input($_POST["name"]);
    $email = user_input($_POST["email"]);
    $mobile = user_input($_POST["mobile"]);

    $num_suitcases = user_input($_POST["suitcases"]);

    //child seats

    $comment = user_input($_POST["comment"]);

    $ans = Ride::add(
        $name,$email,$mobile,$from_to,0,$num_suitcases,0,0,0,0,$address_full,
        "",$price,$ride_time,$comment,0,0, $return_ride, $status, 0, 0, $flight_number
    );



    if($ans){
        $ans = success("Ride request sent successfuly");
    }

    //return ride not checked finish here
    $time = $hour.":".$minute;

    $custommer_message = ride_confirm_customer_en($name,$date,$time,$address_full,"","",$mobile,
        $email,0,0,"",$num_suitcases,$comment,
        $price,"no");
    send_mail_to_customer("ride confirmation, Airport taxi wien",$name,$email,$custommer_message);

    $admin_message = ride_confirm_admin_en($name,$date,$time,$address_full,"","",$mobile,
        $email,0,0,"",$num_suitcases,$comment,
        $price,"no");
    send_mail_admin("new ride, Airport taxi wien",$name,$email,$admin_message);

    return $ans;
}

function get_car_type($number_of_people){
    if($number_of_people<=3){
        return "limo";
    }

    if($number_of_people>3 && $number_of_people<=5){
        return "kombi";
    }

    if($number_of_people>5 && $number_of_people<8){
        return "van";
    }
}


?>