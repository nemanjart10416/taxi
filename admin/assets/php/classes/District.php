<?php

class District{
    private $id;
    private $name;
    private $limo_price;
    private $kombi_price;
    private $van_price;
    private $autobus_price;
    private $city_id;

    public function __construct($id, $name, $limo_price, $kombi_price, $van_price, $autobus_price, $city_id=0)
    {
        $this->id = $id;
        $this->name = $name;
        $this->limo_price = $limo_price;
        $this->kombi_price = $kombi_price;
        $this->van_price = $van_price;
        $this->autobus_price = $autobus_price;
        $this->city_id = $city_id;
    }

    public static function districtNameExist($district_name){
        $conn = konekcija();
        $stmt = $conn->prepare("SELECT * FROM district WHERE district_name = ?");
        $stmt->bind_param("s", $district_name);
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
            $query = "
                        UPDATE district 
                        SET district_name=:name, district_limo=:limo, district_kombi=:kombi, district_van=:van, district_autobus=:autobus 
                        WHERE district_id=:id";

            $sth = $konekcija->prepare($query);

            $sth->bindParam(':name', $this->name);
            $sth->bindParam(':id', $this->id);
            $sth->bindParam(':limo', $this->limo_price);
            $sth->bindParam(':kombi', $this->kombi_price);
            $sth->bindParam(':van', $this->van_price);
            $sth->bindParam(':autobus', $this->autobus_price);

            $ans = $sth->execute();

            if($ans){
                return success("District changed successfuly");
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
            $query = "DELETE FROM district WHERE district_id = :id";
            $sth = $konekcija->prepare($query);
            $sth->bindParam(':id', $id);

            $ans = $sth->execute();

            if($ans){
                return success("District deleted successfuly");
            }else {
                return danger("error has occured");
            }

        }catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return danger('Error establishing connection with database');
        }
    }

    public static function getById($id){
        if(!is_numeric($id)){
            //return false;
            return null;
        }

        $conn = konekcija();
        $stmt = $conn->prepare("SELECT * FROM district WHERE district_id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows === 0){
            //return false;
            return null;
        }

        $result = $result->fetch_assoc();

        return new District(
            $result["district_id"],$result["district_name"],$result["district_limo"],$result["district_kombi"],$result["district_van"],
            $result["district_autobus"],$result["district_city_id"]);
    }

    public static function add($name,$limo,$kombi,$van,$autobus,$city_id){
        try{
            $konekcija = konekcija_prepared();
            $query = "INSERT INTO district VALUES(NULL,:name,:limo,:kombi,:van,:autobus,:city_id)";
            $sth = $konekcija->prepare($query);

            $sth->bindParam(':name', $name);
            $sth->bindParam(':limo', $limo);
            $sth->bindParam(':kombi', $kombi);
            $sth->bindParam(':van', $van);
            $sth->bindParam(':autobus', $autobus);
            $sth->bindParam(':city_id', $city_id);

            $ans = $sth->execute();

            if($ans){
                return success("District added successfuly");
            }else {
                return danger("error has occured");
            }

        }catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return danger('Error establishing connection with database');
        }
    }

    public function getPrice($people){
        if($people<=3){
            return $this->limo_price;
        }

        if($people>3 && $people<=5){
            return $this->kombi_price;
        }

        if($people>5 && $people<8){
            return $this->van_price;
        }
    }

    public static function getAllByCity($city_id){
        if(!is_numeric($city_id)){
            //return false;
            return [];
        }

        $conn = konekcija();
        $stmt = $conn->prepare("SELECT * FROM district WHERE district_city_id = ?");
        $stmt->bind_param("s", $city_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows === 0){
            //return false;
            return [];
        }

        $districts = [];
        while($row = $result->fetch_assoc()){
            $districts []= new District(
                $row["district_id"],$row["district_name"],$row["district_limo"],$row["district_kombi"],$row["district_van"],
                $row["district_autobus"],$row["district_city_id"]
            );
        }

        return $districts;
    }

    public function getStreets(){
        return Street::getAllByDistrict($this->id);
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id): void{
        $this->id = $id;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name): void{
        $this->name = $name;
    }

    public function getLimoPrice(){
        return $this->limo_price;
    }

    public function setLimoPrice($limo_price): void{
        $this->limo_price = $limo_price;
    }

    public function getKombiPrice(){
        return $this->kombi_price;
    }

    public function setKombiPrice($kombi_price): void{
        $this->kombi_price = $kombi_price;
    }

    public function getVanPrice(){
        return $this->van_price;
    }

    public function setVanPrice($van_price): void{
        $this->van_price = $van_price;
    }

    public function getAutobusPrice(){
        return $this->autobus_price;
    }

    public function setAutobusPrice($autobus_price): void{
        $this->autobus_price = $autobus_price;
    }

    public function getCityId(){
        return $this->city_id;
    }

    public function setCityId($city_id): void{
        $this->city_id = $city_id;
    }



}