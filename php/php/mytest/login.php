<?php
//
// �����������.
//
function Login($username, $remember)
{
// ..�� �� ������ ���� ������ �������.
if ($username == '')
return false;
// ���������� ��� � ������
$_SESSION['username'] = $username;
// � � cookies, ���� ������������ ������� ��������� ��� (�� ������).
if ($remember)
setcookie('username', $username, time() + 3600 * 24 * 7);
// �������� �����������.
return true;
}
//
// ����� �����������.
//
function Logout()
{
// ������ cookies ����������� (������������ ������ �� ��������).
setcookie('username', '', time() - 1);
// ����� ������.
unset($_SESSION['username']);
}
//
// ����� �����.
//
session_start();
$enter_site = false;
// ������� �� �������� login.php, ����������� ������������.
Logout();
// ���� ������ POST �� ����, ������, ������������ �������� �����.
if (count($_POST) > 0)
$enter_site = Login($_POST['username'], $_POST['remember'] == 'on');
// ������������ ��������������� ������������ �� ���� �� ������� �����.
if ($enter_site)
{
header("Location: a.php");
exit();
}
?>
<html>
<head>
<title>���� �� ����</title>
</head>
<body>
<h1>������������</h1>
<form action="" method="post">
������� ���:
<br/>
<input type="text" name="username" />
<br/>
<input type="checkbox" name="remember" /> ��������� ����
<br/>
<input type="submit" value="�����" />
</form>
</body>
</html>