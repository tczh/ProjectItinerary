<?php
// required headers
// Retrieve 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/Statistics.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$Statistics = new Statistics($db);

// query products

$Statistics->Country = isset($_GET['Country']) ? $_GET['Country'] : die();

$stmt = $Statistics->ViewStats();
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
            "statisticsID" => $statisticsID,
            "Country" => $Country,
            "count" => $count,
            "month" => $month

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

