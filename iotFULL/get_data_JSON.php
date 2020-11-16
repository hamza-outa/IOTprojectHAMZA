<?php
/*
$connect = mysqli_connect("localhost","student_11900456","kQ92NTbPGDBI","student_11900456");
$sql = "SELECT * FROM sensTest";


$result = mysqli_query($connect, $sql);


while( $data = mysqli_fetch_array($result) ) {

	$datum[] = $data['date'];
	$temp[] = $data['temperature'];
	$hum[] = $data['humidity'];

}

mysqli_close($connect);

$json = array('datum' => $datum, 'temp' => $temp, 'hum' => $hum);

echo json_encode($json);
*/



$connect = mysqli_connect("localhost","student_11900456","kQ92NTbPGDBI","student_11900456");
$sql1 = "SELECT sensoren.sensNaam, sensor_data.waarde, sensor_data.date FROM sensoren JOIN sensor_data ON sensoren.ID = sensor_data.sensorID WHERE sensoren.sensNaam = 'temperature' ";
$sql2 = "SELECT sensoren.sensNaam, sensor_data.waarde, sensor_data.date FROM sensoren JOIN sensor_data ON sensoren.ID = sensor_data.sensorID WHERE sensoren.sensNaam = 'humidity' ";



$result1 = mysqli_query($connect,$sql1);
$result2 = mysqli_query($connect,$sql2);

while ($data1 = mysqli_fetch_array($result1) ) {
		$temp[] = $data1['waarde'];
		$datum[] = $data1['date'];
}

while ($data2 = mysqli_fetch_array($result2) ) {
		$hum[] = $data2['waarde'];
}


mysqli_close($connect);

$json = array('datum' => $datum, 'temp' => $temp, 'hum' => $hum);


echo json_encode($json);



?>
