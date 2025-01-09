<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "lib.php";
$conn = db_conn();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("INSERT INTO films VALUES (NULL, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissi", $_POST["name"], $_POST["duration"], $_POST["artists"], $_POST["description"], $_POST["lang_id"]);
    $stmt->execute();
    
    $stmt->close();
    $conn->close();
    header("location:index.php");

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Add Film</h1>
    <form action="newfilm.php" method="POST">
        Name:<input name="name"><br />
        Duration:<input name="duration"><br />
        Artists:<input name="artists"><br />
        Description:<br /><textarea name="description"></textarea><br />
        Language:
        <select name="lang_id">
            <?php
            $sql = "SELECT * FROM lang";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
                echo "<option value=$row[id]>$row[lang]</option>";
            }
            $conn->close();
            ?>
        </select >
        <br />
        <input type="submit" value="Save">

</form>
</body>
</html>