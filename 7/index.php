<?php
$code_page="<meta charset='koi8-r'>";
// ������� ������ ����� �������� �����.

function show_min()
{
$handle = opendir('small');
			if ($handle != false)
			{

					while (false !== ($file = readdir($handle)))
						
					if ($file != '.' && $file != '..')
					{
						$fpath = "small/"."$file"; 
						echo "<img src=$fpath>";
					}
						closedir($handle);
						echo "<br>";
			}
}



function print_form()
{
echo "<meta charset='koi8-r'>";
echo '<form method="post" enctype="multipart/form-data">';
echo '<input type="file" name="text" />';
echo '<br/>';
echo '<input type="submit" value="��������� ����!" />';
echo '</form>';
show_min();

}

function resize($filename)
{
$filo = basename($filename);
//echo "$filename";
$percent = 0.05;

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
imagejpeg($thumb, "$path_small"."$filo");
imagedestroy($thumb);
}

function upload_file()
{
	$path_big = 'big/';

echo "<meta charset='koi8-r'>";
if ($_FILES['text']['tmp_name'] == '')
{
    print_form();
}
    else
    {
if (copy ($_FILES['text']['tmp_name'], "$path_big".$_FILES['text']['name']))
{
	$filo = "$path_big".$_FILES['text']['name'];
	
		resize("$filo");
    echo "���� ��������";
    echo '<br>';
	echo '<a href="index.php"> ��� ����� </a>';
	echo '<br>';
	echo '<br>';
		
		show_min();
		
		
		
//    echo '<a href="index.php"> ��� ����� </a>';
}
else
{
    echo "������ ��������";
}
    }
}

//����� �����

if (isset($_FILES['text']))
    {
	upload_file($_FILES['text']);
    }
    else
    {
	print_form();
    }
?>