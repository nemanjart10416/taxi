<?php

class Driver{
    private $id;
    private $username;
    private $name;
    private $last_name;
    private $email;
    private $mobile;
    private $joined;
    private $last_login;
    private $status;
    private $csrf_token;

    public function __construct($id,$username,$name,$last_name,$email,$mobile,$joined="",$last_login="",$status=""){
        $this->id = $id;
        $this->username = $username;
        $this->name = $name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->mobile = $mobile;
        $this->joined = $joined;
        $this->last_login = $last_login;
        $this->status = $status;
    }

    public static function change_password($id,$password){
        $salt = get_salt();
        $hash = password_hash($password.$salt, PASSWORD_DEFAULT);

        try{
            $konekcija = konekcija_prepared();
            $query = "UPDATE driver SET driver_password=:hash,driver_salt=:salt WHERE driver_id=:id";
            $sth = $konekcija->prepare($query);
            $sth->bindParam(':hash', $hash);
            $sth->bindParam(':salt', $salt);
            $sth->bindParam(':id', $id);

            $ans = $sth->execute();

            if($ans){
                return success("Password changed successfuly");
            }else {
                return danger("error has occured");
            }
        }catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return danger('Error establishing connection with database');
        }
    }

    public static function usernameTaken($username){
        $conn = konekcija();
        $stmt = $conn->prepare("SELECT * FROM driver WHERE driver_username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows === 0){
            return false;
        }

        return true;
    }

    public static function login($user,$password) {
        $conn = konekcija();
        $stmt = $conn->prepare("SELECT * FROM driver WHERE driver_username = ?");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows === 0){
            return danger("user not found");
        }

        $result = $result->fetch_assoc();
        $pass = $password.$result["driver_salt"];

        if(password_verify($pass, $result["driver_password"])){
            $_SESSION["podaci"] = $result;
            $_SESSION["status"] = "driver";

            generate_csrf_token();

            set("UPDATE driver SET driver_last_login=CURRENT_TIMESTAMP WHERE driver_id=".$result["driver_id"]);

            header("location: driver.php");
            die();
        }else{
            return danger("user not found");
        }
    }

    public static function emailTaken($email){
        $conn = konekcija();
        $stmt = $conn->prepare("SELECT * FROM driver WHERE driver_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows === 0){
            return false;
        }

        return true;
    }

    public function update(){
        try{
            $konekcija = konekcija_prepared();
            $query = "UPDATE driver SET driver_name=:name,driver_last_name=:lname,
                         driver_mobile=:mobile WHERE driver_id=:id";
            $sth = $konekcija->prepare($query);
            $sth->bindParam(':name', $this->name);
            $sth->bindParam(':lname', $this->last_name);
            $sth->bindParam(':mobile', $this->mobile);
            $sth->bindParam(':id', $this->id);

            $ans = $sth->execute();

            if($ans){
                return success("Driver changed successfuly");
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
            $query = "DELETE FROM driver WHERE driver_id = :id";
            $sth = $konekcija->prepare($query);
            $sth->bindParam(':id', $id);

            $ans = $sth->execute();

            if($ans){
                return success("Driver deleted successfuly");
            }else {
                return danger("error has occured");
            }

        }catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return danger('Error establishing connection with database');
        }
    }

    public static function create($username,$password,$salt,$name,$last_name,$email,$mobile){
        $hash = password_hash($password.$salt, PASSWORD_DEFAULT);

        try{
            $konekcija = konekcija_prepared();
            $query = "INSERT INTO driver
                (driver_id,driver_username,driver_password,driver_salt,driver_name,driver_last_name,driver_email,driver_mobile) 
                VALUES(NULL,:username,:password,:salt,:name,:last_name,:email,:mobile)";

            $sth = $konekcija->prepare($query);
            $sth->bindParam(':username', $username);
            $sth->bindParam(':password', $hash);
            $sth->bindParam(':salt', $salt);
            $sth->bindParam(':name', $name);
            $sth->bindParam(':last_name', $last_name);
            $sth->bindParam(':email', $email);
            $sth->bindParam(':mobile', $mobile);

            $ans = $sth->execute();

            return $ans;

        }catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return 'Error establishing connection with database';
        }

    }

    public static function search($search){
        $drivers = [];

        try{
            $konekcija = konekcija_prepared();
            $sth = $konekcija->prepare("
                SELECT * 
                FROM driver 
                WHERE ( driver_username LIKE CONCAT('%',:search,'%') OR 
                        driver_name LIKE CONCAT('%',:search,'%') OR 
                        driver_last_name LIKE CONCAT('%',:search,'%') OR 
                        driver_email LIKE CONCAT('%',:search,'%') OR 
                        driver_joined LIKE CONCAT('%',:search,'%')
                )
            ");
            $sth->bindParam(':search', $search);
            $sth->execute();

            while($row = $sth->fetch(PDO::FETCH_ASSOC)){
                $drivers []= new Driver(
                    $row["driver_id"],$row["driver_username"],$row["driver_name"],$row["driver_last_name"],$row["driver_email"],
                    $row["driver_mobile"],$row["driver_joined"],$row["driver_last_login"],$row["driver_status"]
                );
            }

            return $drivers;
        }catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return danger('Error establishing connection with database');
        }
    }

    public static function get_drivers($order = ""){
        $admins = [];

        $data = get("SELECT * FROM driver ".$order);

        while ($result = $data->fetch_assoc()){
            $admins []= new Driver(
                $result["driver_id"],$result["driver_username"],$result["driver_name"],$result["driver_last_name"],$result["driver_email"],
                $result["driver_mobile"],$result["driver_joined"],$result["driver_last_login"],$result["driver_status"]
            );
        }

        return $admins;
    }

    public static function get_active_drivers(){
        $admins = [];

        $data = get("SELECT * FROM driver WHERE driver_status='active'");

        while ($result = $data->fetch_assoc()){
            $admins []= new Driver(
                $result["driver_id"],$result["driver_username"],$result["driver_name"],$result["driver_last_name"],$result["driver_email"],
                $result["driver_mobile"],$result["driver_joined"],$result["driver_last_login"],$result["driver_status"]
            );
        }

        return $admins;
    }

    public static function getById($id){
        if(!is_numeric($id)){
            return false;
        }

        $conn = konekcija();
        $stmt = $conn->prepare("SELECT * FROM driver WHERE driver_id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows === 0){
            return false;
        }

        $result = $result->fetch_assoc();

        return new Driver(
            $result["driver_id"],$result["driver_username"],$result["driver_name"],$result["driver_last_name"],$result["driver_email"],
            $result["driver_mobile"],$result["driver_joined"],$result["driver_last_login"],$result["driver_status"]
        );
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void{
        $this->id = $id;
    }

    public function getUsername(){
        return $this->username;
    }

    public function setUsername($username): void{
        $this->username = $username;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name): void{
        $this->name = $name;
    }

    public function getLastName(){
        return $this->last_name;
    }

    public function setLastName($last_name): void{
        $this->last_name = $last_name;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email): void{
        $this->email = $email;
    }

    public function getMobile(){
        return $this->mobile;
    }

    public function setMobile($mobile): void{
        $this->mobile = $mobile;
    }

    public function getJoined(){
        return $this->joined;
    }

    public function setJoined($joined): void{
        $this->joined = $joined;
    }

    public function getLastLogin(){
        return $this->last_login;
    }

    public function setLastLogin($last_login): void{
        $this->last_login = $last_login;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status): void{
        $this->status = $status;
    }

    public function getCsrfToken(){
        return $this->csrf_token;
    }

    public function setCsrfToken($csrf_token): void{
        $this->csrf_token = $csrf_token;
    }
}