<?php
include "lib.php";
$conn = db_conn();
$stmt = $conn->prepare("DELETE FROM films WHERE id=?");
$stmt->bind_param("i", $_GET["id"]);
$stmt->execute();
$stmt->close();
$conn->close();
header("location:index.php");