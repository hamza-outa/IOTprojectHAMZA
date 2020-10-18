<?php
//Database connection

//require_once 'connect.php';

$servername = "localhost";
$username = "student_11900456";
$password = "kQ92NTbPGDBI";
$dbname = "student_11900456";

// Create connection
$conn = new mysqli($servername,$username,$password,$dbname);

//insert into database
if(!empty($_POST)) {
  date_default_timezone_set('Europe/Athens');
 $dateS = date('m/d/Y h:i:s', time());
 $temp = $_POST['temperature'];
 $hum = $_POST['humidity'];
 mysqli_query($conn, "insert into sensTest (temperature, humidity) values ('$temp', '$hum')");

echo "data is toegevoegd aan de database:";
 echo "datum : ".$dateS."</br>";
 echo "temperatuur : ".$temp."°C</br>";
 echo "vochtigheid : ".$hum."%</br>";
}
?>
