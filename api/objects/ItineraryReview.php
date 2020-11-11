<?php
    class ItineraryReview {
    
        // database connection and table name
        private $conn;
        private $table_name = "review_table";

        // object properties
        public $userid;
        public $reviewid;
        public $itineraryid;
        public $rate;
        public $status;
        public $message;
        public $ReviewdetailsID;
        public $itinerary_details;
        public $comments;
        public $ActivityRate;
        public $itineraryImage;
        public $paymentid;
        public $date;

        // constructor with $db as database connection
        public function __construct($db) {
            $this->conn = $db;
        }

        // get all winners
        
        public function getReviews($itineraryid){
            $query = "SELECT * from review_table where itineraryid = :itineraryid";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":itineraryid", $itineraryid);
            $stmt->execute();
            return $stmt;
        }
    }
?>