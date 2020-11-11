<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/Cart/Cart.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$cart = new Cart($db);

// set ID property of record to read
$cart->paymentid = isset($_GET['paymentid']) ? $_GET['paymentid'] : die();
$cart->userid = isset($_GET['userid']) ? $_GET['userid'] : die();
$cart->itineraryowner = isset($_GET['itineraryowner']) ? $_GET['itineraryowner'] : die();
$cart->itineraryid = isset($_GET['itineraryid']) ? $_GET['itineraryid'] : die();
$cart->ispaid = isset($_GET['ispaid']) ? $_GET['ispaid'] : die();
$cart->billingemail = isset($_GET['billingemail']) ? $_GET['billingemail'] : die();


$stmt = $cart->itinerary_purchased();

?>



