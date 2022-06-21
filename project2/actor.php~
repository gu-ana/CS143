
  <body>
    <H1> Actor.php </h1>
<a href='./search.php'>Click here to go back to search.php</a>    
 



  </body>
  <?php
   $db = new mysqli('localhost', 'cs143', '', 'class_db');
   if ($db->connect_errno > 0) {
      die('Unable to connect to database [' . $db->connect_error . ']');
  }
  $id = $_GET['id'];
  $query = "SELECT * 
	    FROM Actor
	    WHERE id = $id";
  $rs = $db->query($query);
  echo "<h3> Personal Information:  </h3>";
  echo "<table border = '1'>
	<tr>
<th>Name</th>
<th>Sex </th>
<th>Date of Birth </th>
<th>Date of Death </th>
</tr>";
	while ($row = $rs->fetch_assoc()) {
	$full_name = $row['first']." ".$row['last'];
	echo "<tr>";
      echo "<td> $full_name </td>";
      echo "<td>" . $row['sex'] . " </td>";
      echo "<td>". $row['dob'] ."</td>";
      if(is_null($row['dod'])) {
      echo "<td> Alive </td>";
      }
      else {
      echo "<td>". $row['dod'] ."</td>";
      }
      echo "</tr>";
	}
	echo "</table>";
  echo "<h3> Actor's Movie and roles </h3>";
  echo "<table border='1'>
    <tr>
<th> Role </th>
<th> Movie Title </th>
    </tr>";

    $query = "SELECT M.title, M.id, MA.role
              FROM Movie M, MovieActor MA
              WHERE M.id = MA.mid AND MA.aid = $id";

    $rs = $db->query($query);
    while($row = $rs->fetch_assoc()) {

    echo "<tr>";
      echo "<td>". $row['role']." </td>";
      echo "<td> <a href='./movie.php?id=".$row['id']."'>" . $row['title'] . "</a></td>";
      echo "</tr>";
    
    }
    
    echo "</table>";
  
  $rs.free();
  ?>
</html>
