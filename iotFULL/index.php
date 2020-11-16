<html>
<head>
    <title>Raspberry Pi sensorHat data</title>
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" ></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

</head>
<body>
	<div id="header" style="width:100%; height:100px; padding-top:25px;" >
		<h1 id="headerText" ><span>RaspB sensorhat data</span></h1>
	</div>
	<div style="max-width:100%;" >
		<div id="chart-container" >
			<div id="graph-header" style="max-width:100%; height:30px;" >
				<h1 id="graph-interface" >grafiek</h1>
			</div>
			<canvas id="myChart" width="70%" style="margin-top:30px;" ></canvas>
		</div>
		</div>
		<div id="daterangediv" style="height:30px;" ><h1 id="daterangetext" >datum range</h1></div>
		<div id="dateranger" ><br>

				<div style="display:inline-block;  margin-right: 10px;">
					<input type="text" name="from_date" id="from_date" class="form-control" />
				</div>

				<div style="display:inline-block; margin-right: 20px;">
					<input type="text" name="to-date" id="to_date" class="form-control" />
				</div>

				<div style="display:inline-block;">
					<input type="button" name="filter" id="filter" class="button" value="filter" />
				</div>

				<div style="display:inline-block;">
					<input type="button" name="resume" id="resume" class="button" value="resume"/>
				</div>
			<form method="post" >
				<br>
			<input type="number" name="temp" placeholder="temperatuur" id="temperature">
			<input type="number" name="hum" placeholder="vochtigheid" id="humidity">

			<button type="submit" id="indienen">submit</button><br>
			<p id="result"></p>
		</form>
		</div>

		<div id="tabel&filter">
      <h1>tabel</h1>
      <p>kies een selectie</p>
      <select id="filterK" onchange="filterTABEL()">
        <option>kies kolom</option>
        <option value="">alle kolomen</option>
        <option value="temp">temperatuur</option>
        <option value="hum">vochtigheid</option>
      </select>
      <div style="margin-right: 20px;">
        sorteer op  descending
        <input type="checkbox" id="desc" value="DESC" onchange="filterTABEL()">
      </div>

      <br>
      begin
      <input type="date" id="date1">
      <br>
       einde
      <input type="date" id="date2">
      <input type="submit" onclick="filterTABEL()">


      <div id="table" class="table-responsive">
      <p id="userdata"></p>
	</div>
	<script type="text/javascript" >




	$(document).ready(function () {                     //als de document geladen is moet je dit uitvoeren
		$('#indienen').click(function (e) {               // wanneer op de submit knop is gedrukt start de functie
			e.preventDefault();
			var temperature = $('#temperature').val();                    //pakt de gegevens die je ingevult hebt en steekt in een var
			var humidity = $('#humidity').val();
			$.ajax                                          //dit is de ajax stuk die de data naar de form php stuurt om te verwerken
				({
					type: "POST",
					url: "http://11900456.pxl-ea-ict.be/iotFULL/form_submit.php",
					data: { "temperature": temperature, "humidity": humidity},
					success: function (data) {
						$('#result').html(data);                    //de resultaten v/d ingevulde waardes worden gedisplayed TER CONTROLE
						$('#contactform')[0].reset();               //idunno
					}
				});
		});

	});





	//initial chart
	updatechart();
	function updatechart() {
		var xmlhttp = new XMLHttpRequest(), data;
		xmlhttp.onreadystatechange = function() {
			if( xmlhttp.readyState == 4 && xmlhttp.status == 200 ) {
				data = JSON.parse(xmlhttp.responseText);
				drawChart(data.datum, data.temp, data.hum);
			}
		}
		xmlhttp.open("GET","get_data_JSON.php",true);
		xmlhttp.send();
	}
	function drawChart(labels, tempData, humData) {
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: labels,
				datasets: [{
					label: 'Temperatuur',
					data: tempData,
					backgroundColor: ['rgba(222, 7, 157, 0.2)'],
					borderColor: ['rgba(148, 0, 103,1)'],
					borderWidth: 1
				},
				{
					label: 'Vochtigheid',
					data: humData,
					backgroundColor: ['rgba(7, 217, 24, 0.2)'],
					borderColor: ['rgba(4, 148, 16,1)'],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
				yAxes: [{
				ticks: {
				beginAtZero:true
					}
				}]
			},
				legend:{
					position:'right',
					labels:{
						fontColor:"#000000",
						fontSize:15
					}
				},
				layout:{
					padding:25
				}
			},
		});
	}

	//update grafiek elke 2 min
	var updateChart = setInterval(function() {
		$('#myChart').remove();
		$('#chart-container').append('<canvas id="myChart" width="70%" style="margin-top:30px;" ></canvas>');
		updatechart();
	},120000);


  //filter tabel
  function filterTABEL() {

    if($('#desc').is(":checked")) {
      $.ajax({
          type: 'POST',
          url: 'http://11900456.pxl-ea-ict.be/iotFULL/filterT.php',
          data: 'filter='+$('#filterK').val()+'&desc='+$('#desc').val()+'&date1='+$('#date1').val()+'&date2='+$('#date2').val(),
          beforeSend: function(){
              $('.loading-overlay').show();
          },
          success:function(html){
              $('.loading-overlay').hide();
              $('#userdata').html(html);
          }
      });
    }
    //als geen enkele filter is aangeduid gewoon de tabel printen
    else {
      $.ajax({
          type: 'POST',
          url: 'http://11900456.pxl-ea-ict.be/iotFULL/filterT.php',
          data: 'filter='+$('#filterK').val()+'&date1='+$('#date1').val()+'&date2='+$('#date2').val(),
          beforeSend: function(){
              $('.loading-overlay').show();
          },
          success:function(html){
              $('.loading-overlay').hide();
              $('#userdata').html(html);
          }
      });
    }
  }

	//filter grafiek op datum
	$(document).ready(function() {
		$.datepicker.setDefaults({
			dateFormat:'yy-mm-dd'
		});
		$(function(){
			$("#from_date").datepicker();
			$("#to_date").datepicker();
		});
		//zodra er op de filter knop gedrukt wordt
		$('#filter').click(function() {
			var from_date = $('#from_date').val();
			var to_date = $('#to_date').val();
			if( from_date != '' && to_date != '' ) {

				$.ajax({
					url: "filter_graph.php",
					method: "POST",
					data:{from_date:from_date, to_date:to_date},
					success:function(data) {
					var dataArrays = JSON.parse(data);
					clearInterval(updateChart);
					$('#myChart').remove();
					$('#chart-container').append('<canvas id="myChart" width="70%" style="margin-top:30px;" ></canvas>');
					drawChart(dataArrays.datum, dataArrays.temp, dataArrays.hum);
					}
				});
			}else {
				alert("please select a date!");
			}
		});

		//when resume button is pressed
		$('#resume').click(function() {
			updatechart();
			updateChart = setInterval(function() {
			$('#myChart').remove();
			$('#chart-container').append('<canvas id="myChart" width="70%" style="margin-top:30px;" ></canvas>');
			updatechart();
			},120000);
		});
	});
	</script>
</body>
</html>
