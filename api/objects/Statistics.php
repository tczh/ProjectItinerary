<?php
    class Statistics {
    
        // database connection and table name
        private $conn;
        private $table_name = "statistics_table";

        // object properties
        public $statisticsID;
        public $count;
        public $Country;
        public $month;
        // constructor with $db as database connection
        public function __construct($db) {
            $this->conn = $db;
        }

        public function ViewStats(){
            $query = "SELECT *  from statistics_table where Country = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->Country);
            $stmt->execute();
          
            return $stmt;
        }
    }