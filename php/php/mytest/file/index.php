<?php
$code_page="<meta charset='koi8-r'>";
// ������� ������ ����� �������� �����.

function print_form()
{
echo "<meta charset='koi8-r'>";
echo '<form method="post" enctype="multipart/form-data">';
echo '<input type="file" name="text" />';
echo '<br/>';
echo '<input type="submit" value="��������� ����!" />';
echo '</form>';
}


function upload_file()
{

echo "<meta charset='koi8-r'>";
if ($_FILES['text']['tmp_name'] == '')
{
    print_form();
}
    else
    {
if (copy ($_FILES['text']['tmp_name'], $_FILES['text']['name']))
{
    echo "���� ��������";
    echo '<br>';
    echo '<a href="index.php"> ��� ����� </a>';
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