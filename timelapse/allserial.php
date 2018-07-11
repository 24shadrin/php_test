<?php
echo '<link rel="stylesheet" href="css/foundation.css" /> ';
//global $path, $spath;
//$date_today = date("Y-m-d");

$dt = $_POST[date_path];

$path = '/home/pi/beward/penta/' . $dt . '/beward_penta/1/';
$spath = 'http://192.168.1.200/pi/' . $dt . '/beward_penta/1/';

//$path = '/home/pi/beward/penta/test/beward_penta/1/';
//$spath = 'http://192.168.1.200/pi/test/beward_penta/1/';

$back_url = '<a class=button href="http://192.168.1.200/sm/timelapse/dev.php">back</a>';

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