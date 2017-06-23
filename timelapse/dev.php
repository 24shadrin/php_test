<?php
//создаем timelapse

//глобальные переменные
$date_today = date("Y-m-d");
//$date_today = "2017-06-22";

$path = '/home/pi/beward/penta/' . $date_today . '/beward_penta/1/';
$spath = 'http://192.168.1.200/pi/' . $date_today . '/beward_penta/1/';

function search_files()
//ищет файлы в целевой папке, возвращает массив с файлами
{
global $path, $spath;

foreach (glob($path . '*.jpg') as $value)
{
	$full_path_files[] = $value;

}

foreach ($full_path_files as $value)
{
	$split_files = explode("/", $value);
	$files[] = $split_files[(count($split_files) - 1)];
}

return $files;

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

//подсчитывает кол-во элементов в целевой папке

$files = search_files();
$x = count($files);
return $x;


}

function show_pic($lim)
{
//показывает выбранное количество файлов

global $path, $spath;
$back_url = '<a href="http://192.168.1.200/sm/timelapse/pic.php">back</a>';

if ( info_folder() > 0 )
{
$files = search_files();


echo $back_url;
echo "<br>";

$file_count = info_folder();
if ( $file_count > $lim )
{
				for($i = 0; $i < $lim; $i++)
				{	
		if (( $i < $file_count  ) && ($lim < $file_count))
					{			
						$picture = $spath . $files[$i + ($file_count - $lim) ];
						echo "<img src='$picture' width=24% />";
					}	
				}
}		
	else 
		{
			for($i = 0; $i < $file_count; $i++)
				{	
						$picture = $spath . $files[$i];
						echo "<img src='$picture' width=24% />";
				}
			
		}
				
echo "<br>";
echo $back_url;

}
	else 
{
	echo "нет файлов или что-то пошло не так";
echo "<br>";
echo $back_url;
}
}


function meta_file()
{
//выдает статистику по целевой папке имя и время старшего файла и картинку самого файла
global $path, $spath;

//$meta = date("F d Y H:i:s", filectime($path  .  $name));

echo "<br>";

			
			if ( info_folder() > 0)
				
{
$files = search_files();



	foreach($files as $value)
		{

			$meta[filemtime($path . $value )] = $value;
			
		}

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
$picture = $spath . $file_name;
echo "<img src='$picture' width=24% />";
echo  "<br>";

}
}

function show_pic_time($tm)
{
// выводит файла за интервал времени

global $path, $spath;

$back_url = '<a href="http://192.168.1.200/sm/timelapse/pic.php">back</a>';
		if ( info_folder() > 0)
	{
$files = search_files();

echo $back_url;
echo "<br>";
foreach($files as $value)
		{
			$meta[filectime($path . $value )] = $value;
			
		}
		ksort($meta);

$cur_time = time();

foreach($meta as $key => $value)
		{
			if ( ($cur_time - $key) < $tm)
			{
				$picture = $spath . $value;
				echo "<img src='$picture' width=24% />";
				
				$a = 0;
			}

				if ( ($cur_time - $key) > $tm)
				{
					$a = 1;
				}
		}		
			if ($a !=0)
			{
			echo "за выбранный интервал файлов нет";
		echo "<br>";
		echo $back_url;
			
			}
			else 
					{		
					echo "<br>";
					echo $back_url;
					
					}

		}	
		else 
		{
echo "нет файлов или что-то пошло не так";
echo "<br>";
echo $back_url;		
		}
	}
	

function print_form_time()
{
echo "показать за последние ";

echo '<form action="pic.php" method="post">';

echo "<select name='item'>";
echo "<option value='300'> 5 минут </option>";
echo "<option value='900'> 15 минут </option>";
echo "<option value='1800'> 30 минут </option>";
echo "<option value='3600'> 1 час </option>";
echo "<option value='7200'> 2 часа </option>";
echo "<option value='10800'> 3 часа </option>";
echo "<option value='21600'> 6 часов </option>";


echo '<input type="submit" value="применить" />';
echo "</select>";
echo "</form>";
}

function serial($seriya)
{
//функция делит фотографии на серии, отбирает 5 средник из каждой серии

	global $path, $spath;

	$files = search_files();
	
	
	foreach($files as $value)
		{
			$md[] = filectime($path . $value);
			$f_name[] = $value;
		}



$i_max = count($md);
$j_max = count($f_name);

echo "количество элементов в массивах файлов и их размеров";
echo "<br>";
echo $i_max;
echo "<br>";
echo $j_max;

$coun = 0;

//ходим циклом по массиву с датой запоминаем индексы где разница между датой больше 5 секунд
		for($i=0; $i < $i_max; $i++)
		{
			if (($md[$i] - $md[$i+1]) > -5 ) 

			{

//			$files_serial[] = $f_name[$i];
		

			}
		else
		{
//счетчик серий. Сколько у нас получилось таких пачек файлов с разницей создания меньше 5 секунд		
			$coun++;
//			$files_serial[] = $f_name[$i];
//это массив с индексами где разница с файлами уже больше 5 секунд
			$numer[] = $i;


		}
		}

echo "<br>";
echo "сегодня зафиксировано " . $coun . " серий";
echo "<br>";
//echo "массив с разделителями";
//echo "<br>";
//var_dump($numer);
echo "<br>";

//разбиваем на 2 функции


// здесь указываем из какой серии хотим увидать 5 фотографий
//$seriya = 19;


//чтоб не путаться серии считаю с 1. Но нумерация массива с 0. Поэтому вычитаю 1
echo "номер серии " . $seriya;
echo "<br>";

$seriya = $seriya - 1;

//вспомогательные переменные для обхода массива. С какой начинать и до какого предела.
$lim = $numer[$seriya + 1];
if  ( $seriya == ( $coun - 1 ) )
	{
	$lim = count($f_name);
	}
$begin = $numer[$seriya];
if ( $seriya == 0)
	{
	$begin = 0;
	}


//for($i=$numer[$seriya]; $i <= $lim; $i++)
// записываем в массив $current_serial выбранную серию файлов
	for($i=$begin; $i <= $lim; $i++)
	{
		//$current_serial[] = $files_serial[$i];
		$current_serial[] = $f_name[$i];
	//	echo $current_serial[$i];
	//	echo "<br>";	
	}
//	var_dump($current_serial);
	//вычисляем медиану. Тоесть кол-во элементов в массиве текущей серии делим пополам
	$mediana = ($current_count = count($current_serial)/2);
//	echo $mediana;
	echo "<br>";
//создаем массив, который будем выводить на экран. Добавляем в него 5 файлов около медианы
				$show_current[0] =  $current_serial[$mediana-3];
				$show_current[1] =  $current_serial[$mediana-2];
				$show_current[2] =  $current_serial[$mediana];
				$show_current[3] =  $current_serial[$mediana+1];
				$show_current[4] =  $current_serial[$mediana+3];
	
//	var_dump($show_current);
	echo "<br>";	
//выводим на экран нашу серию картинок. Здесь можно сделать функцию. Так как эта конструкция часто используется
	foreach($show_current as $value)
	{
		$picture = $spath . $value;
		echo "<img src='$picture' width=20% />";
	}

echo "<br>";

}



//точка входа в программу-----------------------------------------------------------------------------------

echo '<link rel="stylesheet" href="css/foundation.css" /> ';

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
if ( info_folder() > 0 )
{
echo "в папке " . info_folder() . " элементов jpg";
}
else
{
	echo "в папке нет элементов jpg или что-то пошло не так";
}
meta_file();

for($i=1; $i <= 19; $i++)
{
serial($i);
}


}




?>