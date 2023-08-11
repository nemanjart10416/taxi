<?php
include("funkcije.php");

if(isset($_GET["get_aa_price"])){
    $enviroment = new Enviroment();
    echo $enviroment->getAdditionalAddressPrice();
    exit();
}

if(isset($_GET["get_bs_price"])){
    $enviroment = new Enviroment();
    echo $enviroment->getBabySeatPrice();
    exit();
}

if(isset($_GET["get_cs_price"])){
    $enviroment = new Enviroment();
    echo $enviroment->getChildSeatPrice();
    exit();
}

if(isset($_GET["get_rs_price"])){
    $enviroment = new Enviroment();
    echo $enviroment->getRaisedSeatPrice();
    exit();
}

if(isset($_GET["district_price"])){
    $num_people = user_input($_GET["num_people"]);
    if(empty($num_people) || !is_numeric($num_people) || $num_people<1){
        echo 0;
        die();
    }

    $district_id = user_input($_GET["district_price"]);
    if(empty($district_id) || !is_numeric($district_id) || $district_id<1){
        echo 0;
        die();
    }

    $district = District::getById($district_id);

    echo $district->getPrice($num_people);
}

//assets/php/ajax.php?district_id="+id+"&get_street
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
        echo "wrong";
        die();
    }
}
