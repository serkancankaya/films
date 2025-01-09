<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
      function sil(id){
        var cevap = confirm("Are you sure?");
        if(cevap){
          document.location.href="delete.php?id="+id;
        }
      }
    </script>

</head>
<body>
    <?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = "localhost";
$username = "k2204109050";
$password = "2204109050";
$dbname = "k2204109050";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT f.id, name, duration, artists, description, lang FROM films f INNER JOIN lang l ON f.lang_id=l.id ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<h1>Films</h1>";
  echo "<p><a href='newfilm.php'>New Film</a></p>";
  echo "<table border=1>";
  echo "<tr><td>ID</td><td>Name</td><td>Duration</td><td>Artists</td><td>DEsc</td><td>Lang</td></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>$row[id]</td>";
    echo "<td>$row[name]</td>";
    echo "<td>$row[duration]</td>";
    echo "<td>$row[artists]</td>";
    echo "<td>$row[description]</td>";
    echo "<td>$row[lang]</td>";
    echo "<td> <a href='editfilm.php?id=$row[id]'>Edit</a>";
    echo " | <a href='javascript:sil($row[id])'>Delete</a></td>";
    echo "</tr>";
  }
    /*
  while($row = $result->fetch_object()) {
    echo "<tr>";
    echo "<td>$row->id</td>";
    echo "<td>$row->name</td>";
    echo "<td>$row->duration</td>";
    echo "<td>$row->artists</td>";
    echo "<td>$row->description</td>";
    echo "<td>$row->lang</td>";
    echo "</tr>";
  }
    */
  echo "</table>";

} else {
  echo "0 results";
}
$conn->close();


?>
</body>
</html>