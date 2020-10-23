<?php
$servername = "localhost";
$username = "student_11900456";
$password = "kQ92NTbPGDBI";
$dbname = "student_11900456";

// Create connection
$conn = new mysqli($servername,$username,$password,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>

<html>
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>filter da table</title>
  </head>
  <body>
    <p>kies een selectie</p>
    <select id="filterK" onchange="test()">
      <option>kies kolom</option>
      <option value="">alle kolomen</option>
      <option value="temp">temperatuur</option>
      <option value="hum">vochtigheid</option>
    </select>
    <div style="margin-right: 20px;">
      sorteer op  descending
      <input type="checkbox" id="desc" value="DESC" onchange="test()">
    </div>

    <br>
    begin
    <input type="date" id="date1">
    <br>
     einde
    <input type="date" id="date2">
    <input type="submit" onclick="test()">



    <p id="userdata"></p>




<script>


  function test() {

    if($('#desc').is(":checked")) {
      $.ajax({
          type: 'POST',
          url: 'http://11900456.pxl-ea-ict.be/filter%20de%20tabel/filterT.php',
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
          url: 'http://11900456.pxl-ea-ict.be/filter%20de%20tabel/filterT.php',
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


</script>


  </body>
</html>
