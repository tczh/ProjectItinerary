<?php
    class ProfileItineraryOwned {
        // database connection and table name
        private $conn;
        private $table_name = "itinerary";
        
        // object properties
        public $userid;
        
        public $itineraryid;

        public $itineraryowner;

        public $tourtitle;

        public $tourcategory;

        public $price;

        public $country;

        public $thumbnail;

        public $season;

        
        // constructor with $db as database connection
        public function __construct($db) {
            $this->conn = $db;
        }

        public function getOwnedItinerary($username) {
        
            // select all query
            $query = "SELECT * FROM itinerary where itineraryowner=:username";

            // prepare query statement
            $stmt = $this->conn->prepare($query);
                
            $stmt->bindParam(":username",$username);
        
            // execute query
            $stmt->execute();
        
            return $stmt;
        }
        public function getBoughtItinerary($username) {
        
            // select all query
            $query = "SELECT * FROM itinerary_purchased where userid=:username";

            // prepare query statement
            $stmt = $this->conn->prepare($query);
                
            $stmt->bindParam(":username",$username);
        
            // execute query
            $stmt->execute();
        
            return $stmt;
        }

        public function getItineraryHeader($username, $itineraryid) {
        
            // select all query
            $query = "SELECT * FROM itinerary_purchased where userid=:username and itineraryid=:itineraryid";

            // prepare query statement
            $stmt = $this->conn->prepare($query);
                
            $stmt->bindParam(":username",$username);
            $stmt->bindParam(":itineraryid",$itineraryid);
        
            // execute query
            $stmt->execute();
        
            return $stmt;
        }

        public function getBoughtItineraryHeader($username, $itineraryid) {
        
            // select all query
            $query = "SELECT * FROM itinerary where itineraryowner=:username and itineraryid=:itineraryid";

            // prepare query statement
            $stmt = $this->conn->prepare($query);
                
            $stmt->bindParam(":username",$username);
            $stmt->bindParam(":itineraryid",$itineraryid);
        
            // execute query
            $stmt->execute();
        
            return $stmt;
        }
        public function getItineraryPage($itineraryid) {
        
            // select all query
            $query = "SELECT * FROM itinerary where itineraryid=:itineraryid";

            // prepare query statement
            $stmt = $this->conn->prepare($query);
                
            $stmt->bindParam(":itineraryid",$itineraryid);
        
            // execute query
            $stmt->execute();
        
            return $stmt;
        }

    }
?>