<?php
//создаем timelapse

function search_files()
{
	{
$path = '/var/www/sm/timelapse/penta/';
$spath = 'penta2/';

if ($list = scandir($path))

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

}
}
}
return $files;
var_dump($files);
}

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

function meta_file()
{
	/*
$path = '/var/www/sm/timelapse/penta2/';
$spath = 'penta2/';
$name = '04_34_45.jpg';

if ($list = scandir($path))

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
*/


//$meta = date("F d Y H:i:s", filectime($path  .  $name));

echo "<br>";
//echo $meta;
$path = '/var/www/sm/timelapse/penta/';
$filo = search_files();
//var_dump($filo);
		foreach($filo as  $value)
		{
			$meta[][filectime($path . $value )]=$value;
			
		}
var_dump($meta);
		$fresh = max($meta[]);		
echo $fresh;
echo "\n";
//$xx = date("F d Y H:i:s", $fresh);

//echo $xx;
//echo "<img src='$picture' width=24% />";

}
//точка входа в программу--------------------------------------------------------------------------------------

if (isset($_POST['limit']))
{
//	show_picture($_POST['limit']);
	show_pic($_POST['limit']);
}
else{
print_form();
info_folder();
meta_file();


}




?>