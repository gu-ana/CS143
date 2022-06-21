 <?php
// get the id parameter from the request
error_reporting(E_ALL);

// display error messages in the output page

// log error messages in /tmp/php-error.log
ini_set("log_errors", "1");
ini_set("error_log", "/tmp/php-error.log");
$id = intval($_GET['id']);

// set the Content-Type header to JSON, 
// so that the client knows that we are returning JSON data
header('Content-Type: application/json');
$db = new mysqli("localhost", "cs143", "", "class_db");
if ($db->connect_errno > 0) {
   die('Unable to connect to database [' . $db->connect_error . ']');
      }

$query = "";
$query = $query."SELECT * FROM Laureate WHERE id=$id";
$rs = $db->query($query);
$row_cnt = $rs->num_rows;

if($row_cnt != 0) {
//this is a person
       while($row = $rs->fetch_assoc()) {
	 $given_name = (is_null($row["givenName"]) ? NULL : $row["givenName"]) ;
	 $family_name = (is_null($row["familyName"]) ? NULL : $row["familyName"]) ;
	 $gender = (is_null($row["gender"]) ? NULL : $row["gender"]) ;
	 $birth_date = (is_null($row["birth_date"]) ? NULL : $row["birth_date"]) ;
	 $birth_city = (is_null($row["birth_city"]) ? NULL : $row["birth_city"]) ;
	 $birth_country = (is_null($row["birth_country"]) ? NULL : $row["birth_country"]) ;
	}
	$query_nobelPrize = "SELECT * FROM Prize WHERE id=$id";
	$rs = $db->query($query_nobelPrize);
	$nobel_prizes = array();
	$affiliations = array();
	while($row = $rs->fetch_assoc()) {
	  $award_year = ($row["awardYear"] == NULL ? NULL : $row["awardYear"]);
	  $category = ($row["category"] == NULL ? NULL : $row["category"]);
	  $sortOrder = ($row["sortOrder"] == NULL ? NULL : $row["sortOrder"]);
	  $affiliation_name = ($row["affiliation_name"] == NULL ? NULL : $row["affiliation_name"]);
	  $affiliation_city = ($row["affiliation_city"] == NULL ? NULL : $row["affiliation_city"]);
	  $affiliation_country = ($row["affiliation_country"] == NULL ? NULL : $row["affiliation_country"]);
	  $affiliations = (object) array_filter(["name"=> (object) array_filter([ "en" => $affiliation_name ]),
	  		  		     "city"=> (object) array_filter([ "en" => $affiliation_city]),
					     "country"=> (object) array_filter(["en" =>$affiliation_country])]);
	  $nobel_prizes[] = array_filter(array("awardYear"=>$award_year,
					       "category"=> (object) ["en" => $category], "sortOrder"=>$sortOrder, "affiliations"=> [$affiliations]));
	}	
$output = (object) [
	"id" => strval($id),
	"givenName" => (object) array_filter([
		    "en" => $given_name
		    ]),
	"familyName" => (object) array_filter([
		     "en" => $family_name
		     ]),
	"gender" => $gender,
	"birth" => (object) array_filter([
		"date" => $birth_date,
		"place" => (object) array_filter([
			"city" => (object) array_filter([
		       	       "en" => $birth_city
		       	     ]),
			"country" => (object) array_filter([
			  	"en" => $birth_country
			     ])
			])]),
	"nobelPrizes" => (array) $nobel_prizes
	
];
}
else {
$query = "SELECT * FROM Org WHERE id=$id";
$rs = $db->query($query);
    while($row = $rs->fetch_assoc()) {
	 $org_name = $row["orgName"];
	 $founded_date = ($row["founded_date"] == "NULL" ? NULL : $row["founded_date"]);
	 $founded_city = ($row["founded_city"] == "NULL" ? NULL : $row["founded_city"]);
	 $founded_country = ($row["founded_country"] == "NULL" ? NULL : $row["founded_country"]);	 
	}
	$query_nobelPrize = "SELECT * FROM Prize WHERE id=$id";
        $rs = $db->query($query_nobelPrize);
	$nobel_prizes = array();
	while($row = $rs->fetch_assoc()) {
		   $award_year = ($row["awardYear"] == "NULL" ? NULL : $row["awardYear"]);
		   $category = ($row["category"] == "NULL" ? NULL : $row["category"]);
		   $sortOrder = ($row["sortOrder"] == "NULL" ? NULL : $row["sortOrder"]);
		   $nobel_prizes[] = array("awardYear"=>$award_year,
		   		           "category"=> (object) ["en" => $category],
					   "sortOrder"=>$sortOrder);
		   
	}


$output = (object) [
	"id" => strval($id),
	"orgName" => (object) [
		    "en" => $org_name
		    ],
	"founded" => (object) array_filter([
		     "date" => $founded_date,
		     "place" => (object) array_filter([
		     	     "city" => (object) array_filter([
			     	    "en" => $founded_city
				    ]),
				    
			     "country" => (object) array_filter([
			     	    "en" => $founded_country
				    ])
		     ])
	]),
	"nobelPrizes" => (array) $nobel_prizes
];


}




/*echo json_encode($output); */
echo json_encode(array_filter((array) $output, function($v) {return !is_null($v); })); 

?>
