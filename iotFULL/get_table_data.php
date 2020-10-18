<?php
	//connecting
	$mysqli = mysqli_connect("localhost","student_11900456","kQ92NTbPGDBI","student_11900456");
	$query = "SELECT * FROM sensTest ORDER BY id desc";
	$result = mysqli_query($mysqli, $query);
	//output
	$output = '';
	$output .= '<div id="table-header" style="max-width:100%; height:50px;" ><h1 id="table-interface" style:"padding10px;" >tabel</h1></div>';
	$output .= "

		<table class='table table-bordered'>
			<tr>
				<th width='5%'>ID</th>
				<th width='55%'>DATUM</th>
				<th width='20%'>TEMPERATUUR</th>
				<th width='20%'>VOCHTIGHEID</th>
			</tr>
	";
	while( $row = mysqli_fetch_array($result) ) {

				$output .= "
					<tr>
				<td>  {$row['ID']}  </td>
				<td>  {$row['date']}  </td>
				<td>  {$row['temperature']}  </td>
				<td>  {$row['humidity']}  </td>
					</tr>
		";
	}
	$output .= '</table>';
	echo $output;
?>
