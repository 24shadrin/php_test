<?php
//создаем timelapse

//echo "hello";

$path = '/home/pi/beward/penta/2017-04-18/beward_penta/1/';

$list = scandir($path);


//var_dump($list);

foreach ($list as $value)

//if ($value == "." || $value=="..")

echo $value . "\n";
echo "<br>";


?>