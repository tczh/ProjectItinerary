<?php
    class ReviewDetails {
    
        // database connection and table name
        private $conn;
        private $table_name = "reviewdetails";

        // object properties
        public $reviewid;
        public $ReviewdetailsID;
        public $itinerary_details;
        public $comments;
        public $ActivityRate;
        // constructor with $db as database connection
        public function __construct($db) {
            $this->conn = $db;
        }

        public function InsertReviewDetails(){
            $query = "INSERT
            INTO
                reviewdetails
            VALUES
            (?,?, ?, ?, ?)
            ";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->ReviewDetailsID);
            $stmt->bindParam(2, $this->reviewid);
            $stmt->bindParam(3, $this->itinerary_details);
            $stmt->bindParam(4, $this->ActivityRate);
            $stmt->bindParam(5, $this->comments);
            $result = $stmt->execute();

            return $result;
            
        }
    }