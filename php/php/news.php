<?php
echo "<meta charset='koi8-r'>";
// ������� ������ ����� ������ ��������.
function show_list($news)
{
echo '<html>';
echo '<head>';
echo '<title>��������� �������</title>';
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
// ������� ������ ���������� �������.
function show_item($news, $id)
{
echo '<html>';
echo '<head>';
echo "<title>������� #$id</title>";
echo '</head>';
echo '<body>';
echo '<a href="news.php">��������� � ������ ��������</a>';
echo '<p>';
echo $news[$id - 1];
echo '</p>';
echo '<p>';
echo '�����������, ��� ����� ����� ������ � �������� :)';
echo '</p>';
echo '</body>';
echo '</html>';
}
// ����� �����.
// ������� ������ ��������.
$news = array();
$news[0] = '�� �������� �������. �������������� �������� ������� ������ ��-
������.';
$news[1] = '������� �� ���������� �������� ��������� ��� ������ ������';
$news[2] = '����� ������� ������� ���������� �������� ���� ����������
��������';
// ��� �� ������� id ������� � �������� ���������?
if (isset($_GET['id']))
{
show_item($news, $_GET['id']);
}
else
{
show_list($news);
}
?>
