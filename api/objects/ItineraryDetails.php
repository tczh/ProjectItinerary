<?php
    class ItineraryDetails {
        // database connection and table name
        private $conn;
        private $table_name = "itinerary_details_purchased";
        
        // object properties
        public $userid;
        
        public $itineraryid;

        public $itineraryowner;

        public $daynumber;

        public $location;

        public $activity;

        public $activitynumber;

        public $description;

        public $starttime;

        public $endtime;

        // constructor with $db as database connection
        public function __construct($db) {
            $this->conn = $db;
        }

        public function getItineraryDetails($itineraryid) {
        
            // select all query
            $query = "SELECT * FROM itinerary_details_purchased where itineraryid=:itineraryid";

            // prepare query statement
            $stmt = $this->conn->prepare($query);
                
            $stmt->bindParam(":itineraryid", $itineraryid);
        
            // execute query
            $stmt->execute();
        
            return $stmt;
        }

        public function getBoughtItineraryDetails($itineraryid) {
        
            // select all query
            $query = "SELECT * FROM itinerary_details where itineraryid=:itineraryid";

            // prepare query statement
            $stmt = $this->conn->prepare($query);
                
            $stmt->bindParam(":itineraryid", $itineraryid);
        
            // execute query
            $stmt->execute();
        
            return $stmt;
        }

    }
?>