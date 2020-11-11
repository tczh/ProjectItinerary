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
include_once '../objects/Itinerary/ItineraryDetails.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$Itinerary = new Itinerary($db);

// set ID property of record to read
$stmt = $Itinerary->retrieveLatestItinerary();

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
            "itineraryowner"=>$itineraryowner,
            "tourtitle" => $tourtitle,
            "tourcategory" => $tourcategory,
            "country" => $country,
            "price" => $price,
            "thumbnail" => $thumbnail,
            "season" => $season

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
