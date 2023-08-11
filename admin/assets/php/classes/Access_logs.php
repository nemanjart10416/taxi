<?php

class Access_logs{
    private $id;
    private $ip;
    private $time;
    private $page;

    public function __construct($id, $ip, $time, $page){
        $this->id = $id;
        $this->ip = $ip;
        $this->time = $time;
        $this->page = $page;
    }

    public function add(){
        try{
            $konekcija = konekcija_prepared();
            $query = "INSERT INTO website_access(access_id, access_ip,access_page) VALUES(NULL,:access_ip,:access_page)";
            $sth = $konekcija->prepare($query);

            $sth->bindParam(':access_ip', $this->ip);
            $sth->bindParam(':access_page', $this->page);

            $ans = $sth->execute();
        }catch(PDOException $e){
            error_log('PDOException - ' . $e->getMessage(), 0);
            error_login('PDOException - ' . $e->getMessage());
            return danger('Error establishing connection with database');
        }
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getIp(){
        return $this->ip;
    }

    public function setIp($ip){
        $this->ip = $ip;
    }

    public function getTime(){
        return $this->time;
    }

    public function setTime($time){
        $this->time = $time;
    }

    public function getPage(){
        return $this->page;
    }

    public function setPage($page){
        $this->page = $page;
    }
}