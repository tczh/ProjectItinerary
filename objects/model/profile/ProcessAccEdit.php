<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/Profile.php';

    // instantiate database and product object
    $database = new Database();
    $db = $database->getConnection();

    // initialize object
    $profile = new Profile($db);

    # Get parameters passed from register.php
    $userid= $_POST["userid"];
    $email = $_POST["email"];
    $firstname = $_POST["firstname"];
    $lastname=$_POST["lastname"];
    $country= $_POST["country"];

    # Hash entered password
 
    # Add new user
    $status = $profile->editAcc($userid ,$email, $firstname, $lastname, $country);
    if($status){
        echo "Update successfully";
        header("Location: ../../ProfilePage.php");
        exit;
    }
    else{
        echo "Failed to register";
    }
?>