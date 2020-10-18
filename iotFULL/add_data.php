<?php
    // Connect to MySQL
    include("connect.php");

    // Prepare the SQL statemen

    // Execute SQL statement
    mysqli_query($conn, "insert into sensTest (temperature, humidity, pressure, IPadres) values ('".$_GET["temp"]."','".$_GET["hum"]."','".$_GET["pr"]."','".$_GET["ip_address"]."')");


?>
