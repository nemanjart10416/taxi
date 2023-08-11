<?php
include_once("funkcije.php");

if(isset($_GET["last_id_driver"])){
    $driver_id = user_input($_GET["last_id_driver"]);
    if(is_numeric($driver_id)){
        $result = get("SELECT COUNT(*) AS id FROM rides WHERE driver_id=".$driver_id);
        $row = $result->fetch_assoc();
        if(!isset($row["id"])){
            echo -1;
        }else{
            echo $row["id"];
        }
        exit();
    }
}

if(isset($_GET["last_id"])){
    $result = get("SELECT id FROM rides ORDER BY id DESC LIMIT 1");
    $row = $result->fetch_assoc();
    $last_ride_id = $row["id"];
    echo $last_ride_id;
    die();
}

if(isset($_GET["change_driver_status"])){
    $status = user_input($_GET["change_driver_status"]);

    if(!isset($_SESSION["status"]) || $_SESSION["status"]!=="driver"){
        die();
    }

    $id = $_SESSION["podaci"]["driver_id"];

    if(empty($status) || empty($id) || !is_numeric($id)){
        echo false;
        die();
    }

    $ans = Driver::change_status($id,$status);
    if($ans){
        $driver = Driver::getById($id);
        $status = $driver->getStatus();
        echo $status;
    }else{
        echo "error has occured try again later";
    }
}

if(isset($_GET["searchCity"])){
    $searchCity = user_input($_GET["searchCity"]);

    $results = City::search($searchCity);

    $formated = [];

    foreach ($results as $city){
        $formated []= array("city_id"=>$city->getId(),"city_name"=>$city->getName());
    }

    echo json_encode($formated);
    die();
}

if(isset($_GET["get_street"]) && isset($_GET["district_id"])){
    $district_id = $_GET["district_id"];
    if(is_numeric($district_id) && $district_id>0){
        try{
            $konekcija_prepared = konekcija_prepared();

            $query = "SELECT * FROM streets WHERE streets_district_id = :streets_district_id";
            // Prepare the SQL query string.
            $sth = $konekcija_prepared->prepare($query);
            // Bind parameters to statement variables.
            $sth->bindParam(':streets_district_id', $district_id);
            // Execute statement.
            $sth->execute();
            // Set fetch mode to FETCH_ASSOC to return an array indexed by column name.
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            // Fetch result.
            $result = $sth->fetchAll();
            echo json_encode($result);
            die();
        }catch(PDOException $e){
            /**
             * You can log PDO exceptions to PHP's system logger, using the
             * log engine of the operating system
             *
             * For more logging options visit http://php.net/manual/en/function.error-log.php
             */
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            /**
             * Stop executing, return an Internal Server Error HTTP status code (500),
             * and display an error
             */
            http_response_code(500);
            die('Error establishing connection with database');
        }
    }else{
        die();
    }
}

if(isset($_GET["get_district"]) && isset($_GET["city_id"])){
    $city_id = $_GET["city_id"];
    if(is_numeric($city_id) && $city_id>0){
        try { // Check connection before executing the SQL query
            $konekcija_prepared = konekcija_prepared();

            $query = "SELECT * FROM district WHERE district_city_id = :district_city_id";
            // Prepare the SQL query string.
            $sth = $konekcija_prepared->prepare($query);
            // Bind parameters to statement variables.
            $sth->bindParam(':district_city_id', $city_id);
            // Execute statement.
            $sth->execute();
            // Set fetch mode to FETCH_ASSOC to return an array indexed by column name.
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            // Fetch result.
            $result = $sth->fetchAll();
            echo json_encode($result);
            die();
        }catch(PDOException $e){
            /**
             * You can log PDO exceptions to PHP's system logger, using the
             * log engine of the operating system
             *
             * For more logging options visit http://php.net/manual/en/function.error-log.php
             */
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            /**
             * Stop executing, return an Internal Server Error HTTP status code (500),
             * and display an error
             */
            http_response_code(500);
            die('Error establishing connection with database');
        }
    }else{
        die();
    }
}