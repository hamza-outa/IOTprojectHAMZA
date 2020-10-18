<?php

	/*$MyUsername = "student_11900456";
	$MyPassword = "kQ92NTbPGDBI";
	$MyHostname = "localhost";

	$mysqli = mysqli_connect($MyHostname , $MyUsername, $MyPassword, "student_11900456");

	date_default_timezone_set('Europe/Brussels');
	$dateS = date('Y/m/d H:i:s', time());
	$temp = $_POST['temp'];
	$hum = $_POST['hum'];
	echo $dateS;

	$sql = "INSERT INTO sensTest (date, temperature, humidity) VALUES ( '$dateS', '$temp', '$hum' )";

mysqli_query( $mysqli, $sql );*/


//Database connection
require_once 'connect.php';

//insert into database
if(!empty($_POST)) {
 $temp = $_POST['temperature'];
 $hum = $_POST['humidity'];
 mysqli_query($conn, "insert into sensTest (temperature, humidity, pressure) values ('$temp', '$hum', '$pr')");

?>
