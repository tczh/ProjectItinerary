<?php
    class ItineraryDetails {
    
        // database connection and table name
        private $conn;
        private $table_name = "itinerary_details";

        // object properties
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

        public function InsertItineraryDetails(){
            $query = "INSERT
            INTO
                itinerary_details(itineraryid, itineraryowner,daynumber,location, activity,activitynumber, description,starttime,endtime)
            VALUES
                (:itineraryid, :itineraryowner, :daynumber, :location, :activity, :activitynumber, :description,:starttime,:endtime)
            ";
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':itineraryid', $this->itineraryid);
            $stmt->bindParam(':itineraryowner', $this->itineraryowner);
            $stmt->bindParam(':daynumber', $this->daynumber);
            $stmt->bindParam(':location', $this->location);
            $stmt->bindParam(':activity', $this->activity);
            $stmt->bindParam(':activitynumber', $this->activitynumber);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':starttime', $this->starttime);
            $stmt->bindParam(':endtime', $this->endtime);

            $result = $stmt->execute();

            return $result;
            
        }
    }