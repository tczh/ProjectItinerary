<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/Purchases.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$purchases = new Purchases($db);

// set ID property of record to read
$purchases->userid = isset($_GET['userid']) ? $_GET['userid'] : die();


$stmt = $purchases->retrieve_itinerary_purchased();

$num = $stmt->rowCount();

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
            "userid" => $userid,
            "itineraryid" => $itineraryid,
            "itineraryid" => $itineraryid,
            "itineraryowner" => $itineraryowner,
            "tourtitle"=>$tourtitle,
            "tourcategory"=>$tourcategory,
            "country"=>$country,
            "price"=>$price,
            "thumbnail"=>$thumbnail

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
  
    // tell the user item does not exist
    echo json_encode(array("message" => "Unable to find."));
}
?>

