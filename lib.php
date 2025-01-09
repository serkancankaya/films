<?php
function db_conn(){
    $servername = "localhost";
    $username = "k2204109050";
    $password = "2204109050";
    $dbname = "k2204109050";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}