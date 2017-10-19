<?php
//include dev.php;
global $path, $spath;
$date_today = date("Y-m-d");

$path = '/home/pi/beward/penta/' . $date_today . '/beward_penta/1/';
$spath = 'http://192.168.1.200/pi/' . $date_today . '/beward_penta/1/';

$back_url = '<a href="http://192.168.1.200/sm/timelapse/dev.php">back</a>';

//echo "helo";
$massiv = $_POST[mass];

//var_dump($massiv);

//echo "<br>";

//$c_mas = unserialize($massiv);

//var_dump ($c_mas);
//$picture = 'http://192.168.1.200/pi/2017-10-16/beward_penta/1/15_17_231.jpg';
//echo "<img src='$picture' width=20% />";
//var_dump($current_seria);

//show_img_html($c_mas);

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