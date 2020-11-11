<?php

class Purchases{
    
    private $conn;
    private $table_name = "itinerary_purchased";

    public $userid;
    public $itineraryid;

    public function __construct($db) {
        $this->conn = $db;
    }


    public function retrieve_itinerary_purchased(){
        $query = "select * from itinerary_purchased p inner join itinerary i on p.itineraryid=i.itineraryid where userid=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->userid);
        $stmt->execute();
      
        return $stmt;
        
    }


}



?>