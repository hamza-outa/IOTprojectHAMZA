<?php
$MyUsername = "student_11900456";
$MyPassword = "kQ92NTbPGDBI";
$MyHostname = "localhost";

$dbh = mysqli_connect($MyHostname , $MyUsername, $MyPassword);
$selected = mysqli_select_db("student_11900456",$dbh);
?>
