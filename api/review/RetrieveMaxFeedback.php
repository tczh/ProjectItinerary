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
$Review = new Review($db);

// set ID property of record to rea
$stmt = $Review->retrieveLatestReview();
if($stmt) {

    // Add info node (1 per response)
    $date = new DateTime(null, new DateTimeZone('Asia/Singapore'));

    // create array
    $item = array(
        "reviewid" => $Review->reviewid
        

    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($item);
}
else {
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user item does not exist
    echo json_encode(array("message" => "Unable to find."));
}
?>
