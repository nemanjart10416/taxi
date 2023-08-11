<?php

class Street{
    private $id;
    private $name;
    private $district_id;

    /**
     * @param $id
     * @param $name
     * @param $district_id
     */
    public function __construct($id, $name, $district_id=0){
        $this->id = $id;
        $this->name = $name;
        $this->district_id = $district_id;
    }

    public static function getFullAddressNameById($id){
        $street = Street::getById($id);
        $district = $street->getDistrict();
        $city = City::getById($district->getCityId());

        return $city->getName().", ".$district->getName().", ".$street->getName();
    }

    public function getDistrict(){
        $conn = konekcija();
        $stmt = $conn->prepare("SELECT * FROM district WHERE district_id = ?");
        $stmt->bind_param("s", $this->district_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows === 0){
            //return false;
            return null;
        }

        $row = $result->fetch_assoc();

        return new District(
            $row["district_id"],$row["district_name"],$row["district_limo"],$row["district_kombi"],$row["district_van"],
            $row["district_autobus"],$row["district_city_id"]
        );
    }

    public static function streetNameExist($street_name){
        $conn = konekcija();
        $stmt = $conn->prepare("SELECT * FROM streets WHERE streets_name = ?");
        $stmt->bind_param("s", $street_name);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows === 0){
            return false;
        }

        return true;
    }

    public static function getById($id){
        if(!is_numeric($id)){
            //return false;
            return null;
        }

        $conn = konekcija();
        $stmt = $conn->prepare("SELECT * FROM streets WHERE streets_id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows === 0){
            //return false;
            return null;
        }

        $result = $result->fetch_assoc();

        return new Street($result["streets_id"],$result["streets_name"],$result["streets_district_id"]);
    }

    public function update(){
        try{
            $konekcija = konekcija_prepared();
            $query = "UPDATE streets SET streets_name=:name WHERE streets_id=:id";
            $sth = $konekcija->prepare($query);

            $sth->bindParam(':name', $this->name);
            $sth->bindParam(':id', $this->id);

            $ans = $sth->execute();

            if($ans){
                return success("City changed successfuly");
            }else {
                return danger("error has occured");
            }

        }catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return danger('Error establishing connection with database');
        }
    }

    public static function getAllByDistrict($district_id){
        if(!is_numeric($district_id)){
            //return false;
            return [];
        }

        $conn = konekcija();
        $stmt = $conn->prepare("SELECT * FROM streets WHERE streets_district_id = ?");
        $stmt->bind_param("s", $district_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows === 0){
            //return false;
            return [];
        }

        $streets = [];
        while($row = $result->fetch_assoc()){
            $streets []= new Street($row["streets_id"],$row["streets_name"],$row["streets_district_id"]);
        }

        return $streets;
    }

    public static function delete($id){
        try{
            $konekcija = konekcija_prepared();
            $query = "DELETE FROM streets WHERE streets_id = :id";
            $sth = $konekcija->prepare($query);
            $sth->bindParam(':id', $id);

            $ans = $sth->execute();

            if($ans){
                return success("Street deleted successfuly");
            }else {
                return danger("error has occured");
            }

        }catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return danger('Error establishing connection with database');
        }
    }

    public static function add($name,$district_id){
        try{
            $konekcija = konekcija_prepared();
            $query = "INSERT INTO streets VALUES(NULL,:name,:district_id)";
            $sth = $konekcija->prepare($query);

            $sth->bindParam(':name', $name);
            $sth->bindParam(':district_id', $district_id);

            $ans = $sth->execute();

            if($ans){
                return success("Street added successfuly");
            }else {
                return danger("error has occured");
            }

        }catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return danger('Error establishing connection with database');
        }
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

    public function getDistrictId(){
        return $this->district_id;
    }

    public function setDistrictId($district_id): void{
        $this->district_id = $district_id;
    }
}