<?php
//создаем timelapse


function show_picture($lim)
{
//$path = '/home/pi/beward/penta/2017-04-18/beward_penta/1/';
$path = '/var/www/sm/timelapse/penta/';
$spath = 'penta/';


if ($list = opendir($path))
{
if ($list != false)
{

	while((($file = readdir($list)) !== false))	

	{
		if (($file != '.') && ($file != '..'))
		{
				$files[] = $file;

		}
//		$i++;
	}
	
	sort($files);
//	var_dump($files);
if ($lim == 'all') 
{
			foreach($files as $value)
			{			
			$picture = $spath . $value;
			echo "<img src='$picture' width='300' height='240' />";
			}
echo "<br>";
echo '<a href="http://192.168.1.200/sm/timelapse/pic.php">back</a>';
			
}
else
{
				for($i = 0; $i < $lim; $i++)
				{				
			$picture = $spath . $files[$i];
				echo "<img src='$picture' width='300' height='240' />";
				}
echo "<br>";
echo '<a href="http://192.168.1.200/sm/timelapse/pic.php">back</a>';	
				
}
closedir($list);
}
}
else 
{
	echo "folder with content not found";
}
}


function print_form()
{
echo "привет. Для вас доступно.";

echo '<form action="pic.php" method="post">';
echo "<p> сколько показать? </p>";
echo "<select name='limit'>";
echo "<option value='5'> 5 </option>";
echo "<option value='6'> 6 </option>";
echo "<option value='10'> 10 </option>";
echo "<option value='15'> 15 </option>";
echo "<option value='all'> все </option>";
echo '<input type="submit" value="применить" />';
echo "</select>";
echo "</form>";
}

//точка входа в программу

if (isset($_POST['limit']))
{
	show_picture($_POST['limit']);
}
else{
print_form();
}


//show_picture($limit);




?>