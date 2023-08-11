<?php

class Ride
{
    private $id;

    //when booking must
    private $name;
    private $email;
    private $mobile;
    private $from_to;
    private $number_of_people;
    private $number_of_suitcases;
    private $status; //new_ride, failed, success, deleted
    private $streets_id;
    private $street_number;
    private $payment;
    private $price;
    private $ride_time;

    //decija sedista novo
    private $number_of_baby_seats; // Babyschale
    private $number_of_child_seats; //Kindersitz
    private $number_of_raised_seats; // Kindersitzerhöhung

    /*
     * Kindersitzerhöhung {pomocno sediste}
     * Kindersitz [Kindersitz ab 12 Monate] {Child seat from 12 months}
     * Babyschale [Babyschale (MaxiCosi) bis 12 Monate] {Baby seat (MaxiCosi) up to 12 months}
     * */

    //when booking optional
    private $comment;
    private $driver_id;
    private $admin_id;
    private $return_ride;
    private $additional_address_1;
    private $additional_address_2;
    private $additional_address_1_street_number;
    private $additional_address_2_street_number;
    private $flight_number;

    //when booking auto fill
    private $booked_time;

    public function __construct(
        $id, $name, $email, $mobile, $from_to, $number_of_people, $number_of_suitcases, $number_of_child_seats,
        $status, $streets_id, $street_number, $payment, $price, $ride_time, $comment, $driver_id, $admin_id, $return_ride,
        $additional_address_1, $additional_address_2, $booked_time,$additional_address_1_street_number,$additional_address_2_street_number,
        $flight_number=NULL)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->mobile = $mobile;
        $this->from_to = $from_to;
        $this->number_of_people = $number_of_people;
        $this->number_of_suitcases = $number_of_suitcases;
        $this->number_of_child_seats = $number_of_child_seats;
        $this->status = $status;
        $this->streets_id = $streets_id;
        $this->street_number = $street_number;
        $this->payment = $payment;
        $this->price = $price;
        $this->ride_time = $ride_time;
        $this->comment = $comment;
        $this->driver_id = $driver_id;
        $this->admin_id = $admin_id;
        $this->return_ride = $return_ride;
        $this->additional_address_1 = $additional_address_1;
        $this->additional_address_2 = $additional_address_2;
        $this->booked_time = $booked_time;
        $this->additional_address_1_street_number = $additional_address_1_street_number;
        $this->additional_address_2_street_number = $additional_address_2_street_number;
        $this->flight_number = $flight_number;
    }


    public static function add(
        $name, $email, $mobile, $from_to, $number_of_people, $number_of_suitcases, $number_of_baby_seats, $number_of_child_seats ,$number_of_raised_seats,
        $streets_id, $street_number, $payment, $price, $ride_time, $comment, $additional_address_1, $additional_address_2, $return_ride = NULL,
        $status = "new_ride",$aa1_number=NULL,$aa2_number=NULL,$flight_number=NULL
    )
    {

        try {
            $konekcija = konekcija_prepared();
            $query = "
                INSERT INTO rides(
                    id, name, email, comment, from_to, number_people, number_suitcases, number_child_seats, status, streets_id, 
                    street_number, payment,price,mobile, ride_time, aa1, aa2, return_ride, aa1_number, aa2_number, flight_number, 
                    number_baby_seats, number_raised_seats        
                ) 
                
                VALUES(
                    NULL, :name, :email, :comment, :from_to, :number_people, :number_suitcases, :number_child_seats, :status, :streets_id, 
                    :street_number, :payment, :price, :mobile, :ride_time, :aa1, :aa2, :return_ride, :aa1_number, :aa2_number, :flight_number, 
                    :number_baby_seats, :number_raised_seats   
                )";
            $sth = $konekcija->prepare($query);

            $sth->bindParam(':name', $name);
            $sth->bindParam(':email', $email);
            $sth->bindParam(':comment', $comment);
            $sth->bindParam(':from_to', $from_to);
            $sth->bindParam(':number_people', $number_of_people);
            $sth->bindParam(':number_suitcases', $number_of_suitcases);
            $sth->bindParam(':number_child_seats', $number_of_child_seats);
            $sth->bindParam(':status', $status);
            $sth->bindParam(':streets_id', $streets_id);
            $sth->bindParam(':street_number', $street_number);
            $sth->bindParam(':payment', $payment);
            $sth->bindParam(':price', $price);
            $sth->bindParam(':number_baby_seats', $number_of_baby_seats);
            $sth->bindParam(':number_raised_seats', $number_of_raised_seats);
            $sth->bindParam(':mobile', $mobile);
            $sth->bindParam(':ride_time', $ride_time);
            $sth->bindParam(':aa1', $additional_address_1);
            $sth->bindParam(':aa2', $additional_address_2);
            $sth->bindParam(':return_ride', $return_ride);
            $sth->bindParam(':aa1_number', $aa1_number);
            $sth->bindParam(':aa2_number', $aa2_number);
            $sth->bindParam(':flight_number', $flight_number);

            $ans = $sth->execute();

            if ($ans) {
                return true;
            } else {
                return danger("error has occured");
            }

        } catch (PDOException $e) {
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return danger('Error establishing connection with database');
        }
    }

    public function countdown(){
        $now = date("Y-m-d");

        $datetime1 = new DateTime($now);
        $datetime2 = new DateTime($this->ride_time);
        $difference = $datetime1->diff($datetime2);

        if($datetime1>$datetime2){
            $count = "<span class='bg-primary text-dark p-1'><span class='en'>PASSED BY:</span>
                                                    <span class='sr'>PROSLO ZA:</span>
                                                    <span class='de'>VORBEIGEHEN: </span> ".$difference->d." <span class='en'>days</span>
                                                    <span class='sr'>dana</span>
                                                    <span class='de'>Tage </span></span>";
        }else{
            $count = "<span class='bg-success text-dark p-1'>".$difference->d." <span class='en'>days</span>
                                                    <span class='sr'>dana</span>
                                                    <span class='de'>Tage </span></span>";
        }



        return $count;
    }

    public static function assignDriver($driver_id,$ride_id){
        try{
            $konekcija = konekcija_prepared();
            $query = "UPDATE rides SET status='assigned',driver_id=:driver_id WHERE id=:ride_id";
            $sth = $konekcija->prepare($query);
            $sth->bindParam(':driver_id', $driver_id);
            $sth->bindParam(':ride_id', $ride_id);

            $ans = $sth->execute();

            if($ans){
                $driver = Driver::getById($driver_id);
                send_mail_driver("New rides",$driver->getName(),$driver->getEmail(),
                    "you have new rides assigned, you should check your driver page ".date("Y-m-d")." ".date("h:i:sa")
                );
                return success("Ride assigned successfuly");
            }else {
                return danger("error has occured");
            }

        }catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return danger('Error establishing connection with database');
        }
    }

    public static function unasign($ride_id){
        try{
            $konekcija = konekcija_prepared();
            $query = "UPDATE rides SET status='new_ride',driver_id=NULL WHERE id=:ride_id";
            $sth = $konekcija->prepare($query);
            $sth->bindParam(':ride_id', $ride_id);

            $ans = $sth->execute();

            if($ans){
                return success("Driver removed successfuly");
            }else {
                return danger("error has occured");
            }

        }catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return danger('Error establishing connection with database');
        }
    }

    public static function decline($ride_id,$driver_id){
        try{
            $konekcija = konekcija_prepared();
            $query = "UPDATE rides SET status='new_ride',driver_id=NULL WHERE id=:ride_id AND driver_id=:driver_id";
            $sth = $konekcija->prepare($query);
            $sth->bindParam(':ride_id', $ride_id);
            $sth->bindParam(':driver_id', $driver_id);

            $ans = $sth->execute();

            if($ans){
                $driver = Driver::getById($driver_id);
                /*
                 * send_mail_driver("New rides",$driver->getName(),$driver->getEmail(),
                    "you have new rides assigned, you should check your driver page ".date("Y-m-d")." ".date("h:i:sa")
                );
                 */

                $sen = send_mail_admin("Assigned ride declined","administrator","admin",
                    "You have assigned rides declined, you should check admin panel, driver ".$driver->getUsername()."  has declined ride id: ".$ride_id." at ".date("Y-m-d")." ".date("h:i:sa")
                );
                return success("Ride declined successfully");
            }else {
                return danger("error has occured");
            }

        }catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return danger('Error establishing connection with database');
        }
    }

    public static function accept($ride_id,$driver_id){
        try{
            $konekcija = konekcija_prepared();
            $query = "UPDATE rides SET status='accepted' WHERE id=:ride_id AND driver_id=:driver_id";
            $sth = $konekcija->prepare($query);
            $sth->bindParam(':ride_id', $ride_id);
            $sth->bindParam(':driver_id', $driver_id);

            $ans = $sth->execute();

            if($ans){
                return success("Ride accepted");
            }else {
                return danger("error has occured");
            }

        }catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return danger('Error establishing connection with database');
        }
    }

    public static function search(){
        $rides = [];
        $konekcija = konekcija();
        $query = "SELECT * FROM rides WHERE rides.id>1";
        $s = 0;
        $parameters = [];

        //ride id
        $id = user_input($_POST["id"]);
        if(isset($id) && !empty($id) && is_numeric($id)){
            $parameters []= $id;
            $s++;
            $query .= " AND rides.id = ?";
        }

        //ride name
        $name= user_input($_POST["name"]);
        if(isset($name) && !empty($name) && strlen($name)>0){
            $param = "%$name%";
            $parameters []= $param;
            $s++;
            $query .= " AND rides.name LIKE ?";
        }

        //ride email
        $email= user_input($_POST["email"]);
        if(isset($email) && !empty($email) && strlen($email)>0){
            $param1 = "%$email%";
            $parameters []= $param1;
            $s++;
            $query .= " AND rides.email LIKE ?";
        }

        //ride mobile
        $phone= user_input($_POST["phone"]);
        if(isset($phone) && !empty($phone) && strlen($phone)>0){
            $param2 = "%$phone%";
            $parameters []= $param2;
            $s++;
            $query .= " AND rides.mobile LIKE ?";
        }

        //ride status
        $status= user_input($_POST["status"]);
        if(isset($status) && !empty($status) && strlen($status)>0){
            $parameters []= $status;
            $s++;
            $query .= " AND rides.status = ?";
        }

        //ride driver
        $driver_id= user_input($_POST["driver"]);
        if(isset($driver_id) && !empty($driver_id) && strlen($driver_id)>0){
            $parameters []= $driver_id;
            $s++;
            $query .= " AND rides.driver_id = ?";
        }

        //ride payment
        $payment= user_input($_POST["payment"]);
        if(isset($payment) && !empty($payment) && strlen($payment)>0){
            $parameters []= $payment;
            $s++;
            $query .= " AND rides.payment = ?";
        }

        //ride direction
        $direction= user_input($_POST["direction"]);
        if(isset($direction) && !empty($direction) && strlen($direction)>0){
            $parameters []= $direction;
            $s++;
            $query .= " AND rides.from_to = ?";
        }

        //ride mobile
        $address= user_input($_POST["address"]);
        if(isset($address) && !empty($address) && strlen($address)>0){
            $param3 = "%$address%";
            $parameters []= $param3;
            $s++;
            $query .= " AND rides.street_number LIKE ?";
        }

        //ride date ToDo
        if(isset($_POST["checkdate"])){
            $dateFrom = user_input($_POST["dateFrom"]);
            $dateTo = user_input($_POST["dateTo"]);

            if(isset($dateFrom) && !empty($dateFrom) && isset($dateTo) && !empty($dateTo)){
                //$ride_time = $date." ".$hour.":".$minute.":00";
                $dateFrom = date_format(date_create($dateFrom),"Y-m-d");
                $dateTo = date_format(date_create($dateTo),"Y-m-d");

                $parameters []= $dateFrom;
                $parameters []= $dateTo;
                $s+=2;
                //$query .= " AND rides.ride_time BETWEEN ? AND ?";
                $query .= " AND rides.ride_time > ? AND rides.ride_time < ?";
            }else if(isset($dateFrom) && !empty($dateFrom)){
                $dateFrom = date_format(date_create($dateFrom),"Y-m-d");
                $parameters []= $dateFrom;
                $s++;
                $query .= " AND rides.ride_time >= ?";
            }
        }

        if($s>0){
            $stmt = $konekcija->prepare($query);
            $stmt->bind_param(str_repeat("s",$s), ...$parameters);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()){
                $rides [] = new Ride(
                    $row["id"], $row["name"], $row["email"], $row["mobile"], $row["from_to"], $row["number_people"], $row["number_suitcases"],$row["number_child_seats"],
                    $row["status"],$row["streets_id"],$row["street_number"],$row["payment"],$row["price"],$row["ride_time"],$row["comment"],$row["driver_id"],$row["admin_id"],
                    $row["return_ride"],$row["aa1"],$row["aa2"],$row["booked_time"],$row["aa1_number"],$row["aa2_number"],$row["flight_number"]
                );
            }
        }

        return $rides;
    }

    public static function deleteForever($id){
        try{
            $konekcija = konekcija_prepared();
            $query = "DELETE FROM rides WHERE status IN ('deleted','success','failed') AND id=:id";
            $sth = $konekcija->prepare($query);
            $sth->bindParam(':id', $id);

            $ans = $sth->execute();

            if($ans){
                return success("Ride removed successfuly");
            }else {
                return danger("error has occured");
            }

        }catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return danger('Error establishing connection with database');
        }
    }

    public static function delete($id){
        try{
            $konekcija = konekcija_prepared();
            $query = "UPDATE rides SET status='deleted',driver_id=NULL WHERE id=:id";
            $sth = $konekcija->prepare($query);
            $sth->bindParam(':id', $id);

            $ans = $sth->execute();

            if($ans){
                return success("Ride deleted successfuly");
            }else {
                return danger("error has occured");
            }

        }catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return danger('Error establishing connection with database');
        }
    }

    public static function success($id){
        try{
            $konekcija = konekcija_prepared();
            $query = "UPDATE rides SET status='success' WHERE id=:id";
            $sth = $konekcija->prepare($query);
            $sth->bindParam(':id', $id);

            $ans = $sth->execute();

            if($ans){
                return success("Ride status changed successfuly");
            }else {
                return danger("error has occured");
            }

        }catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return danger('Error establishing connection with database');
        }
    }

    public static function successDriver($id,$driver_id){
        try{
            $konekcija = konekcija_prepared();
            $query = "UPDATE rides SET status='success' WHERE id=:id AND driver_id=:driver_id";
            $sth = $konekcija->prepare($query);
            $sth->bindParam(':id', $id);
            $sth->bindParam(':driver_id', $driver_id);

            $ans = $sth->execute();

            if($ans){
                return success("Ride status changed successfuly");
            }else {
                return danger("error has occured");
            }

        }catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return danger('Error establishing connection with database');
        }
    }

    public static function fail($id){
        try{
            $konekcija = konekcija_prepared();
            $query = "UPDATE rides SET status='failed' WHERE id=:id";
            $sth = $konekcija->prepare($query);
            $sth->bindParam(':id', $id);

            $ans = $sth->execute();

            if($ans){
                return success("Ride status changed successfuly");
            }else {
                return danger("error has occured");
            }

        }catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return danger('Error establishing connection with database');
        }
    }

    public static function failDriver($id,$driver_id){
        try{
            $konekcija = konekcija_prepared();
            $query = "UPDATE rides SET status='failed' WHERE id=:id AND driver_id=:driver_id";
            $sth = $konekcija->prepare($query);
            $sth->bindParam(':id', $id);
            $sth->bindParam(':driver_id', $driver_id);

            $ans = $sth->execute();

            if($ans){
                return success("Ride status changed successfuly");
            }else {
                return danger("error has occured");
            }

        }catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return danger('Error establishing connection with database');
        }
    }

    public static function restore($id){
        try{
            $konekcija = konekcija_prepared();
            $query = "UPDATE rides SET status='new_ride' WHERE id=:id";
            $sth = $konekcija->prepare($query);
            $sth->bindParam(':id', $id);

            $ans = $sth->execute();

            if($ans){
                return success("Ride restored successfuly");
            }else {
                return danger("error has occured");
            }

        }catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return danger('Error establishing connection with database');
        }
    }

    public static function getTodaySale(){
        $result = get("SELECT COALESCE(SUM(price),0) as total FROM rides WHERE status='success' AND CAST(ride_time AS DATE)=CAST(CURRENT_TIMESTAMP AS DATE)");
        return $result->fetch_assoc()["total"];
    }

    public static function getTodaySaleCount(){
        $result = get("SELECT COALESCE(COUNT(*),0) as total FROM rides WHERE status='success' AND CAST(ride_time AS DATE)=CAST(CURRENT_TIMESTAMP AS DATE)");
        return $result->fetch_assoc()["total"];
    }

    public static function getAllSale(){
        $result = get("SELECT COALESCE(SUM(price),0) as total FROM rides WHERE status='success'");
        return $result->fetch_assoc()["total"];
    }

    public static function getAllSaleCount(){
        $result = get("SELECT COALESCE(COUNT(*),0) as total FROM rides WHERE status='success'");
        return $result->fetch_assoc()["total"];
    }

    public static function getById($id){
        $conn = konekcija();
        $stmt = $conn->prepare("SELECT * FROM rides WHERE id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows === 0){
            return false;
        }

        $row = $result->fetch_assoc();

        return new Ride(
            $row["id"], $row["name"], $row["email"], $row["mobile"], $row["from_to"], $row["number_people"], $row["number_suitcases"],$row["number_child_seats"],
            $row["status"],$row["streets_id"],$row["street_number"],$row["payment"],$row["price"],$row["ride_time"],$row["comment"],$row["driver_id"],$row["admin_id"],
            $row["return_ride"],$row["aa1"],$row["aa2"],$row["booked_time"],$row["aa1_number"],$row["aa2_number"],$row["flight_number"]
        );
    }

    public static function updateOptions(
        $ride_id,$from_to,$price,$flight_number,$street_id,$street_number,$aa1,$aa1_number,$aa2,$aa2_number,$num_people,$num_suitcases,$num_child_seats
    ){
        try{
            $konekcija = konekcija_prepared();
            $query = "
                UPDATE rides 
                SET from_to=:from_to, price=:price,flight_number=:flight_number,streets_id=:streets_id,street_number=:street_number,aa1=:aa1,
                    aa1_number=:aa1_number,aa2=:aa2,aa2_number=:aa2_number,number_people=:number_people,number_suitcases=:number_suitcases,number_child_seats=:number_child_seats
                WHERE id=:ride_id
            ";
            $sth = $konekcija->prepare($query);

            $sth->bindParam(':ride_id', $ride_id);

            $sth->bindParam(':from_to', $from_to);
            $sth->bindParam(':price', $price);
            $sth->bindParam(':flight_number', $flight_number);
            $sth->bindParam(':streets_id', $street_id);
            $sth->bindParam(':street_number', $street_number);
            $sth->bindParam(':aa1', $aa1);
            $sth->bindParam(':aa1_number', $aa1_number);
            $sth->bindParam(':aa2', $aa2);
            $sth->bindParam(':aa2_number', $aa2_number);
            $sth->bindParam(':number_people', $num_people);
            $sth->bindParam(':number_suitcases', $num_suitcases);
            $sth->bindParam(':number_child_seats', $num_child_seats);

            $ans = $sth->execute();

            if($ans){
                return success("Ride information changed successfuly");
            }else {
                return danger("error has occured");
            }

        }catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return danger('Error establishing connection with database');
        }
    }

    public static function updatePrice($ride_id,$price){
        try{
            $konekcija = konekcija_prepared();
            $query = "
                UPDATE rides 
                SET price=:price
                WHERE id=:ride_id
            ";
            $sth = $konekcija->prepare($query);

            $sth->bindParam(':ride_id', $ride_id);
            $sth->bindParam(':price', $price);

            $ans = $sth->execute();

            if($ans){
                return success("Ride price changed successfuly");
            }else {
                return danger("error has occured");
            }

        }catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return danger('Error establishing connection with database');
        }
    }

    public static function updateBasicInfo($ride_id,$name,$email,$mobile,$payment,$comment,$ride_time): string
    {
        try{
            $konekcija = konekcija_prepared();
            $query = "
                UPDATE rides 
                SET name=:name,email=:email,mobile=:mobile,payment=:payment,comment=:comment, ride_time=:ride_time
                WHERE id=:ride_id
            ";
            $sth = $konekcija->prepare($query);

            $sth->bindParam(':ride_id', $ride_id);
            $sth->bindParam(':name', $name);
            $sth->bindParam(':email', $email);
            $sth->bindParam(':mobile', $mobile);
            $sth->bindParam(':payment', $payment);
            $sth->bindParam(':comment', $comment);
            $sth->bindParam(':ride_time', $ride_time);

            $ans = $sth->execute();

            if($ans){
                return success("Ride information changed successfuly");
            }else {
                return danger("error has occured");
            }

        }catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return danger('Error establishing connection with database');
        }
    }

    public function getDate(){
        return explode(" ",$this->ride_time)[0];
    }

    public function getHour(){
        $time = explode(" ",$this->ride_time)[1];
        return explode(":",$time)[0];
    }

    public function getMinute(){
        $time = explode(" ",$this->ride_time)[1];
        return explode(":",$time)[1];
    }

    public static function getAssignedRidesByDriverId($driver_id){
        if(!isset($driver_id) || empty($driver_id) || !is_numeric($driver_id)){
            return [];
        }

        $rides = [];

        $result = get("SELECT * FROM rides WHERE status IN ('assigned','accepted') AND driver_id=".$driver_id." ORDER BY ride_time");
        while ($row = $result->fetch_assoc()) {
            $rides [] = new Ride(
                $row["id"], $row["name"], $row["email"], $row["mobile"], $row["from_to"], $row["number_people"], $row["number_suitcases"],$row["number_child_seats"],
                $row["status"],$row["streets_id"],$row["street_number"],$row["payment"],$row["price"],$row["ride_time"],$row["comment"],$row["driver_id"],$row["admin_id"],
                $row["return_ride"],$row["aa1"],$row["aa2"],$row["booked_time"],$row["aa1_number"],$row["aa2_number"],$row["flight_number"]
            );
        }

        return $rides;
    }

    public static function getAssignedRides(){
        $rides = [];

        $result = get("SELECT * FROM rides WHERE status IN('assigned','accepted') AND driver_id>0");
        while ($row = $result->fetch_assoc()) {
            $rides [] = new Ride(
                $row["id"], $row["name"], $row["email"], $row["mobile"], $row["from_to"], $row["number_people"], $row["number_suitcases"],$row["number_child_seats"],
                $row["status"],$row["streets_id"],$row["street_number"],$row["payment"],$row["price"],$row["ride_time"],$row["comment"],$row["driver_id"],$row["admin_id"],
                $row["return_ride"],$row["aa1"],$row["aa2"],$row["booked_time"],$row["aa1_number"],$row["aa2_number"],$row["flight_number"]
            );
        }

        return $rides;
    }

    public static function getAssignedAll(){
        $rides = [];

        $result = get("SELECT * FROM rides ORDER BY ride_time");
        while ($row = $result->fetch_assoc()) {
            $rides [] = new Ride(
                $row["id"], $row["name"], $row["email"], $row["mobile"], $row["from_to"], $row["number_people"], $row["number_suitcases"],$row["number_child_seats"],
                $row["status"],$row["streets_id"],$row["street_number"],$row["payment"],$row["price"],$row["ride_time"],$row["comment"],$row["driver_id"],$row["admin_id"],
                $row["return_ride"],$row["aa1"],$row["aa2"],$row["booked_time"],$row["aa1_number"],$row["aa2_number"],$row["flight_number"]
            );
        }

        return $rides;
    }

    public static function getTrashRides(){
        $rides = [];

        $result = get("SELECT * FROM rides WHERE status='deleted'");
        while ($row = $result->fetch_assoc()) {
            $rides [] = new Ride(
                $row["id"], $row["name"], $row["email"], $row["mobile"], $row["from_to"], $row["number_people"], $row["number_suitcases"],$row["number_child_seats"],
                $row["status"],$row["streets_id"],$row["street_number"],$row["payment"],$row["price"],$row["ride_time"],$row["comment"],$row["driver_id"],$row["admin_id"],
                $row["return_ride"],$row["aa1"],$row["aa2"],$row["booked_time"],$row["aa1_number"],$row["aa2_number"],$row["flight_number"]
            );
        }

        return $rides;
    }

    public static function getFailedRides(){
        $rides = [];

        $result = get("SELECT * FROM rides WHERE status='failed'");
        while ($row = $result->fetch_assoc()) {
            $rides [] = new Ride(
                $row["id"], $row["name"], $row["email"], $row["mobile"], $row["from_to"], $row["number_people"], $row["number_suitcases"],$row["number_child_seats"],
                $row["status"],$row["streets_id"],$row["street_number"],$row["payment"],$row["price"],$row["ride_time"],$row["comment"],$row["driver_id"],$row["admin_id"],
                $row["return_ride"],$row["aa1"],$row["aa2"],$row["booked_time"],$row["aa1_number"],$row["aa2_number"],$row["flight_number"]
            );
        }

        return $rides;
    }

    public static function getSuccessRides(){
        $rides = [];

        $result = get("SELECT * FROM rides WHERE status='success'");
        while ($row = $result->fetch_assoc()) {
            $rides [] = new Ride(
                $row["id"], $row["name"], $row["email"], $row["mobile"], $row["from_to"], $row["number_people"], $row["number_suitcases"],$row["number_child_seats"],
                $row["status"],$row["streets_id"],$row["street_number"],$row["payment"],$row["price"],$row["ride_time"],$row["comment"],$row["driver_id"],$row["admin_id"],
                $row["return_ride"],$row["aa1"],$row["aa2"],$row["booked_time"],$row["aa1_number"],$row["aa2_number"],$row["flight_number"]
            );
        }

        return $rides;
    }

    public static function getNewRides(){
        $rides = [];

        $result = get("SELECT * FROM rides WHERE status='new_ride' ORDER BY ride_time");
        while ($row = $result->fetch_assoc()) {
            $rides [] = new Ride(
                $row["id"], $row["name"], $row["email"], $row["mobile"], $row["from_to"], $row["number_people"], $row["number_suitcases"],$row["number_child_seats"],
                $row["status"],$row["streets_id"],$row["street_number"],$row["payment"],$row["price"],$row["ride_time"],$row["comment"],$row["driver_id"],$row["admin_id"],
                $row["return_ride"],$row["aa1"],$row["aa2"],$row["booked_time"],$row["aa1_number"],$row["aa2_number"],$row["flight_number"]
            );
        }

        return $rides;
    }

    public function getStreet(){
        return Street::getById($this->streets_id);
    }

    public function getDistrict(){
        $street = Street::getById($this->streets_id);
        return District::getById($street->getDistrictId());
    }

    public function getCity(){
        $street = Street::getById($this->streets_id);
        $district = District::getById($street->getDistrictId());
        return City::getById($district->getCityId());
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getMobile()
    {
        return $this->mobile;
    }

    public function setMobile($mobile): void
    {
        $this->mobile = $mobile;
    }

    public function getFromTo()
    {
        return $this->from_to;
    }

    public function setFromTo($from_to): void
    {
        $this->from_to = $from_to;
    }

    public function getNumberOfPeople()
    {
        return $this->number_of_people;
    }

    public function setNumberOfPeople($number_of_people): void
    {
        $this->number_of_people = $number_of_people;
    }

    public function getNumberOfSuitcases()
    {
        return $this->number_of_suitcases;
    }

    public function setNumberOfSuitcases($number_of_suitcases): void
    {
        $this->number_of_suitcases = $number_of_suitcases;
    }

    public function getNumberOfChildSeats()
    {
        return $this->number_of_child_seats;
    }

    public function setNumberOfChildSeats($number_of_child_seats): void
    {
        $this->number_of_child_seats = $number_of_child_seats;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status): void
    {
        $this->status = $status;
    }

    public function getStreetsId()
    {
        return $this->streets_id;
    }

    public function setStreetsId($streets_id): void
    {
        $this->streets_id = $streets_id;
    }

    public function getStreetNumber()
    {
        return $this->street_number;
    }

    public function setStreetNumber($street_number): void
    {
        $this->street_number = $street_number;
    }

    public function getPayment()
    {
        return $this->payment;
    }

    public function setPayment($payment): void
    {
        $this->payment = $payment;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): void
    {
        $this->price = $price;
    }

    public function getRideTime()
    {
        return $this->ride_time;
    }

    public function setRideTime($ride_time): void
    {
        $this->ride_time = $ride_time;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($comment): void
    {
        $this->comment = $comment;
    }

    public function getDriverId()
    {
        return $this->driver_id;
    }

    public function setDriverId($driver_id): void
    {
        $this->driver_id = $driver_id;
    }

    public function getAdminId()
    {
        return $this->admin_id;
    }

    public function setAdminId($admin_id): void
    {
        $this->admin_id = $admin_id;
    }

    public function getReturnRide(){
        return $this->return_ride;
    }

    public function setReturnRide($return_ride): void{
        $this->return_ride = $return_ride;
    }

    public function getAdditionalAddress1(){
        return $this->additional_address_1;
    }

    public function setAdditionalAddress1($additional_address_1): void
    {
        $this->additional_address_1 = $additional_address_1;
    }

    public function getAdditionalAddress2(){
        return $this->additional_address_2;
    }

    public function setAdditionalAddress2($additional_address_2): void{
        $this->additional_address_2 = $additional_address_2;
    }

    public function getBookedTime(){
        return $this->booked_time;
    }

    public function setBookedTime($booked_time): void{
        $this->booked_time = $booked_time;
    }

    public function getAdditionalAddress1StreetNumber(){
        return $this->additional_address_1_street_number;
    }

    public function setAdditionalAddress1StreetNumber($additional_address_1_street_number): void{
        $this->additional_address_1_street_number = $additional_address_1_street_number;
    }

    public function getAdditionalAddress2StreetNumber(){
        return $this->additional_address_2_street_number;
    }

    public function setAdditionalAddress2StreetNumber($additional_address_2_street_number): void
    {
        $this->additional_address_2_street_number = $additional_address_2_street_number;
    }

    /**
     * @return mixed|null
     */
    public function getFlightNumber()
    {
        return $this->flight_number;
    }

    /**
     * @param mixed|null $flight_number
     */
    public function setFlightNumber($flight_number): void
    {
        $this->flight_number = $flight_number;
    }

    /**
     * @return mixed
     */
    public function getNumberOfBabySeats()
    {
        return $this->number_of_baby_seats;
    }

    /**
     * @param mixed $number_of_baby_seats
     */
    public function setNumberOfBabySeats($number_of_baby_seats): void
    {
        $this->number_of_baby_seats = $number_of_baby_seats;
    }

    /**
     * @return mixed
     */
    public function getNumberOfRaisedSeats()
    {
        return $this->number_of_raised_seats;
    }

    /**
     * @param mixed $number_of_raised_seats
     */
    public function setNumberOfRaisedSeats($number_of_raised_seats): void
    {
        $this->number_of_raised_seats = $number_of_raised_seats;
    }





}