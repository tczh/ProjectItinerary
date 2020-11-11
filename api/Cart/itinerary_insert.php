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
$cart->userid = isset($_GET['userid']) ? $_GET['userid'] : die();
$cart->itineraryid = isset($_GET['itineraryid']) ? $_GET['itineraryid'] : die();
$cart->itineraryowner = isset($_GET['itineraryowner']) ? $_GET['itineraryowner'] : die();
$cart->tourtitle = isset($_GET['tourtitle']) ? $_GET['tourtitle'] : die();
$cart->tourcategory = isset($_GET['tourcategory']) ? $_GET['tourcategory'] : die();
$cart->country = isset($_GET['country']) ? $_GET['country'] : die();
$cart->price = isset($_GET['price']) ? $_GET['price'] : die();
$cart->thumbnail = isset($_GET['thumbnail']) ? $_GET['thumbnail'] : die();
$cart->season = isset($_GET['season']) ? $_GET['season'] : die();


$stmt = $cart->insert_itinerary_purchased();

?>

