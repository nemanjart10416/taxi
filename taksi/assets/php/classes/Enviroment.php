<?php

class Enviroment{
    private $additionalAddressPrice;
    private $babySeatPrice;
    private $childSeatPrice;
    private $raisedSeatPrice;
    private $maxPeople;
    private $maxChildSeat;
    private $maxSuitcases;

    public function __construct() {
        $result = get("SELECT * FROM enviroment")->fetch_assoc();
        $this->additionalAddressPrice = $result["aa_price"];
        $this->babySeatPrice = $result["bs_price"];
        $this->childSeatPrice = $result["cs_price"];
        $this->raisedSeatPrice = $result["rs_price"];
        $this->maxPeople = $result["max_people"];
        $this->maxChildSeat = $result["max_child_seat"];
        $this->maxSuitcases = $result["max_suitcases"];
    }

    public function update(){
        try{
            $konekcija = konekcija_prepared();
            $query = "
                UPDATE enviroment 
                SET aa_price=:price, cs_price=:cs_price, bs_price=:bs_price, rs_price=:rs_price, max_people=:max_people, 
                    max_child_seat=:max_child_seat, max_suitcases=:max_suitcases";
            $sth = $konekcija->prepare($query);

            $sth->bindParam(':price', $this->additionalAddressPrice);
            $sth->bindParam(':cs_price', $this->childSeatPrice);
            $sth->bindParam(':bs_price', $this->babySeatPrice);
            $sth->bindParam(':rs_price', $this->raisedSeatPrice);
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

    public function getBabySeatPrice(){
        return $this->babySeatPrice;
    }

    public function setBabySeatPrice($babySeatPrice){
        $this->babySeatPrice = $babySeatPrice;
    }

    public function getRaisedSeatPrice()
    {
        return $this->raisedSeatPrice;
    }

    public function setRaisedSeatPrice($raisedSeatPrice)
    {
        $this->raisedSeatPrice = $raisedSeatPrice;
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