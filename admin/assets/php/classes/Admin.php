<?php

class Admin {
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

    public static function sendPasswordToEmail($email,$password) {
        $template = new_password_template_en($password);
        send_mail_to_customer("Password reset","",$email,$template);
        /*
        $myfile = fopen("password.txt", "w") or die("Unable to open file!");
        $txt = $email." ==> new password: ".$password;
        fwrite($myfile, $txt);
        fclose($myfile);*/
    }

    public static function setRandomPassword($email){
        $salt = get_salt();
        $password = bin2hex(openssl_random_pseudo_bytes(6));
        $hash = password_hash($password.$salt, PASSWORD_DEFAULT);


        try{
            $konekcija = konekcija_prepared();
            $query = "UPDATE administrator SET administrator_password=:hash,administrator_salt=:salt WHERE administrator_email=:email";
            $sth = $konekcija->prepare($query);
            $sth->bindParam(':hash', $hash);
            $sth->bindParam(':salt', $salt);
            $sth->bindParam(':email', $email);

            $ans = $sth->execute();

            if($ans){
                self::sendPasswordToEmail($email,$password);
                return success("Password sent to email");
            }else {
                return danger("error has occured");
            }
        }catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return danger('Error establishing connection with database');
        }
    }

    public static function change_password($id,$password){
        $salt = get_salt();
        $hash = password_hash($password.$salt, PASSWORD_DEFAULT);

        try{
            $konekcija = konekcija_prepared();
            $query = "UPDATE administrator SET administrator_password=:hash,administrator_salt=:salt WHERE administrator_id=:id";
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

    public function update(){
        try{
            $konekcija = konekcija_prepared();
            $query = "UPDATE administrator SET administrator_name=:name,administrator_last_name=:lname,
                         administrator_mobile=:mobile WHERE administrator_id=:id";
            $sth = $konekcija->prepare($query);
            $sth->bindParam(':name', $this->name);
            $sth->bindParam(':lname', $this->last_name);
            $sth->bindParam(':mobile', $this->mobile);
            $sth->bindParam(':id', $this->id);

            $ans = $sth->execute();

            if($ans){
                return success("Admin changed successfuly");
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
            $query = "DELETE FROM administrator WHERE administrator_id = :id";
            $sth = $konekcija->prepare($query);
            $sth->bindParam(':id', $id);

            $ans = $sth->execute();

            if($ans){
                return success("Admin deleted successfuly");
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
            $query = "INSERT INTO administrator
                (administrator_id,administrator_username,administrator_password,administrator_salt,administrator_name,administrator_last_name,administrator_email,administrator_mobile) 
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

    public function is_admin(){
        return $_SESSION["status"] === "administrator";
    }

    public function is_super_admin(){
        return $_SESSION["status"] === "super_administrator";
    }

    public static function usernameTaken($username){
        $conn = konekcija();
        $stmt = $conn->prepare("SELECT * FROM administrator WHERE administrator_username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows === 0){
            return false;
        }

        return true;
    }

    public static function emailTaken($email){
        $conn = konekcija();
        $stmt = $conn->prepare("SELECT * FROM administrator WHERE administrator_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows === 0){
            return false;
        }

        return true;
    }

    public static function login($user,$password) {
        $conn = konekcija();
        $stmt = $conn->prepare("SELECT * FROM administrator WHERE administrator_username = ?");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows === 0){
            return danger("user not found");
        }

        $result = $result->fetch_assoc();
        $pass = $password.$result["administrator_salt"];

        if(password_verify($pass, $result["administrator_password"])){
            $_SESSION["podaci"] = $result;
            $_SESSION["status"] = $result["administrator_status"];

            generate_csrf_token();

            set("UPDATE administrator SET administrator_last_login=CURRENT_TIMESTAMP WHERE administrator_id=".$result["administrator_id"]);

            header("location: https://devnoobs.rs/0_taksi_sistem_v_lux/admin/");
            die();
        }else{
            return danger("user not found");
        }
    }

    public static function search($search){
        $admins = [];

        try{
            $konekcija = konekcija_prepared();
            $sth = $konekcija->prepare("
                SELECT * 
                FROM administrator 
                WHERE ( administrator_username LIKE CONCAT('%',:search,'%') OR 
                        administrator_name LIKE CONCAT('%',:search,'%') OR 
                        administrator_last_name LIKE CONCAT('%',:search,'%') OR 
                        administrator_email LIKE CONCAT('%',:search,'%') OR 
                        administrator_joined LIKE CONCAT('%',:search,'%')
                ) AND administrator_status = 'administrator'
            ");
            $sth->bindParam(':search', $search);
            $sth->execute();

            while($row = $sth->fetch(PDO::FETCH_ASSOC)){
                $admins []= new Admin(
                    $row["administrator_id"],$row["administrator_username"],$row["administrator_name"],$row["administrator_last_name"],$row["administrator_email"],
                    $row["administrator_mobile"],$row["administrator_joined"],$row["administrator_last_login"],$row["administrator_status"]
                );
            }

            return $admins;
        }catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return danger('Error establishing connection with database');
        }
    }

    public static function get_admins($order = ""){
        $admins = [];

        $data = get("SELECT * FROM administrator WHERE administrator_status='administrator' ".$order);

        while ($result = $data->fetch_assoc()){
            $admins []= new Admin(
                $result["administrator_id"],$result["administrator_username"],$result["administrator_name"],$result["administrator_last_name"],$result["administrator_email"],
                $result["administrator_mobile"],$result["administrator_joined"],$result["administrator_last_login"],$result["administrator_status"]
            );
        }

        return $admins;
    }

    /*
     * getters
     */
    public static function getById($id){
        if(!is_numeric($id)){
            return false;
        }

        $conn = konekcija();
        $stmt = $conn->prepare("SELECT * FROM administrator WHERE administrator_id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows === 0){
            return false;
        }

        $result = $result->fetch_assoc();

        return new Admin(
            $result["administrator_id"],$result["administrator_username"],$result["administrator_name"],$result["administrator_last_name"],$result["administrator_email"],
            $result["administrator_mobile"],$result["administrator_joined"],$result["administrator_last_login"],$result["administrator_status"]
        );
    }

    public function getId()
    {
        return $this->id;
    }

    public function get_status(){
        return $this->status;
    }

    public function get_name(){
        return $this->name;
    }

    public function getLast_name(){
        return $this->last_name;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getMobile()
    {
        return $this->mobile;
    }

    public function getJoined()
    {
        return $this->joined;
    }

    public function getLastLogin()
    {
        return $this->last_login;
    }



}
