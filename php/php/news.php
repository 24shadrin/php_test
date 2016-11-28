<?php
echo "<meta charset='koi8-r'>";
// Функция вывода всего списка новостей.
function show_list($news)
{
echo '<html>';
echo '<head>';
echo '<title>Последние новости</title>';
echo '</head>';
echo '<body>';
echo '<ul>';
for ($i = 0; $i < count($news); $i++)
{
echo '<li>';
echo '<a href="news.php?id=' . ($i + 1) . '">';
echo $news[$i];
echo '</a>';
echo '</li>';
}
echo '</ul>';
echo '</body>';
echo '</html>';
}
// Функция вывода конкретной новости.
function show_item($news, $id)
{
echo '<html>';
echo '<head>';
echo "<title>Новость #$id</title>";
echo '</head>';
echo '<body>';
echo '<a href="news.php">Вернуться к списку новостей</a>';
echo '<p>';
echo $news[$id - 1];
echo '</p>';
echo '<p>';
echo 'Представьте, что здесь много текста и картинок :)';
echo '</p>';
echo '</body>';
echo '</html>';
}
// Точка входа.
// Создаем массив новостей.
$news = array();
$news[0] = 'За качество ответят. Контролировать продукты питания начали по-
новому.';
$news[1] = 'Варшава не раскрывает перечень возможных мер против Минска';
$news[2] = 'Павел Астахов намерен добиваться отставки ряда чиновников
Удмуртии';
// Был ли передан id новости в качестве параметра?
if (isset($_GET['id']))
{
show_item($news, $_GET['id']);
}
else
{
show_list($news);
}
?>
