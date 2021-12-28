<?php
$servername = "localhost";
$dBUsername = "root";
$dBPassword = "pass9090";
$dBName = "hadlesre";

$conn = mysqli_connect($servername,$dBUsername,$dBPassword,$dBName);
if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}
?>
