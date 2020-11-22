<?php
/*	if(isset($_POST["from_date"], $_POST["to_date"])) {
		$mysqli = mysqli_connect("localhost","student_11900456","kQ92NTbPGDBI","student_11900456");
		$query = " SELECT * FROM sensTest WHERE date BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."' ";
		$result = mysqli_query($mysqli, $query);
		if( mysqli_num_rows($result) > 0 ) {
			while( $row = mysqli_fetch_array($result) ) {
				$datum[] = $row['date'];
				$temp[] = $row['temperature'];
				$hum[] = $row['humidity'];
			}
		}
		$json = array('datum' => $datum, 'temp' => $temp, 'hum' => $hum);
		echo json_encode($json);
	}
*/

if(isset($_POST["from_date"], $_POST["to_date"])) {
	$date1 = $_POST["from_date"];
	$date2 = $_POST["to_date"];

	$connect = mysqli_connect("localhost","student_11900456","kQ92NTbPGDBI","student_11900456");
	$sql1 = "SELECT sensoren.sensNaam, sensor_data.waarde, sensor_data.date FROM sensoren JOIN sensor_data ON sensoren.ID = sensor_data.sensorID WHERE sensoren.sensNaam = 'temperature' AND sensor_data.date >= '".$date1."' AND sensor_data.date <= '".$date2."' ";
	$sql2 = "SELECT sensoren.sensNaam, sensor_data.waarde, sensor_data.date FROM sensoren JOIN sensor_data ON sensoren.ID = sensor_data.sensorID WHERE sensoren.sensNaam = 'humidity' AND sensor_data.date >= '".$date1."' AND sensor_data.date <= '".$date2."' ";


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


}

?>
