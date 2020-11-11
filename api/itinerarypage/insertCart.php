<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/AddCart.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$cart = new AddCart($db);

// set ID property of record to read
$cart->userid = isset($_GET['userid']) ? $_GET['userid'] : die();
$cart->itineraryid = isset($_GET['itineraryid']) ? $_GET['itineraryid'] : die();


$stmt = $cart->insertCart();
?>

