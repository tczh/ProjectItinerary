<?php
// required headers
// Retrieve 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/Review.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$review = new Review($db);

// query products

$review->userid = isset($_GET['userid']) ? $_GET['userid'] : die();
  
// read the details of product to be edited
$stmt = $review->retrieveItineraryByUserid($review->userid);
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
            "tourtitle"=>$tourtitle,
            "itineraryImage"=>$itineraryImage,
            "datebought" => $datebought,
            "paymentid" => $paymentid,
            "ActivityRate"=>$ActivityRate,
            "userid" => $userid,

            "itineraryowner" => $itineraryowner,

            "itineraryid" => $itineraryid,

            "ispaid" => $ispaid,
            "status"=>$status,
            "reviewid"=>$reviewid,
            "itinerary_details"=>$itinerary_details

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
?>