<?php
//создаем timelapse

//include allserial.php;

//глобальные переменные
$date_today = date("Y-m-d");
$current_time = date("H:i:s");
//$date_today = "2018-01-20";

$path = '/home/pi/beward/penta/' . $date_today . '/beward_penta/1/';
$spath = 'http://192.168.1.200/pi/' . $date_today . '/beward_penta/1/';
$back_url = '<a class="button" href="http://192.168.1.200/sm/timelapse/dev.php">back</a>';

//$path = '/home/pi/beward/penta/test/beward_penta/1/';
//$spath = 'http://192.168.1.200/pi/test/beward_penta/1/';

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
echo "<p class='text-cente' >привет. Для вас доступно. </p>";

echo '<form action="dev.php" method="post">';
echo "<p> сколько показать? </p>";
echo "<select name='limit'>";
echo "<option value='5'> 5 </option>";
echo "<option value='6'> 6 </option>";
echo "<option value='10'> 10 </option>";
echo "<option value='15'> 15 </option>";
echo "<option value='all'> все </option>";
echo '<input type="submit" class="button" value="применить" />';
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
$back_url = '<a class="button" href="http://192.168.1.200/sm/timelapse/dev.php">back</a>';


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
//echo "имя старшего файла " .$file_name;
//echo "<br>";
$f_meta = date("d m Y H:i:s", $file_meta);
echo "крайнее движение ".  $f_meta;
//echo  "<br>";
//echo  "<br>";
$picture = $spath . $file_name;
//echo "<img src='$picture' width=24% />";
echo  "<br>";

}
}

function show_pic_time($tm)
{
// выводит файла за интервал времени

global $path, $spath;

$back_url = '<a class="button" href="http://192.168.1.200/sm/timelapse/dev.php">back</a>';
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

echo '<form  action="dev.php" method="post" >';

echo "<select name='item' >";
echo "<option value='300'> 5 минут </option>";
echo "<option value='900'> 15 минут </option>";
echo "<option value='1800'> 30 минут </option>";
echo "<option value='3600'> 1 час </option>";
echo "<option value='7200'> 2 часа </option>";
echo "<option value='10800'> 3 часа </option>";
echo "<option value='21600'> 6 часов </option>";


echo '<input type="submit" class="button" value="применить" />';
echo "</select>";
echo "</form>";
}

function print_serial_select()
{
echo "выбирите количество серий для отображения ";

echo '<form  action="dev.php" method="post" >';

echo "<select name='item' >";
echo "<option value='5'> 5 </option>";
echo "<option value='10'> 10 </option>";
echo "<option value='15'> 15 </option>";
echo "<option value='20'> 20 </option>";
echo "<option value='25'> 25 </option>";
echo "<option value='30'> 30 </option>";
echo "<option value='0'> все </option>";


echo '<input type="submit" class="button" value="применить" />';
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

//echo "количество элементов в массивах файлов и их размеров";
//echo "<br>";
//echo $i_max;
//echo "<br>";
//echo $j_max;
//echo "<br>";

$coun = 0;

//ходим циклом по массиву с датой запоминаем индексы где разница между датой больше 10 секунд
		for($i=0; $i < $i_max; $i++)
		{
			if (($md[$i] - $md[$i+1]) > -20 ) 

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
	global $path, $spath, $back_url;
//var_dump($show_mas);
//echo $back_url;
	foreach($show_mas as $value)
	
	{
		$picture = $spath . $value;
		echo "<img src='$picture' width=20% />";
		
	}
	echo "<br>";
	echo "<br>";
//echo $back_url;
}	


function serial_show($items)
{
//функция выводит по 5 картинок из количества items серий за текущий день.

global $path, $spath, $back_url;
#мыссив с индексами где разница между файлами более 5 секунд
$numer = serial();
//var_dump($numer);
#количество серий
$coun = count($numer);

$f_name = search_files();
	if ((count($f_name)) > 0 )
//	if ((count($numer)) > 0 )
	{

//echo "<br>";
//echo "сегодня зафиксировано " . ( $coun + 1 ) . " серий";
//echo "<br>";



// Этот большой цикл выводит по 5 картинок из каждой серии

//for ($seriya=0; $seriya <= $coun; $seriya++)
// Если items нулевой то выводим весь день.		
	if ( $items==0 ) 
	{
		$m_serial = 0; 
	}
	else {
$m_serial = ( $coun - $items + 1 );
		}
//$m_serial = 0;
if ( $m_serial < 0 ) 
{
	$m_serial = 0;
}
if ( $items !=3)
	{
		echo $back_url;
	}
for ($seriya = $m_serial; $seriya <= $coun; $seriya++)
{
//$a = filemtime(($f_name[$coun]);
//выводим номер серии. +1 делаем для удобства. Номера в массиве с 0. Человеку удобней с 1.
//echo "номер серии " . ( $seriya +1 );
//echo "<br>";

//вычисляем две переменные с какого номера начинать и каким заканчивать.
$lim = $numer[$seriya];

#если последняя серия равна количесву серий, то правая граница равна количеству элементо в массиве. Так может быть если всего одна серия
if  ( $seriya == ( $coun ) )
	{
	$lim = count($f_name);
	}
# если всего одна серия то начинать с нулевого элемента
$begin = $numer[$seriya - 1];
if ( $seriya == 0)
	{
	$begin = 0;
	}
	
#наполняем массив элементами с границами begin начало и lim конец
		for($i=$begin; $i < $lim; $i++)
			{
		
				$current_serial[] = $f_name[$i];

			}

//echo "номер серии " . ( $seriya +1 );
			$str = $seriya + 1;
//			$str_form = "номер серии " . $str;
			$sum_in_serial = count($current_serial);
			$str_form = "номер серии " .$str .  " всего в серии " . $sum_in_serial . " эл.";
//echo "<br>";


//echo "<form action='' method=post>";

foreach($current_serial as $key)
{

	echo "<form action='allserial.php' method=post>";
	echo "<input type=hidden name=mass[] value=$key>";
}
//echo '<a role="button" aria-label="submit form" href="#" class="button">Submit</a>';
echo "<input type='submit' class='button' name='$str' value='$str_form'>";
echo "</form>";

				
						if ( $sum_in_serial > 12 )
					{

	
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

show_img_html($show_current);






					}
					else
					{	//var_dump($current_serial);
//						$current_serial = array_pop($current_serial);
				
//						foreach($current_serial as $value)
//						for($i=0; $i< (count($current_serial) - 1); $i++)
//	echo $back_url;
							for($i=0; $i< (count($current_serial)); $i++)
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
//	echo $back_url;




// обнуляем массив с текущим набором файлов
					
$current_serial = [];

}

if ( $items !=3)
	{
		echo $back_url;
	}



}
else 
	{ 
	echo "<br>";
	echo "серий не обнаружено или что-то пошло не так.";
	echo "<br>";
	echo $back_url;
	}




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

function items_of_serial()
{
//функция выводит информацию сколько зафиксирована серий за сегодня. 
global $date_today, $current_time;

$numer = serial();

$coun = count($numer);

	if ( $coun == 0 ) 
	{
		echo "<br>";
		echo "Сегодня $date_today  $current_time серий не обнаружено ";
		echo "<br>";
	}
	else
	{
echo "<br>";
echo "сегодня $date_today  $current_time зафиксировано " . ( $coun + 1 ) . " серий";
echo "<br>";
	}
}

function calendar()
{
echo "<html>";
echo "<head>";
echo "<title></title>";
echo '<link rel="stylesheet" href="uikit/css/uikit.min.css" />';
echo '<link rel="stylesheet" href="uikit/css/components/datepicker.min.css" />';
echo '<script src="uikit/jquery.js"></script>';
echo '<script src="uikit/js/uikit.min.js"></script>';
echo '<script src="uikit/js/components/datepicker.js"></script>';
echo '<script src="uikit/js/components/form-select.js"></script>';
echo "</head>";


echo '<form class="uk-form">';
echo '<input type="text"' . 'data-uk-datepicker=' . "{format:" . "'DD.MM.YYYY'}" . ">";
//echo ""<input type="text" data-uk-datepicker="{format:'DD.MM.YYYY'}">"";
echo '<input type="submit" class="button" value="применить" />';
echo "</form>";

echo "</html";

}
//точка входа в программу-----------------------------------------------------------------------------------

//echo '<link rel="stylesheet" href="css/foundation.css" /> ';
echo '<link rel="stylesheet" href="css/foundation.css" /> ';

//echo '<a role="button" aria-label="submit form" href="#" class="button">Submit</a>';
/*
if (isset($_POST['limit']))
{
//	show_picture($_POST['limit']);
//	show_pic($_POST['limit']);
//serial_show($_POST['limit']);
}

else 
*/	
if (isset($_POST['item']))
{
//	show_pic_time($_POST['item']);
	serial_show($_POST['item']);
//	calendar();
}

	else{
			items_of_serial();
			
//print_form();
//print_form_time();
			print_serial_select();
				if ( info_folder() > 0 )
				{
						echo "в папке " . info_folder() . " элементов jpg";
						meta_file();
						serial_show(3);
//						calendar();
				}
					else
						{
							echo "в папке нет элементов jpg или что-то пошло не так";
						}
//meta_file();

//serial_show(1);

		}

?>