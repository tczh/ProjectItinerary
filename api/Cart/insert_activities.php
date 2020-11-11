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
$cart->detailsid = isset($_GET['detailsid']) ? $_GET['detailsid'] : die();
$cart->itineraryid = isset($_GET['itineraryid']) ? $_GET['itineraryid'] : die();
$cart->itineraryowner = isset($_GET['itineraryowner']) ? $_GET['itineraryowner'] : die();
$cart->daynumber = isset($_GET['daynumber']) ? $_GET['daynumber'] : die();
$cart->location = isset($_GET['location']) ? $_GET['location'] : die();
$cart->activity = isset($_GET['activity']) ? $_GET['activity'] : die();
$cart->activitynumber = isset($_GET['activitynumber']) ? $_GET['activitynumber'] : die();
$cart->description = isset($_GET['description']) ? $_GET['description'] : die();
$cart->starttime = isset($_GET['starttime']) ? $_GET['starttime'] : die();
$cart->endtime = isset($_GET['endtime']) ? $_GET['endtime'] : die();

$stmt = $cart->insert_activities();

?>

