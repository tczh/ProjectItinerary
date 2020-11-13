<?php
    class Itinerary {
    
        // database connection and table name
        private $conn;
        private $table_name = "itinerary";

        // object properties
        public $maxid;
        public $itineraryid;
        public $itineraryowner;
        public $tourtitle;
        public $tourcategory;
        public $country;
        public $price;
        public $thumbnail;
        public $season;
        public $generaldetails;

        // constructor with $db as database connection
        public function __construct($db) {
            $this->conn = $db;
        }

        public function InsertItinerary(){
            $query = "INSERT
            INTO
                itinerary (itineraryowner, tourtitle, tourcategory, country, price, thumbnail,season, generaldetails)
            VALUES
                (:itineraryowner ,:tourtitle, :tourcategory, :country, :price, :thumbnail, :season, :generaldetails)
            ";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':itineraryowner', $this->itineraryowner);
            $stmt->bindParam(':tourtitle', $this->tourtitle);
            $stmt->bindParam(':tourcategory', $this->tourcategory);
            $stmt->bindParam(':country', $this->country);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':thumbnail', $this->thumbnail);
            $stmt->bindParam(':season', $this->season);
            $stmt->bindParam(':generaldetails', $this->generaldetails);

            $result = $stmt->execute();

            return $result;
            
        }

        public function retrieveLatestItinerary(){
            $query = "SELECT *
            FROM itinerary
            ORDER BY itineraryid DESC
            LIMIT 1";
            $stmt = $this->conn->prepare($query);

            $stmt->execute();
          
            return $stmt;
            
        }
    }
