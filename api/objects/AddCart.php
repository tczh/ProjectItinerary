<?php

class AddCart{
    
    private $conn;
    private $table_name = "add_cart";

    public $userid;
    public $itineraryid;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function insertCart(){
        $query = "insert into add_cart values(?,?)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(1, $this->userid);
        $stmt->bindParam(2, $this->itineraryid);
    
        $stmt->execute();
        return $stmt;

    }



}



?>