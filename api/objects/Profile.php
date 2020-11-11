<?php
    class Profile {
        // database connection and table name
        private $conn;
        private $table_name = "login";
        
        // object properties
        public $userid;

        public $email;

        public $firstname;

        public $lastname;

        public $password;

        public $country;

        public $address;

        

        // constructor with $db as database connection
        public function __construct($db) {
            $this->conn = $db;
        }

        public function getPersonalDetails($username) {
        
            // select all query
            $query = "SELECT * FROM login where userid=:username";

            // prepare query statement
            $stmt = $this->conn->prepare($query);
                
            $stmt->bindParam(":username",$username);
        
            // execute query
            $stmt->execute();
        
            return $stmt;
        }
        
        public function editAcc($userid ,$email, $firstname, $lastname, $country){
            // update
            $query = "UPDATE login set email=:email, firstname=:firstname, lastname=:lastname, country=:country where userid=:username";
            $stmt = $this->conn->prepare($query);
                
            $stmt->bindParam(":username",$userid);
            $stmt->bindParam(":email",$email);
            $stmt->bindParam(":firstname",$firstname);
            $stmt->bindParam(":lastname",$lastname);
            $stmt->bindParam(":country",$country);

            // execute query
            $stmt->execute();
        
            return $stmt;
        
        }

        public function editAddress($userid, $password){
            // update
            $query = "UPDATE login set password=:password where userid=:username";
            $stmt = $this->conn->prepare($query);
                
            $stmt->bindParam(":username",$userid);
            $stmt->bindParam(":password",$password);

            // execute query
            $stmt->execute();
        
            return $stmt;
        
        }

        public function getEmails() {
        
            // select all query
            $query = "SELECT userid, email FROM login";

            // prepare query statement
            $stmt = $this->conn->prepare($query);
        
            // execute query
            $stmt->execute();
        
            return $stmt;
        }

    }
?>