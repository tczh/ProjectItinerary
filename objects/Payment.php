<?php
    class Payment {
    
        // database connection and table name
        private $conn;
        private $table_name = "payment";

        // object properties
        public $paymentid;
        public $userid;
        public $itineraryid;
        public $itineraryowner;
        public $ispaid;
            
        // constructor with $db as database connection
        public function __construct($db) {
            $this->conn = $db;
        }

        // get all winners
        public function read() {
        
            // select all query
            $query = "SELECT
                            *
                        FROM
                            payment";

        
            // prepare query statement
            $stmt = $this->conn->prepare($query);
        
            // execute query
            $stmt->execute();
        
            return $stmt;
        }


        // search by gender
        public function reviewItineraryByStatus($status, $userid) {
        
            // select all query
            $query = "SELECT
                        *
                        FROM
                            review_table
                        WHERE
                            status = ? and userid = ?
                        ORDER BY
                            itineraryid";
        
            // prepare query statement
            $stmt = $this->conn->prepare($query);
                
            // bind
            $stmt->bindParam(1, $status);
            $stmt->bindParam(2,$userid);
        
            // execute query
            $stmt->execute();
        
            return $stmt;
        }

        // search by gender & decade
        public function search_by_gender_decade($gender, $decade) {
        
            // select all query
            $query = "SELECT
                        *
                        FROM
                            winner
                        WHERE
                            gender = ?
                            AND
                            year between ? AND ?
                        ORDER BY
                            id";
        
            // prepare query statement
            $stmt = $this->conn->prepare($query);
                
            // bind
            $stmt->bindParam(1, $gender);
            $stmt->bindParam(2, $decade);
            $end_year = $decade + 9;
            $stmt->bindParam(3, $end_year);
        
            // execute query
            $stmt->execute();
        
            return $stmt;
        }
    }
?>