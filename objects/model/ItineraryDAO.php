<?php
    class ItineraryDAO{

        # Retrieve a user with a given username
        # Return null if no such user exists
        public function retrieveAll(){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "select * from itinerary";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            
            $itinerary = null;
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            
            while($row = $stmt->fetch()) {
                $itinerary[] = new Itinerary( $row['itineraryid'], $row['itineraryowner'], $row['tourtitle'], $row['tourcategory'], $row['country'], $row['price'], $row['thumbnail'], $row['season'] );
            }
            
            $stmt = null;
            $pdo = null;
            return $itinerary;
        }

        
    }
?>