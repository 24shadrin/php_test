<?php
//
// ����� �����.
//
session_start();
// ���� � ��������� ������ �� ����������� ��� ������������, �������� �����
//���
// �� cookies.
if (!isset($_SESSION['username']) && isset($_COOKIE['username']))
$_SESSION['username'] = $_COOKIE['username'];

setcookie('last', 'a.php', time() + 3600 * 24 * 7);
// ��� ��� ���� ��� ������������ � ��������� ������.
$username = $_SESSION['username'];
// ���������������� ������������� ���������� �� �������� �����������.
if ($username == null)
{
header("Location: login.php");
exit();
}
?>
<html>
<head>
<title>�������� �</title>
</head>
<body>
<h1>�������� "�"</h1>
<b>�</b> � <a href="b.php">�</a> ������ �� �����.
<br/>
<br/>
�� ����� ��� <b><?php echo $username; ?></b> | <a
href="login.php">�����</a>
</body>
</html>