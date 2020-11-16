<?php header('Content-type: application/xml');

$connect = mysqli_connect("localhost","student_11900456","kQ92NTbPGDBI","student_11900456");


echo "<rss version='2.0' xmlns:atom='http://www.w3.org/2005/Atom'>\n";
echo "<channel>\n";

echo "<title>RSS Feed</title>\n";
echo "<description>de gemiddelde waardes en de max en min waardes</description>\n";
echo "<link>http://www.mydomain.com</link>\n";


$sql1 = "SELECT sensoren.sensNaam, sensor_data.waarde, sensor_data.date FROM sensoren JOIN sensor_data ON sensoren.ID = sensor_data.sensorID WHERE sensoren.sensNaam = 'temperature' ORDER BY sensor_data.date DESC LIMIT 1";
$result1 = $connect->query($sql1);

while($row = $result1->fetch_assoc()) {

     echo "<item>n";
         echo "<title>idunno gwn titel</title>\n";
         echo "<description>$row->newsDesc</description>\n";
         echo "<pubDate>".date('D, d M Y H:i:s',strtotime($row->newsDate))." GMT</pubDate>\n";
         echo "<link>http://www.mydomain.com/$row->newsSlug</link>\n";
         echo "<guid>http://www.mydomain.com/$row->newsSlug</guid>\n";
         echo "<atom:link href='http://www.mydomain.com/$row->newsSlug' rel='self' type='application/rss+xml'/>\n"
     echo "</item>\n";

}

echo "</channel>\n";
echo "</rss>\n";
?>
