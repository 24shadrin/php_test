<?php
//создаем timelapse


function show_picture($lim,$cf)
{
//$path = '/home/pi/beward/penta/2017-04-18/beward_penta/1/';
$path = '/var/www/sm/timelapse/penta2/';
$spath = 'penta2/';
$back_url = '<a href="http://192.168.1.200/sm/timelapse/pic.php">back</a>';


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

	}

	
	sort($files);
//	var_dump($files);
if ($lim == 'all') 
{
			foreach($files as $value)
			{			
			$picture = $spath . $value;
			echo "<img src='$picture' width=24% />";
			}
echo "<br>";
echo $back_url;
			
}
else
{
				for($i = 0; $i < $lim; $i++)
				{				
			$picture = $spath . $files[$i];
				echo "<img src='$picture' width=24% />";
				}
echo "<br>";
echo $back_url;

				
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

function info_folder()
{
$path = '/var/www/sm/timelapse/penta2/';

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

	}
}
$x = count($files);
echo "в папке " . $x . " элемента";
}
}

function show_pic($lim)
{
$path = '/var/www/sm/timelapse/penta2/';
$spath = 'penta2/';
$back_url = '<a href="http://192.168.1.200/sm/timelapse/pic.php">back</a>';


if ($list = scandir($path, 1))
{
if ($list != false)
{

	
		foreach ($list as $value)
	{
		if (($value != '.') && ($value != '..'))
		{
				$files[] = $value;

		}

	}

//var_dump($files);
//	sort($files);
//	var_dump($files);
/*
if ($lim == 'all') 
{
			foreach($files as $value)
			{			
			$picture = $spath . $value;
			echo "<img src='$picture' width=24% />";
			}
echo "<br>";
echo $back_url;
			
}
else
{
	*/
				for($i = 0; $i < $lim; $i++)
				{				
			$picture = $spath . $files[$i];
				echo "<img src='$picture' width=24% />";
				}
echo "<br>";
echo $back_url;

}
}
}


//точка входа в программу

if (isset($_POST['limit']))
{
//	show_picture($_POST['limit']);
	show_pic($_POST['limit']);
}
else{
print_form();
info_folder();
}




?>