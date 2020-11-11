<?php 
    class User{
        private $userid;
        private $email;
        private $hashedPassword;
        public function __construct($userid, $email,$hashedPassword){
            $this->userid = $userid;
            $this->email = $email;
            $this->hashedPassword = $hashedPassword;
        }
        public function getUserId(){
            return $this->userid;
        }
        public function getEmail(){
            return $this->email;
        }
        public function getHashedPassword(){
            return $this->hashedPassword;
        }
    }
?>