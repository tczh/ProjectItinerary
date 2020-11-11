<?php
    class Review {
    
        // database connection and table name
        private $conn;
        private $table_name = "review_table";

        // object properties
        public $userid;
        public $reviewid;
        public $itineraryid;
        public $rate;
        public $status;
        public $ReviewdetailsID;
        public $itinerary_details;
        public $comments;
        public $ActivityRate;
        public $itineraryImage;
        public $paymentid;
        public $date;
        public $message;
        public $thumbnail;
        public $tourcategory;
        public $season;
        public $tourtitle;
        public $reviewdetailsid;

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
                            review_table";

        
            // prepare query statement
            $stmt = $this->conn->prepare($query);
        
            // execute query
            $stmt->execute();
        
            return $stmt;
        }


        // search by gender
        public function reviewItineraryByStatus($status) {
        
            // select all query
            $query = "SELECT
                        *
                        FROM
                            review_table
                        WHERE
                            status = ?
                        ORDER BY
                            itineraryid";
        
            // prepare query statement
            $stmt = $this->conn->prepare($query);
                
            // bind
            $stmt->bindParam(1, $status);
        
            // execute query
            $stmt->execute();
        
            return $stmt;
        }

        // search by gender & decade
        public function retrieveItineraryByUserid() {
        
            // select all query
            $query = "SELECT DISTINCT(a.paymentid), a.userid, a.itineraryid, a.ispaid, a.datebought, b.*, c.*, d.itineraryImage, d.tourtitle,
            e.ActivityRate, e.ReviewdetailsID
            from payment a LEFT join itinerary_details c ON a.itineraryid = c.itineraryid
            LEFT join review_table b ON c.itineraryid = b.itineraryid INNER JOIN itinerary d on c.itineraryid = d.itineraryid
            LEFT JOIN reviewdetails e ON b.reviewid = e.reviewid
            where a.userid = ?
            AND c.itineraryowner IS NOT NULL
            GROUP BY a.paymentid";
        
            // prepare query statement
            $stmt = $this->conn->prepare($query);
                
            // bind
            $stmt->bindParam(1, $this->userid);
        
            // execute query
            $stmt->execute();
            return $stmt;
        }
        public function retrieveOnlyFeedback(){
        
            // select all query
            $query = "SELECT * from review_table where itineraryid = ?";
        
            // prepare query statement
            $stmt = $this->conn->prepare($query);
                
            // bind
            $stmt->bindParam(1, $this->itineraryid);
        
            // execute query
            $stmt->execute();
            return $stmt;
        }
        public function RetrieveFeedback(){
        
            // select all query
            $query = "SELECT * from a.*, b.* from payment a left join review_table b ON a.itineraryid = b.itineraryid
            WHERE a.userid = ? and a.itineraryid = ?";
        
            // prepare query statement
            $stmt = $this->conn->prepare($query);
                
            // bind
            $stmt->bindParam(1, $this->userid);
            $stmt->bindParam(2, $this->itineraryid);
        
            // execute query
            $stmt->execute();
            return $stmt;
        }
        public function retrieveItineraryByUseridAndPaymentId() {
        
            // select all query
            $query = "SELECT DISTINCT(a.paymentid), a.userid, a.itineraryid, a.ispaid, a.datebought, b.*, c.*, d.itineraryImage
            from payment a LEFT join itinerary_details c ON a.itineraryid = c.itineraryid
            LEFT join review_table b ON c.itineraryid = b.itineraryid INNER JOIN itinerary d on c.itineraryid = d.itineraryid
            where a.userid = ? and a.paymentid = ?
            AND c.itineraryowner IS NOT NULL
            GROUP BY a.paymentid";
        
            // prepare query statement
            $stmt = $this->conn->prepare($query);
                
            // bind
            $stmt->bindParam(1, $this->userid);
            $stmt->bindParam(2,$this->paymentid);
        
            // execute query
            $stmt->execute();
            return $stmt;
        }
        public function retrieveByUserIdAndPayment() {

            // select all query
            $query = "SELECT a.*, b.*, c.* from payment a LEFT JOIN itinerary_details b ON a.itineraryid = b.itineraryid
            LEFT JOIN reviewdetails c ON b.detailsid = c.itinerary_details WHERE a.paymentid = ?
            GROUP BY b.location";
        
            // prepare query statement
            $stmt = $this->conn->prepare($query);
                
            // bind
            $stmt->bindParam(1, $this->paymentid);
        
            // execute query
            $stmt->execute();
            return $stmt;
        }
        public function deleteItineraryReview(){
            $query = "delete from review_table where userid=? and itineraryid=?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->userid);
            $stmt->bindParam(2, $this->itineraryid);
            $stmt->execute();
          
            return $stmt;
            
        }
        public function retrieveLatestReview(){
            $query = "SELECT MAX(reviewid) 
                        as reviewid 
                            from review_table";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
          
            return $stmt;
            
        }
        public function InsertReview(){
            $query = "INSERT
            INTO
                review_table
            VALUES
            (?,?, ?, ?, ?,?,?)
            ";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->reviewid);
            $stmt->bindParam(2, $this->userid);
            $stmt->bindParam(3, $this->itineraryid);
            $stmt->bindParam(4, $this->rate);
            $stmt->bindParam(5, $this->status);
            $stmt->bindParam(6, $this->date);
            $stmt->bindParam(7, $this->message);
            $result = $stmt->execute();

            return $result;
            
        }
        public function UpdateReview(){
            $query = "UPDATE
                review_table
            SET rate = ? , status = ? WHERE userid = ? AND itineraryid = ? ";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->rate);
            $stmt->bindParam(2, $this->status);
            $stmt->bindParam(3, $this->userid);
            $stmt->bindParam(4, $this->itineraryid);
            $result = $stmt->execute();

            return $result;
            
        }
        public function UpdateIndividualActivity(){
            $query = "UPDATE
                reviewdetails
            SET ActivityRate = ? , comments = ? WHERE reviewid = ? AND itinerary_details = ? AND ReviewdetailsID = ? ";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->ActivityRate);
            $stmt->bindParam(2, $this->comments);
            $stmt->bindParam(3, $this->reviewid);
            $stmt->bindParam(4, $this->itinerary_details);
            $stmt->bindParam(5, $this->ReviewdetailsID);
            $result = $stmt->execute();

            return $result;
            
        }
        public function viewReviewByUserId(){
            $query = "SELECT * from review_table where userid = ? and itineraryid = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->userid);
            $stmt->bindParam(2, $this->itineraryid);
            return $stmt;
        }
        public function RetrieveFeedback(){
            $query = "SELECT a.*, b.* from payment a left join review_table b ON a.itineraryid = b.itineraryid
            WHERE a.userid = ? and a.itineraryid = ? ";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->userid);
            $stmt->bindParam(2, $this->itineraryid);
            $result = $stmt->execute();

            return $result;
            
        }
        public function NewestFeedback(){
        
            // select all query
            $query = "SELECT a.*, b.* from itinerary a LEFT JOIN payment b ON a.itineraryid = b.itineraryid
            WHERE b.userid = ?";
        
            // prepare query statement
            $stmt = $this->conn->prepare($query);
                
            // bind
            $stmt->bindParam(1, $this->userid);
        
            // execute query
            $stmt->execute();
            
    }
?>