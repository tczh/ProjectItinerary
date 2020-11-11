<?php 
    class Itinerary{
        private $itineraryid;
        private $itineraryowner;
        private $tourtitle;
        private $tourcategory;
        private $country;
        private $price;
        private $thumbnail;
        private $season;

        public function __construct($itineraryid, $itineraryowner,$tourtitle, $tourcategory, $country, $price, $thumbnail, $season){
            $this->itineraryid = $itineraryid;
            $this->itineraryowner = $itineraryowner;
            $this->tourtitle = $tourtitle;
            $this->tourcategory = $tourcategory;
            $this->country = $country;
            $this->price = $price;
            $this->thumbnail = $thumbnail;
            $this->season = $season;
        }
        public function getItineraryid(){
            return $this->itineraryid;
        }
        public function getItineraryowner(){
            return $this->itineraryowner;
        }
        public function getTourtitle(){
            return $this->tourtitle;
        }
        public function getTourcategory(){
            return $this->tourcategory;
        }
        public function getCountry(){
            return $this->country;
        }
        public function getPrice(){
            return $this->price;
        }
        public function getThumbnail(){
            return $this->thumbnail;
        }
        public function getSeason(){
            return $this->season;
        }
    }
?>