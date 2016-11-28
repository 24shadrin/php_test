<?php
echo "<meta charset='koi8-r'>";
// Функция вывода формы ввода.
function show_form()
{
$result = $a + $b;
echo '<html>';
echo '<head>';
echo '<title>Калькулятор</title>';
echo '</head>';
echo '<body>';
echo '<form action="sum.php" method="post">';
echo '<input type="text" name="a" />';
echo '<input type="submit" name="plus" value="+" />';
echo '<input type="submit" name="minus" value="-" />';
echo '<input type="submit" name="umn" value="*" />';
echo '<input type="submit" name="razdel"value="/" />';
echo '<input type="text" name="b" />';
echo '<input type="submit" value="=" />';
echo '</form>';
echo '</body>';
echo '</html>';
}
// Функция вывода результата.
function show($a, $b, $op)
{
if ($op == '+')
{
$result = $a+$b;
}
if ($op == '-')
{
$result = $a - $b;
}
if ($op == '*')
{
$result = $a * $b;
}
if ($op == '/')
{
    if ($b == 0)
    {
    $result="Ошибка. Второй операнд 0";
    }
else
{    
$result = $a / $b;
}
}

//$result = $a + $b;
echo '<html>';
echo '<head>';
echo '<title>sum</title>';
echo '</head>';
echo '<body>';
echo '<form action="sum.php" method="post">';
echo '<input type="text" value='.$a.' />';
echo " ".$op." ";
echo '<input type="text" value='.$b.' />';
echo '<input type="submit" value="=" />';
echo "<b> $result </b>";

//echo '<input type="text" value='.($a+$b).'>';
//echo "$a+$b";

echo '</form>';
echo '</body>';
echo '</html>';
}

// Точка входа.
// Показываем результат операции или форму ввода.
if (isset($_POST['a']) && isset($_POST['b']))
{
    if (isset($_POST['plus']))
    {
	$oper = '+';
    }
    
    if (isset($_POST['minus']))
    {
	$oper = '-';
    }
    
    if (isset($_POST['umn']))
    {
        $oper = '*';
    }
    if (isset($_POST['razdel']))
    {
        $oper = '/';
    }
show($_POST['a'], $_POST['b'], $oper);
//show_form($_POST['a'], $_POST['b']);
}
else
{
show_form();
}
?>
