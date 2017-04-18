<?php
//создаем timelapse

//echo "hello";

//$path = '/home/pi/beward/penta/2017-04-18/beward_penta/1/';
$path = '/var/www/sm/timelapse/penta/';
$spath = 'penta/';

$i = 1;
$limit = 5;

//$list = scandir($path);
$list = opendir($path);
if ($list != false)
{
//	$i = 1;
	while((($file = readdir($list)) !== false) && (($file = readdir($list)) !='.') && (($file = readdir($list)) !='..') && ($i < $limit))
//	while((($file = readdir($list)) !== false) &&(($file = readdir($list)) !=".") && (($file = readdir($list)) !=".."))
	{//	$i=$i+1;
				echo  $file;
				$picture = $spath . $file;
//		echo "<img src='$picture'>";
//      echo "<br>";
//	  echo "$file";
	  echo "\n";
		$i++;
	}

closedir($list);
}

//var_dump($list);

//foreach ($list as $value)

//if ($value == "." || $value=="..")

//echo $value . "\n";
//echo "<br>";


?>