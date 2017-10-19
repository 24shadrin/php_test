<?php

global $path, $spath;
$date_today = date("Y-m-d");

$path = '/home/pi/beward/penta/' . $date_today . '/beward_penta/1/';
$spath = 'http://192.168.1.200/pi/' . $date_today . '/beward_penta/1/';

//$path = '/home/pi/beward/penta/test/beward_penta/1/';
//$spath = 'http://192.168.1.200/pi/test/beward_penta/1/';

$back_url = '<a href="http://192.168.1.200/sm/timelapse/dev.php">back</a>';

$massiv = $_POST[mass];

echo $back_url;
echo "<br>";
foreach($massiv as $value)
	
	{
		$picture = $spath . $value;
		echo "<img src='$picture' width=20% />";
	}
echo "<br>";
echo $back_url;

?>