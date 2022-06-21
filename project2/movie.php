  <html>
  <body>
    <H1> Movie.php </h1>
     <a href='./search.php'>Click here to go back to search.php</a>
 



  </body>
  <?php
   $db = new mysqli('localhost', 'cs143', '', 'class_db');
   if ($db->connect_errno > 0) {
      die('Unable to connect to database [' . $db->connect_error . ']');
  }
  $id = $_GET['id'];
  $query = "SELECT * 
	    FROM Movie
	    WHERE id = $id";
  $rs = $db->query($query);
  echo "<h3> Movie Information:  </h3>";
  echo "<table border = '1'>
	<tr>
<th>Title</th>
<th>Year </th>
<th>Rating</th>
<th>Company </th>
</tr>";
	while ($row = $rs->fetch_assoc()) {
	echo "<tr>";
      echo "<td>". $row['title'] ."</td>";
      echo "<td>" . $row['year'] . " </td>";
      echo "<td>". $row['rating'] ."</td>";
      echo "<td>". $row['company'] ."</td>";
/*      if(is_null($row['dod'])) {
      echo "<td> Alive </td>";
      }
      else {
      echo "<td>". $row['dod'] ."</td>";
      }
      */
      echo "</tr>";
	}
	echo "</table>";
  echo "<h3> Actor's in this movie and their roles: </h3>";
  echo "<table border='1'>
    <tr>
<th> Name </th>
<th> Role </th>
    </tr>";

    $query = "SELECT MA.aid, A.first, A.last, MA.role
              FROM Movie M, MovieActor MA, Actor A
              WHERE M.id = $id AND MA.mid = $id AND A.id = MA.aid";
    $rs = $db->query($query);
    while($row = $rs->fetch_assoc()) {
     $full_name = $row['first']." ".$row['last'];
    echo "<tr>";
      echo "<td> <a href='./actor.php?id=".$row['aid']."'>" . $full_name . "</a></td>";
      echo "<td>". $row['role']." </td>";

      echo "</tr>";
    
    }
    
    echo "</table>";
  echo "<a href='./review.php?id=". $id."'>"."Click here to add your own review to this Movie ". "</a>";

  $query = "SELECT AVG(rating) AS average
  FROM Review 
  WHERE mid = $id";
  
  $rs = $db->query($query);
  $has_ratings = "false";
  while($row = $rs->fetch_assoc()) {
  if(is_null($row['average'])) {
   echo "<h3> This movie does not have any ratings yet.</h3>";   
  }
  else {
  echo "<h3> This movie has an average rating of ". $row['average']. " from all users who cast their vote </h3>";
  }
  }
   $query = "SELECT *
  FROM Review
  WHERE mid = $id";
  $rs = $db->query($query);
  while($row = $rs->fetch_assoc()) {
  echo $row['name']." gave a rating of ".$row['rating']." Their comments:";
  print $row['comment'];
  }
  
  $rs.free();
  ?>
</html>
