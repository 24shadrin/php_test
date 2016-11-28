<?php
// файл и новый размер
$filename = '000000.jpg';
$small = 'sm.jpg';
$percent = 0.1;
//path
$path_small = 'small/';

// тип содержимого
//header('Content-Type: image/jpeg');

// получение нового размера
list($width, $height) = getimagesize($filename);

$newwidth = $width * $percent;
$newheight = $height * $percent;



// загрузка
$thumb = imagecreatetruecolor($newwidth, $newheight);
$source = imagecreatefromjpeg($filename);

// изменение размера
imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

//echo $thumb;
//copy ($thumb, $small);

// вывод
imagejpeg($thumb, "$path_small".'small.jpg');
imagedestroy($thumb);
?>
