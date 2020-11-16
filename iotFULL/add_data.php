<?php
    // Connect to MySQL
    include("connect.php");

    // Prepare the SQL statemen

    // Execute SQL statement

    //mysqli_query($conn, "insert into sensTest (temperature, humidity, pressure, IPadres) values ('".$_GET["temp"]."','".$_GET["hum"]."','".$_GET["pr"]."','".$_GET["ip_address"]."')");
    mysqli_query($conn, "insert into sensor_data (sensorID, waarde) values ('1', '".$_GET["temp"]."')");
    mysqli_query($conn, "insert into sensor_data (sensorID, waarde) values ('2', '".$_GET["hum"]."')");

?>
