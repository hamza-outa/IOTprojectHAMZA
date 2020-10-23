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
  error_reporting(error_reporting() & ~E_NOTICE);   //zet notices uit

  $filter = $_POST['filter'];   //filter om de kolom te kiezen
  $desc = $_POST['desc'];   //asencding of descending ordenen (staat nu op ID)
  $date1 = $_POST['date1'];
  $date2 = $_POST['date2'];


  //als descending niet is aangevinkt standaard op ascending zetten
  if (empty($_POST["desc"])) {
    $desc = "ASC";
  }


  if (!empty($_POST['filter'])) {     //kijkt als data verstuurt is
      //als temperatuur is gekozen enkel de temp en de id tonen
      if ($_POST['filter'] == "temp") {

        if (!empty($_POST['date1']) and !empty($_POST['date2'])) {
          $sql = "SELECT ID,temperature,date FROM sensTest WHERE date >= '".$date1."' AND date <= '".$date2."' ORDER BY ID ".$desc."";
        }
        else{
          $sql = "SELECT ID,temperature,date FROM sensTest ORDER BY ID ".$desc."";
        }

        $result = $conn->query($sql);
        //print de data
        if ($result->num_rows > 0) {
          echo "<table class='table'><thead><tr><th>ID</th><th>temperatuur</th><th>datum</th></tr></thead><tbody>";

          while ($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["ID"]."</td><td>" . $row["temperature"]. "</td><td>" . $row["date"]. "</td></tr>";
          }
          echo "</tbody></table>";
        }

        else {
          echo "0 results (possible error)";
        }
      }
      //als er gekozen wordt voor vochtigheid
      elseif ($_POST['filter'] == "hum") {
        if (!empty($_POST['date1']) and !empty($_POST['date2'])) {
          $sql = "SELECT ID,humidity,date FROM sensTest WHERE date >= '".$date1."' AND date <= '".$date2."' ORDER BY ID ".$desc."";
        }
        else{
          $sql = "SELECT ID,humidity,date FROM sensTest ORDER BY ID ".$desc."";
        }
        $result = $conn->query($sql);
        //print de tabel
        if ($result->num_rows > 0) {
          echo "<table class='table'><thead><tr><th>ID</th><th>vochtigheid</th><th>datum</th></tr></thead><tbody>";

          while ($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["ID"]."</td><td>" . $row["humidity"]. "</td><td>" . $row["date"]. "</td></tr>";
          }
          echo "</tbody></table>";
        }

        else {
          echo "0 results (possible error)";
        }
      }

  }

  //als er geen filter is gekozen
  else {
    if (!empty($_POST['date1']) and !empty($_POST['date2'])) {
      $sql = "SELECT * FROM sensTest WHERE date >= '".$date1."' AND date <= '".$date2."' ORDER BY ID ".$desc."";
    }
    else{
      $sql = "SELECT * FROM sensTest ORDER BY ID ".$desc."";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      echo "<table class='table'><thead><tr><th>ID</th><th>temperatuur</th><th>vochtigheid</th><th>date</th></tr></thead><tbody>";
      while ($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["ID"]."</td><td>" . $row["temperature"]. "</td><td>" . $row["humidity"]. "</td><td>." . $row["date"]. ".</td></tr>";
      }
      echo "</tbody></table>";
    }
    else {
      echo "0 results (possible error)";
    }
  }

//$sql = "SELECT * FROM sensTest WHERE date >= '".$date1."' AND date <= '".$date2."' ORDER BY ID ".$desc."";

?>
