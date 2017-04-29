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
//var_dump($files);
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
$path = '/var/www/sm/timelapse/penta/';

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
//echo "в папке " . $x . " файлов";
return $x;

}
}

function show_pic($lim)
{
$path = '/var/www/sm/timelapse/penta/';
$spath = 'penta/';
$back_url = '<a href="http://192.168.1.200/sm/timelapse/pic.php">back</a>';


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

//	$counter = count($files);


$file_count = info_folder();
				for($i = 0; $i < $lim; $i++)
				{	
		if ( $i < $file_count  ) 
					{			
						$picture = $spath . $files[$i + ($file_count - $lim) ];
						echo "<img src='$picture' width=24% />";
					}

	
		
				}
echo "<br>";
echo $back_url;

}
}
}

function meta_file()
{
	
$path = '/var/www/sm/timelapse/penta/';
$spath = 'penta/';



//$meta = date("F d Y H:i:s", filectime($path  .  $name));

echo "<br>";
//echo $meta;
//$path = '/var/www/sm/timelapse/penta/';
$path = 'penta/';
$files = search_files();

//var_dump($files);

	foreach($files as $value)
		{
//			$filo[] = $value;
			$meta[filemtime($path . $value )] = $value;
			
		}

//var_dump($meta);

ksort($meta);

		foreach($meta as $key => $value)
		{
			$file_meta = $key;
			$file_name = $value;
		}

//echo "время старшего файла " . $file_meta;
echo "<br>";
echo "имя старшего файла " .$file_name;
echo "<br>";
$f_meta = date("d m Y H:i:s", $file_meta);
echo "крайнее движение ".  $f_meta;
echo  "<br>";
echo  "<br>";
$picture = $path . $file_name;
echo "<img src='$picture' width=24% />";
echo  "<br>";

}

function show_pic_time($tm)
{
$path = '/var/www/sm/timelapse/penta/';
$spath = 'penta/';
$back_url = '<a href="http://192.168.1.200/sm/timelapse/pic.php">back</a>';

$files = search_files();
foreach($files as $value)
		{
			$meta[filemtime($path . $value )] = $value;
			
		}
		ksort($meta);

$cur_time = time();
//var_dump($cur_time);
foreach($meta as $key => $value)
		{
			if ( ($cur_time - $key) < $tm)
			{
				$picture = $spath . $value;
				echo "<img src='$picture' width=24% />";
			}
//			else {
/*				if ( ($cur_time - $key) > $tm)
				{
			echo "за выбранный интервал файлов нет";
		echo "<br>";
		echo $back_url;
		return;
			}
			*/
		}
		
echo "<br>";
		echo $back_url;	
}

function print_form_time()
{
echo "показать за ";

echo '<form action="pic.php" method="post">';

echo "<select name='item'>";
echo "<option value='300'> 5 минут </option>";
echo "<option value='1800'> 30 минут </option>";
echo "<option value='3600'> 1 час </option>";


echo '<input type="submit" value="применить" />';
echo "</select>";
echo "</form>";
}
//точка входа в программу--------------------------------------------------------------------------------------

if (isset($_POST['limit']))
{
//	show_picture($_POST['limit']);
	show_pic($_POST['limit']);
}

else 
	
if (isset($_POST['item']))
{
	show_pic_time($_POST['item']);
}

else{
print_form();
print_form_time();
echo "в папке " . info_folder() . " элементов jpg";
meta_file();


}




?>