<?php
//создаем timelapse

include allserial.php;

//глобальные переменные
$date_today = date("Y-m-d");
//$date_today = "2017-06-25";

$path = '/home/pi/beward/penta/' . $date_today . '/beward_penta/1/';
$spath = 'http://192.168.1.200/pi/' . $date_today . '/beward_penta/1/';

//$path = '/home/pi/beward/penta/2017-07-20/beward_penta/1/';
//$spath = 'http://192.168.1.200/pi/2017-07-20/beward_penta/1/';

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

function serial()
{
//функция делит фотографии на серии, возвращает массив в котором храним индексы где разница менжду файлами более 5 секунд

	global $path, $spath;

	$files = search_files();
	
	
	foreach($files as $value)
		{
			$md[] = filemtime($path . $value);
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

//ходим циклом по массиву с датой запоминаем индексы где разница между датой больше 10 секунд
		for($i=0; $i < $i_max; $i++)
		{
			if (($md[$i] - $md[$i+1]) > -10 ) 

			{
			//  получается здесь ничего не делаем!!!
//			$files_serial[] = $f_name[$i];
		

			}
		else
		{
//счетчик серий. Сколько у нас получилось таких пачек файлов с разницей создания меньше 5 секунд		
			$coun++;

//это массив с индексами где разница с файлами уже больше 5 секунд
			$numer[] = $i+1;


		}
		}
	
return $numer;
}	

function show_img_html($show_mas)
{
//функция выводит массив с картинками.
	global $path, $spath;
//var_dump($show_mas);
	foreach($show_mas as $value)
	
	{
		$picture = $spath . $value;
		echo "<img src='$picture' width=20% />";
	}

}	


function serial_show()
{
//функция выводит по 5 картинок из всех серий за текущий день.

global $path, $spath;
$numer = serial();
var_dump($numer);
$coun = count($numer);

$f_name = search_files();
	if ((count($f_name)) > 0 )
//	if ((count($numer)) > 0 )
	{

echo "<br>";
echo "сегодня зафиксировано " . ( $coun + 1 ) . " серий";
echo "<br>";



// Этот большой цикл выводит по 5 картинок из каждой серии

//for ($seriya=0; $seriya <= $coun; $seriya++)
$m_serial = ( $coun - 5 );
if ( $m_serial < 0 ) 
{
	$m_serial = 0;
}

for ($seriya = $m_serial; $seriya <= $coun; $seriya++)
{
//$a = filemtime(($f_name[$coun]);
//выводим номер серии. +1 делаем для удобства. Номера в массиве с 0. Человеку удобней с 1.
//echo "номер серии " . ( $seriya +1 );
//echo "<br>";

//вычисляем две переменные с какого номера начинать и каким заканчивать.
$lim = $numer[$seriya];


if  ( $seriya == ( $coun ) )
	{
	$lim = count($f_name);
	}
$begin = $numer[$seriya - 1];
if ( $seriya == 0)
	{
	$begin = 0;
	}
	

		for($i=$begin; $i < $lim; $i++)
			{
		
				$current_serial[] = $f_name[$i];

			}

			$super = $current_serial;
			sort($super);
			var_dump($super);
//echo "номер серии " . ( $seriya +1 );
			$str = $seriya + 1;
			$str_form = "номер серии " . $str;
			$sum_in_serial = count($current_serial);

echo "<form action='' method=post>";
echo "<input type='submit' name='$str' value='$str_form'>";
echo "</form>";
echo "всего в серии " . $sum_in_serial . " элемента";
var_dump ($current_serial);






echo "<br>";
							
//					if ( count($current_serial) > 12 )
						if ( $sum_in_serial > 12 )
					{
		//				var_dump($current_serial);
	#					all_serial_show($current_serial);
				echo "<br>";
	
	//вычисляем медиану. Тоесть кол-во элементов в массиве текущей серии делим пополам
	//$mediana = ($current_count = count($current_serial)/2);
				$mediana = (count($current_serial)/2);


//создаем массив, который будем выводить на экран. Добавляем в него 5 файлов около медианы
				$show_current[0] =  $current_serial[$mediana-5];
				$show_current[1] =  $current_serial[$mediana-3];
				$show_current[2] =  $current_serial[$mediana];
				$show_current[3] =  $current_serial[$mediana+3];
				$show_current[4] =  $current_serial[$mediana+5];
		
//выводим на экран нашу серию картинок. Здесь можно сделать функцию. Так как эта конструкция часто используется
	//foreach($show_current as $value)
	
	//{
	//	$picture = $spath . $value;
	//	echo "<img src='$picture' width=20% />";
	//}

show_img_html($show_current);

if ($_POST[$str]) {
show_img_html($super);	
}





					}
					else
					{	//var_dump($current_serial);
//						$current_serial = array_pop($current_serial);
				
//						foreach($current_serial as $value)
						for($i=0; $i< (count($current_serial) - 1); $i++)
//						for($i=0; $i< 5; $i++)
						{
//							$picture = $spath . $value;
								if ( $i < 5 ) {
							$picture = $spath . $current_serial[$i];
							
//							echo $value . "<br>";

							echo "<img src='$picture' width=20% />";
												}	
						}
						echo "<br>";
					}




// обнуляем массив с текущим набором файлов
$last_serial = $current_serial;					
$current_serial = [];
$sum_in_serial = 0;
}



}
else 
	{ 
	echo "<br>";
	echo "серий не обнаружено или что-то пошло не так.";
	}

//if ($_POST[allserial]) {
//show_img_html($last_serial);	
//}


}

function full_serial($mas_serial)
{
global $path, $spath;
	foreach($mas_serial as $value)
	{
		$picture = $spath . $value;
		echo "<img src='$picture' width=20% />";
	}
}



//точка входа в программу-----------------------------------------------------------------------------------

//echo '<link rel="stylesheet" href="css/foundation.css" /> ';

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
serial_show();




echo "<form>";
//echo "<input type='text' name='text'>";
echo "<input type='submit' name='all' value='Все серии'>";
echo "</form> ";
}
if(isset($all)) {
serial_show();
}

if ($_POST[allserial]) {

show_img_html($current_serial);	

}


?>