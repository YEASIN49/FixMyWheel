<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$databaseName = "fixmywheel";

$conn = new mysqli($serverName, $userName, $password, $databaseName);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?>