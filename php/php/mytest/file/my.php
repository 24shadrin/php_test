<?php
// Функция вывода формы отправки файла.
function print_form()
{
echo "<meta charset='koi8-r'>";
echo '<form method="post" enctype="multipart/form-data">';
echo '<input type="file" name="text" />';
echo '<br/>';
echo '<input type="submit" value="Загрузить файл!" />';
echo '</form>';
}




if (isset($_FILES['text']))
{
$a= $_FILES['text']['tmp_name'];
    if ($a!='')
    {
$b= $_FILES['text']['name'];
copy ($a, $b);
echo 'file ok';
    }
}
else
{
print $a;
print_form();
}


?>