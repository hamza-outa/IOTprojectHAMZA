<?php
	if(isset($_POST["from_date"], $_POST["to_date"])) {
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
?>
