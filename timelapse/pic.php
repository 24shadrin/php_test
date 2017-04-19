<?php
//создаем timelapse



//$path = '/home/pi/beward/penta/2017-04-18/beward_penta/1/';
$path = '/var/www/sm/timelapse/penta/';
$spath = 'penta/';

$i = 0;
$limit = 5;

//$list = scandir($path);
if ($list = opendir($path))
{
if ($list != false)
{

	while((($file = readdir($list)) !== false) && ($i < $limit))
	{
		if (($file != '.') && ($file != '..'))
		{
				$files[] = $file;
				
				$picture = $spath . $file;

		}$i++;
	}
	
	sort($files);
				foreach($files as $value)
				{				
			$picture = $spath . $value;
			echo "<img src='$picture' width='300' height='240' />";
				}
closedir($list);
}
}
else 
{
	echo "folder with content not found";
}



?>