<?php

$connect = mysqli_connect("localhost","student_11900456","kQ92NTbPGDBI","student_11900456");



$sql1 = "SELECT sensoren.sensNaam, sensor_data.waarde, sensor_data.date, sensor_data.IP FROM sensoren JOIN sensor_data ON sensoren.ID = sensor_data.sensorID WHERE sensoren.sensNaam = 'temperature' ORDER BY sensor_data.date DESC LIMIT 10";
$query = mysqli_query($connect,$sql1);

header( "Content-type: text/xml");

echo "<?xml version='1.0' encoding='UTF-8'?>
<rss version='2.0'>
<channel>
<title>titel:test</title>
<link>/</link>
<description>RSS van de site</description>
<language>en-us</language>";

while($row = mysqli_fetch_array($query)){
  $waarde=$row["waarde"];
  $date=$row["date"];
  $ip=$row["IP"];

  echo "<item>
  <title>$waarde</title>
  <link>$date</link>
  <description>$ip</description>
  </item>";
}
echo "</channel></rss>";
?>
