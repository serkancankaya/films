<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "lib.php";
$conn = db_conn();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("UPDATE films SET name=?, duration=?, artists=?, description=?, lang_id=? WHERE id=?");
    $stmt->bind_param("sissii", $_POST["name"], $_POST["duration"], $_POST["artists"], $_POST["description"], $_POST["lang_id"], $_POST["id"]);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header("location:index.php");
}
if(empty($_GET["id"])){
    die("error");
}
$stmt = $conn->prepare("SELECT * FROM films WHERE id=?;");
$stmt->bind_param("i", $_GET["id"]);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc(); 
$stmt->close();


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
    <form action="editfilm.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row["id"];?>" >
        Name:<input name="name" value="<?php echo $row["name"];?>"><br />
        Duration:<input name="duration" value="<?php echo $row["duration"];?>"><br />
        Artists:<input name="artists" value="<?php echo $row["artists"];?>"><br />
        Description:<br /><textarea name="description"><?php echo $row["description"];?></textarea><br />
        Language:
        <select name="lang_id">
            <?php
            $sql = "SELECT * FROM lang";
            $result = $conn->query($sql);
            while($rowLang= $result->fetch_assoc()) {
                $selected = $rowLang["id"]==$row["lang_id"] ? "selected" : "";
                echo "<option value=$rowLang[id] $selected>$rowLang[lang]</option>";
            }
            $conn->close();
            ?>
        </select >
        <br />
        <input type="submit" value="Edit">

</form>
</body>
</html>