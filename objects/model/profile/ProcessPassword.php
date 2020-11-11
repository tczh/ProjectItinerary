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
    $password= $_POST["password"];
    # Hash entered password
 
    # Add new user
    $userid= $_POST["userid"];
    $status = $profile->editAddress($userid, $password);
    if($status){
        echo "Registered successfully";
        header("Location: ../../ProfilePage.php");
        exit;
    }
    else{
        echo "Failed to register";
    }
?>