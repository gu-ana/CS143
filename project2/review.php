  <html>
<body>
<H1> Review.php </H1>

<h3> Add new review below: </h3>
<form method="post">
Name: <input type="text" name="name" required>
Rating: <input type="text" name="rating" required>
Comment: <textarea name="review" required cols="40" rows="10"> </textarea>

<input type="submit">
</form>
</body>
<?php
$id = $_GET['id'];
    $db = new mysqli('localhost', 'cs143', '', 'class_db');
    if ($db->connect_errno > 0) {
die('Unable to connect to database [' . $db->connect_error . ']');
}

 $query="CREATE TABLE IF NOT EXISTS Review (
	mid INT PRIMARY KEY,
	name VARCHAR(50),
	rating INT,
	comment VARCHAR(500),
	timestamp TIMESTAMP
	)";

$rs = $db->query($query);
if(!$rs) {
$errmsg = $db->error;
print "Query failed: $errmsg <br>";
exit(1);
}

$name = $_POST['name'];
$rating = $_POST['rating'];
$review = $_POST['review'];


$query = "INSERT INTO Review (mid, name, rating, comment, timestamp)
	  VALUES ($id, '$name', $rating, '$review', CURRENT_TIMESTAMP())";


echo "$query";

$rs = $db->query($query);
if($rs) {
//succeeded

echo "Your review has successfully been submitted Click <a href='./movie.php?id=". $id."'>". "here". "</a>"; 
}
else {

$errmsg = $db->error;
print "Query failed: $errmsg <br>";
    exit(1); 

}
  


?>
</html>
