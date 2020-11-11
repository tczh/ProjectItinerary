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
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$Review = new Review($db);

// set ID property of record to read
$Review->reviewid = isset($_GET['reviewid']) ? $_GET['reviewid'] : die();
$Review->userid = isset($_GET['userid']) ? $_GET['userid'] : die();
$Review->itineraryid = isset($_GET['itineraryid']) ? $_GET['itineraryid'] : die();
$Review->rate = isset($_GET['rate']) ? $_GET['rate'] : die();
$Review->status = isset($_GET['status']) ? $_GET['status'] : die();
$Review->date = isset($_GET['date']) ? $_GET['date'] : die();
$Review->message = isset($_GET['message']) ? $_GET['message'] : die();

$stmt = $Review->InsertReview();
echo $stmt;

?>
