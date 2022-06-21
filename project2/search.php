   <html>
   <body>
     <h1> Search.php </h1>
     <form>
       Actor/Actress Name: <input type="text" name="actor" placeholder="Search...">
       <input type="submit">
     </form>
     <form>
       Movie Name: <input type="text" name="movie" placeholder="Search...">
       <input type="submit">
     </form>
   </body>
   <?php 
    $db = new mysqli('localhost', 'cs143', '', 'class_db'); 
    if ($db->connect_errno > 0) {
   die('Unable to connect to database [' . $db->connect_error . ']');
   }
   $actor = $_GET['actor'];
   $movie = $_GET['movie'];
   if(empty($actor) && empty($movie)){
   echo "<h4> Heh, you didn't search anything </h4>";
   }
   elseif(!empty($actor) && !empty($movie)) {
   echo "<h4> Hey dude, cant do that, gotta pick one! </h4>";
   }
   elseif(!empty($actor)){
   $parts = explode(" ", trim($actor));
   $query = "";
   if ($parts[0]){
   $query=$query."SELECT first, last, dob, id
             FROM Actor
             WHERE (first LIKE '%$parts[0]%' OR last LIKE '%$parts[0]%')";
   $rs = $db->query($query);
   }
   
   foreach (array_slice($parts,1) as $part) {
   $query = $query."AND
	     (first LIKE '%$part%' OR last LIKE '%$part%')";
   $rs = $db->query($query);
   } 
   
   echo "<h4>Actors:</h4>";
   echo "<table class = center border = '1'>
	 <tr>
	   <th>Name</th>
	   <th>Date of Birth</th>
	 </tr>";
	 while($row = $rs->fetch_assoc()) {
	 
	 echo "<tr>";
       $full_name = $row['first']." ".$row['last'];
       $id = $row['id'];
       echo "<td><a href='./actor.php?id=$id'>" . "$full_name" . "</a></td>";
       echo "<td>" . $row['dob'] . "</td>";
       echo "</tr>";
	 
	 }
	 echo "</tables>";

}
elseif(!empty($movie)) {
echo "movies are gr8";
$parts = explode(" ", trim($movie));

$query = "";

if ($parts[0]){
   $query=$query."SELECT id, title, year
             FROM Movie WHERE (title LIKE '%$parts[0]%')";
$rs = $db->query($query);

}
if(!$rs) {
$errmsg = $db->error;
print "Query failed: $errmsg <br>";
exit(1);
}


foreach (array_slice($parts,1) as $part) {
   $query = $query."AND
(title LIKE '%$part%')";
$rs = $db->query($query);
}



echo "<h4>matching movies:</h4>";
   echo "<table border = '1'>
         <tr>
           <th>title</th>
           <th>year</th>
         </tr>";
	 while($row = $rs->fetch_assoc()) {
	 echo "<tr>";
    $id = $row['id'];
    echo "<td><a href='./movie.php?id=$id'>" . $row['title'] . "</a></td>";
    echo "<td>" . $row['year'] . "</td>";
    echo "</tr>";

	 }
	 echo "</tables>";

}
$rs.free();

   ?>
   
   </html>
