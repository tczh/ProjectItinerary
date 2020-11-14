<?php

class Cart{
    
    private $conn;
    private $table_name = "add_cart";

    public $userid;
    public $itineraryid;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function all_cart(){
        $query = "SELECT * FROM add_cart;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;

    }


    public function CartByUserid(){
        $query = "SELECT * FROM add_cart where userid=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->userid);
        $stmt->execute();
      
        return $stmt;
        
    }


    public function itinerary_details_by_userid(){
        $query = "select * from add_cart a inner join itinerary i on a.itineraryid=i.itineraryid where userid=? order by itineraryowner";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->userid);
        $stmt->execute();
      
        return $stmt;
        
    }

    public function delete_cart(){
        $query = "delete from add_cart where userid=? and itineraryid=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->userid);
        $stmt->bindParam(2, $this->itineraryid);
        $stmt->execute();
      
        return $stmt;
        
    }

    public function itinerary_purchased(){
        $query = "insert into payment (paymentid, userid, itineraryowner, itineraryid, ispaid, billingemail) values (?,?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->paymentid);
        $stmt->bindParam(2, $this->userid);
        $stmt->bindParam(3, $this->itineraryowner);
        $stmt->bindParam(4, $this->itineraryid);
        $stmt->bindParam(5, $this->ispaid);
        $stmt->bindParam(6, $this->billingemail);

        $stmt->execute();
      
        return $stmt;
        
    }


    public function make_payment(){
        $query = "insert into make_payment(billingemail) values (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->billingemail);
        $stmt->execute();
      
        return $stmt;

    }


    public function retrieve_paymentid(){
        $query = "select max(paymentid) as paymentid, datebought from make_payment";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;

    }
    


    public function retrieve_itinerary_purchased(){
        $query = "select from itinerary_purchased where userid=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->userid);
        $stmt->execute();
      
        return $stmt;
        
    }


    public function itinerary_details(){
        $query = "select * from add_cart a inner join itinerary i on a.itineraryid=i.itineraryid";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->userid);
        $stmt->execute();
      
        return $stmt;

    }


    public function detail_insert_itinerary_purchased(){
        $query = "select * from itinerary where itineraryid=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->itineraryid);
        $stmt->execute();
    
        return $stmt;

    }


    public function insert_itinerary_purchased(){
        $query = "insert into itinerary_purchased values(?,?,?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->userid);
        $stmt->bindParam(2, $this->itineraryid);
        $stmt->bindParam(3, $this->itineraryowner);
        $stmt->bindParam(4, $this->tourtitle);
        $stmt->bindParam(5, $this->tourcategory);
        $stmt->bindParam(6, $this->country);
        $stmt->bindParam(7, $this->price);
        $stmt->bindParam(8, $this->thumbnail);
        $stmt->bindParam(9, $this->season);
        $stmt->execute();
    
        return $stmt;

    }


    public function itinerary_activities(){
        $query = "select * from itinerary_details where itineraryid=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->itineraryid);
        $stmt->execute();
    
        return $stmt;

    }

    public function insert_activities(){
        $query = "insert into itinerary_details_purchased values(?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(1, $this->userid);
        $stmt->bindParam(2, $this->detailsid);
        $stmt->bindParam(3, $this->itineraryid);
        $stmt->bindParam(4, $this->itineraryowner);
        $stmt->bindParam(5, $this->daynumber);
        $stmt->bindParam(6, $this->location);
        $stmt->bindParam(7, $this->activity);
        $stmt->bindParam(8, $this->activitynumber);
        $stmt->bindParam(9, $this->description);
        $stmt->bindParam(10, $this->starttime);
        $stmt->bindParam(11, $this->endtime);
        $stmt->execute();
    
        return $stmt;

    }


    public function itinerary_owner_name(){
        $query = "select * from login where userid= ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->userid);
        $stmt->execute();
        return $stmt;

    }



}



?>