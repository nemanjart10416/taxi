<?php

class Enviroment{
    private $additionalAddressPrice;
    private $childSeatPrice;
    private $maxPeople;
    private $maxChildSeat;
    private $maxSuitcases;

    public function __construct() {
        $result = get("SELECT * FROM enviroment")->fetch_assoc();
        $this->additionalAddressPrice = $result["aa_price"];
        $this->childSeatPrice = $result["cs_price"];
        $this->maxPeople = $result["max_people"];
        $this->maxChildSeat = $result["max_child_seat"];
        $this->maxSuitcases = $result["max_suitcases"];
    }

    public function update(){
        try{
            $konekcija = konekcija_prepared();
            $query = "UPDATE enviroment SET aa_price=:price,cs_price=:cs_price,max_people=:max_people,max_child_seat=:max_child_seat,max_suitcases=:max_suitcases";
            $sth = $konekcija->prepare($query);

            $sth->bindParam(':price', $this->additionalAddressPrice);
            $sth->bindParam(':cs_price', $this->childSeatPrice);
            $sth->bindParam(':max_people', $this->maxPeople);
            $sth->bindParam(':max_child_seat', $this->maxChildSeat);
            $sth->bindParam(':max_suitcases', $this->maxSuitcases);

            $ans = $sth->execute();

            if($ans){
                return success("Update successful");
            }else {
                return danger("error has occured");
            }

        }catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return danger('Error establishing connection with database');
        }
    }

    public function getMaxSuitcases(){
        return $this->maxSuitcases;
    }

    public function setMaxSuitcases($maxSuitcases){
        $this->maxSuitcases = $maxSuitcases;
    }



    public function getMaxChildSeat(){
        return $this->maxChildSeat;
    }

    public function setMaxChildSeat($maxChildSeat){
        $this->maxChildSeat = $maxChildSeat;
    }

    public function getMaxPeople(){
        return $this->maxPeople;
    }

    public function setMaxPeople($maxPeople){
        $this->maxPeople = $maxPeople;
    }

    public function getAdditionalAddressPrice(){
        return $this->additionalAddressPrice;
    }

    public function setAdditionalAddressPrice($additionalAddressPrice){
        $this->additionalAddressPrice = $additionalAddressPrice;
    }

    public function getChildSeatPrice(){
        return $this->childSeatPrice;
    }

    public function setChildSeatPrice($childSeatPrice) {
        $this->childSeatPrice = $childSeatPrice;
    }


}