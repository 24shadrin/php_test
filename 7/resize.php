<?php
// ���� � ����� ������
$filename = '000000.jpg';
$small = 'sm.jpg';
$percent = 0.1;
//path
$path_small = 'small/';

// ��� �����������
//header('Content-Type: image/jpeg');

// ��������� ������ �������
list($width, $height) = getimagesize($filename);

$newwidth = $width * $percent;
$newheight = $height * $percent;



// ��������
$thumb = imagecreatetruecolor($newwidth, $newheight);
$source = imagecreatefromjpeg($filename);

// ��������� �������
imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

//echo $thumb;
//copy ($thumb, $small);

// �����
imagejpeg($thumb, "$path_small".'small.jpg');
imagedestroy($thumb);
?>
