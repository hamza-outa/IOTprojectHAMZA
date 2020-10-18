<?php

$connect = mysqli_connect("localhost","student_11900456","kQ92NTbPGDBI","student_11900456");
$sql = "SELECT * FROM sensTest";

$result = mysqli_query($connect, $sql);

$date = array();
$temp = array();
$hum = array();

while( $data = mysqli_fetch_array($result) ) {

	$datum[] = $data['date'];
	$temp[] = $data['temperature'];
	$hum[] = $data['humidity'];

}

mysqli_close($connect);

$json = array('datum' => $datum, 'temp' => $temp, 'hum' => $hum);

echo json_encode($json);

?>
