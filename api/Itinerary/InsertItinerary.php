<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/Itinerary/Itinerary.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$Itinerary = new Itinerary($db);

// set ID property of record to read
$Itinerary->itineraryowner = isset($_GET['itineraryowner']) ? $_GET['itineraryowner'] : die();
$Itinerary->tourtitle = isset($_GET['tourtitle']) ? $_GET['tourtitle'] : die();
$Itinerary->tourcategory = isset($_GET['tourcategory']) ? $_GET['tourcategory'] : die();
$Itinerary->country = isset($_GET['country']) ? $_GET['country'] : die();
$Itinerary->price = isset($_GET['price']) ? $_GET['price'] : die();
$Itinerary->thumbnail = isset($_GET['thumbnail']) ? $_GET['thumbnail'] : die();
$Itinerary->season = isset($_GET['season']) ? $_GET['season'] : die();
$Itinerary->generaldetails = isset($_GET['generaldetails']) ? $_GET['generaldetails'] : die();


$stmt = $Itinerary->InsertItinerary();
echo $stmt;

?>
