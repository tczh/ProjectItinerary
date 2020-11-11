<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/Itinerary/ItineraryDetails.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$ItineraryDetails = new ItineraryDetails($db);

// set ID property of record to read
$ItineraryDetails->itineraryid = isset($_GET['itineraryid']) ? $_GET['itineraryid'] : die();
$ItineraryDetails->itineraryowner = isset($_GET['itineraryowner']) ? $_GET['itineraryowner'] : die();
$ItineraryDetails->daynumber = isset($_GET['daynumber']) ? $_GET['daynumber'] : die();
$ItineraryDetails->location = isset($_GET['location']) ? $_GET['location'] : die();
$ItineraryDetails->activity = isset($_GET['activity']) ? $_GET['activity'] : die();
$ItineraryDetails->activitynumber = isset($_GET['activitynumber']) ? $_GET['activitynumber'] : die();
$ItineraryDetails->description = isset($_GET['description']) ? $_GET['description'] : die();
$ItineraryDetails->starttime = isset($_GET['starttime']) ? $_GET['starttime'] : die();
$ItineraryDetails->endtime = isset($_GET['endtime']) ? $_GET['endtime'] : die();


$stmt = $ItineraryDetails->InsertItineraryDetails();
echo $stmt;

?>
