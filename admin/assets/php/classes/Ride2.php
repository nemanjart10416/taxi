<?php

class Ride2{
    private $id;
    private $name;
    private $email;
    private $mobile;
    private $ride_time;

    private $address;

    private $comment;
    private $booked_time;
    private $instant_ride;

    private $status;

    public function __construct($id, $name, $email, $mobile, $ride_time, $address, $comment, $booked_time, $instant_ride, $status){
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->mobile = $mobile;
        $this->ride_time = $ride_time;
        $this->address = $address;
        $this->comment = $comment;
        $this->booked_time = $booked_time;
        $this->instant_ride = $instant_ride;
        $this->status = $status;
    }

    public static function getNewRides(){
        $rides = [];

        $result = get("SELECT * FROM orders WHERE status='new' ORDER BY booked_time");
        while ($row = $result->fetch_assoc()) {
            $rides [] = new Ride2(
                $row["id"], $row["name"], $row["email"], $row["mobile"], $row["ride_time"], $row["address"], $row["comment"],
                $row["booked_time"],$row["instant_ride"],$row["status"]
            );
        }

        return $rides;
    }

    public function getRideInfo(){
        return '
            <span class="en">Date and time:</span><span class="sr">Datum i vreme:</span><span class="de">Datum und Uhrzeit:</span>
            <span>'.$this->getRideTime().'</span>
            <hr class="mt-0 mb-0">
            <span class="en">Name: </span><span class="sr">Ime: </span><span class="de">Name: </span>
            '.$this->getName().'
            <hr class="mt-0 mb-0">
            <span class="en">Email: </span><span class="sr">Email: </span><span class="de">Email: </span>
            '.$this->getEmail().'
            <hr class="mt-0 mb-0">
            <span class="en">Mobile: </span><span class="sr">Mobilni: </span><span class="de">Mobiltelefon: </span>
            <span> '.$this->getMobile().'</span>
            <hr class="mt-0 mb-0">
            <span class="en">Comment: </span><span class="sr">Komentar: </span><span class="de">Kommentar: </span>
            <span> '.$this->getComment().'</span>
        ';
    }

    public static function delete($id){
        try{
            $konekcija = konekcija_prepared();
            $query = "UPDATE orders SET status='deleted' WHERE id=:id";
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

    public function getAddressInfo(){
        return $this->address;
    }

    public static function add($name, $email, $mobile, $ride_time, $address, $comment, $current_ride){
        try{
            $konekcija = konekcija_prepared();
            $query = "
                INSERT INTO orders(
                   id, name, email, mobile, ride_time, address, instant_ride, booked_time, comment
                )
                
                VALUES(
                    NULL, :name, :email, :mobile, :ride_time, :address, :instant_ride, :booked_time, :comment
                )
            ";
            $sth = $konekcija->prepare($query);

            $sth->bindParam(':email', $email);
            $sth->bindParam(':name', $name);
            $sth->bindParam(':mobile', $mobile);
            $sth->bindParam(':ride_time', $ride_time);
            $sth->bindParam(':address', $address);
            $sth->bindParam(':instant_ride', $current_ride);
            $sth->bindParam(':booked_time', $booked_time);
            $sth->bindParam(':comment', $comment);

            if ($sth->execute()) {
                return true;
            } else {
                return danger("Error inserting data: " . mysqli_error($sth));
            }
        } catch (PDOException $e) {
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return danger('Error establishing connection with database');
        }
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getMobile() {
        return $this->mobile;
    }

    public function setMobile($mobile) {
        $this->mobile = $mobile;
    }

    public function getRideTime() {
        return $this->ride_time;
    }

    public function setRideTime($ride_time) {
        $this->ride_time = $ride_time;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function getComment() {
        return $this->comment;
    }

    public function setComment($comment) {
        $this->comment = $comment;
    }

    public function getBookedTime() {
        return $this->booked_time;
    }

    public function setBookedTime($booked_time) {
        $this->booked_time = $booked_time;
    }



}