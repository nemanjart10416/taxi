<?php

class PasswordReset{
    private $id;
    private $email;
    private $time;
    private $token;
    private $status;

    public function __construct($id, $email, $time, $token, $status){
        $this->id = $id;
        $this->email = $email;
        $this->time = $time;
        $this->token = $token;
        $this->status = $status;
    }

    public static function getByToken($token){

        $conn = konekcija();
        $stmt = $conn->prepare("SELECT * FROM password_reset WHERE password_reset_token = ?");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows === 0){
            return false;
        }

        $result = $result->fetch_assoc();

        return new PasswordReset(
            $result["password_reset_id"],$result["password_reset_email"],$result["password_reset_time"],$result["password_reset_token"],$result["password_reset_status"]
        );
    }

    public static function generateToken(){
        return bin2hex(openssl_random_pseudo_bytes(16)).time();
    }

    public static function expireToken($token){
        try{
            $konekcija = konekcija_prepared();
            $query = "UPDATE password_reset SET password_reset_status='expired' WHERE password_reset_token=:token";
            $sth = $konekcija->prepare($query);
            $sth->bindParam(':token', $token);
            $ans = $sth->execute();
        }catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return 'Error establishing connection with database';
        }
    }

    public static function add($email,$token){
        try{
            $konekcija = konekcija_prepared();
            $query = "INSERT INTO password_reset(password_reset_id,password_reset_email,password_reset_token) VALUES(NULL,:email,:token)";
            $sth = $konekcija->prepare($query);
            $sth->bindParam(':email', $email);
            $sth->bindParam(':token', $token);
            $ans = $sth->execute();

            if($ans===true){
                self::sendTokenByEmail($email,$token);
                return success("your reset link has been sent by email");
            }else{
                return danger("Error has occured please try again later");
            }
        }catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return 'Error establishing connection with database';
        }
    }

    public static function sendTokenByEmail($email,$token){
        $link = "https://www.privatni-casovi-programiranja-online.rs/0_admin_panel/admin/forgot-password.php?token=".$token;
        $template = password_reset_template_en($link);
        send_mail_to_customer("Password reset","",$email,$template);
        /*
        $myfile = fopen("token.txt", "w") or die("Unable to open file!");
        $txt = $email." ==> forgot-password.php?token=".$token;
        fwrite($myfile, $txt);
        fclose($myfile);*/
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getTime(){
        return $this->time;
    }

    public function setTime($time){
        $this->time = $time;
    }

    public function getToken(){
        return $this->token;
    }

    public function setToken($token){
        $this->token = $token;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
    }


}