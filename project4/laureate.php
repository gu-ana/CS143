<?php
// get the id parameter from the request

error_reporting(E_ALL);

// display error messages in the output page

// log error messages in /tmp/php-error.log
ini_set("log_errors", "1");
ini_set("error_log", "/tmp/php-error.log");

$id = strval($_GET['id']);


// set the Content-Type header to JSON, 
// so that the client knows that we are returning JSON data
header('Content-Type: application/json');

$mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$filter = ['id' => $id ];
//$filter = [];
$options = ["projection" => ['_id' => 0]];
$query = new MongoDB\Driver\Query($filter, $options);
$rows = $mng->executeQuery("nobel.laureates", $query);

/*
foreach($rows as $row) {
	      echo json_encode($row);
	   }
*/

$laureate = current($rows->toArray());
if (!empty($laureate)) {
   echo json_encode($laureate);
}

?>
