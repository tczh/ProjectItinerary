<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/Review.php';
include_once '../objects/ReviewDetails.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$Review = new ReviewDetails($db);

// set ID property of record to read
$Review->ReviewdetailsID = isset($_GET['ReviewdetailsID']) ? $_GET['ReviewdetailsID'] : die();
$Review->reviewid = isset($_GET['reviewid']) ? $_GET['reviewid'] : die();
$Review->itinerary_details = isset($_GET['itinerary_details']) ? $_GET['itinerary_details'] : die();
$Review->ActivityRate = isset($_GET['ActivityRate']) ? $_GET['ActivityRate'] : die();
$Review->comments = isset($_GET['comments']) ? $_GET['comments'] : die();

$stmt = $Review->InsertReviewDetails();
echo $stmt;

?>
