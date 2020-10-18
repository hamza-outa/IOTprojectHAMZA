<?php


	if(isset($_POST["from_date"], $_POST["to_date"])) {
		$mysqli = mysqli_connect("localhost","student_11900456","kQ92NTbPGDBI","student_11900456");
		$output = '';
		$query = " SELECT * FROM sensTest WHERE date BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."' ORDER BY id desc ";
		$result = mysqli_query($mysqli, $query);

		$output .= '<div id="table-header" style="max-width:100%; height:30px;" ><h1 id="table-interface" >Table Interface</h1></div>';
		$output .= "
		<table class='table table-bordered'>
			<tr>
				<th width='5%'>ID</th>
				<th width='55'>DATE</th>
				<th width='20%'>TEMPERATURE</th>
				<th width='20%'>HUMIDITY</th>
			</tr>
		";
		if( mysqli_num_rows($result) > 0 ) {
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
		}else {
			$output .= '
				<tr>
					<td colspan="4" >No Order Found</td>
				</tr>
			';
		}
		$output .= '</table>';
		echo $output;
	}

?>
