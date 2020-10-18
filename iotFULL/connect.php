<?php
//script om te verbinden met de database
/*
$MyUsername = "student_11900456";
$MyPassword = "kQ92NTbPGDBI";
$MyHostname = "localhost";


$conn = mysqli_connect($MyHostname , $MyUsername, $MyPassword, "student_11900456");
$selected = mysql_select_db("student_11900456",$dbh);
*/

$servername = "localhost";
$username = "student_11900456";
$password = "kQ92NTbPGDBI";
$dbname = "student_11900456";

// Create connection
$conn = new mysqli($servername,$username,$password,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
