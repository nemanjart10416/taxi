<?php

class City{
    private $id;
    private $name;

    public function __construct($id,$name){
        $this->id = $id;
        $this->name = $name;
    }

    public static function getById($id){
        if(!is_numeric($id)){
            //return false;
            return null;
        }

        $conn = konekcija();
        $stmt = $conn->prepare("SELECT * FROM city WHERE city_id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows === 0){
            //return false;
            return null;
        }

        $result = $result->fetch_assoc();

        return new City($result["city_id"],$result["city_name"]);
    }

    public static function delete($id){
        try{
            $konekcija = konekcija_prepared();
            $query = "DELETE FROM city WHERE city_id = :id";
            $sth = $konekcija->prepare($query);
            $sth->bindParam(':id', $id);

            $ans = $sth->execute();

            if($ans){
                return success("City deleted successfuly");
            }else {
                return danger("error has occured");
            }

        }catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return danger('Error establishing connection with database');
        }
    }

    public function getDistricts(){
        return District::getAllByCity($this->id);
    }

    public static function cityNameExist($city_name){
        $conn = konekcija();
        $stmt = $conn->prepare("SELECT * FROM city WHERE city_name = ?");
        $stmt->bind_param("s", $city_name);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows === 0){
            return false;
        }

        return true;
    }

    public static function search($search){
        $cities = [];

        try{
            $konekcija = konekcija_prepared();

            $sth = $konekcija->prepare("
                SELECT * 
                FROM city 
                WHERE city_name LIKE CONCAT('%',:search,'%')
            ");
            $sth->bindParam(':search', $search);
            $sth->execute();

            while($row = $sth->fetch(PDO::FETCH_ASSOC)){
                $cities []= new City($row["city_id"],$row["city_name"]);
            }

            return $cities;
        }catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return danger('Error establishing connection with database');
        }
    }

    public static function add($name){
        try{
            $konekcija = konekcija_prepared();
            $query = "INSERT INTO city VALUES(NULL,:name)";
            $sth = $konekcija->prepare($query);

            $sth->bindParam(':name', $name);

            $ans = $sth->execute();

            if($ans){
                return success("City added successfuly");
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
            $query = "UPDATE city SET city_name=:name WHERE city_id=:id";
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

    public static function getAll($order = ""){
        $cities = [];

        if($order==""){
            $result = get("SELECT * FROM city ORDER BY city_id ASC ");
        }else{
            $result = get("SELECT * FROM city ".$order);
        }


        while ($row = $result->fetch_assoc()){
            $cities []= new City($row["city_id"],$row["city_name"]);
        }

        return $cities;
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



}