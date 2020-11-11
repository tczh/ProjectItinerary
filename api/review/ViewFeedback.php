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
$Review->itineraryid = isset($_GET['itineraryid']) ? $_GET['itineraryid'] : die();
  
// read the details of product to be edited
$stmt = $Review->retrieveOnlyFeedback($Review->itineraryid);
$num = $stmt->rowCount();

// check if more than 0 record found
if($num > 0) {

    // products array
    $result_arr = array();
    $result_arr["records"] = array();

    while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $item = array(
            "itineraryid"=>$itineraryid,
            "reviewid"=>$reviewid,
            "userid" => $userid,
            "rate" => $rate,
            "status"=>$status,
            "date" => $date,
            "message" => $message

        );

        array_push($result_arr["records"], $item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode($result_arr);
}
else {
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no items found
    echo json_encode(
        array("message" => "No records found.")
    );
}