<?php
session_start();
// ���� � ��������� ������ �� ����������� ��� ������������, �������� �����
//���
// �� cookies.
if (!isset($_SESSION['username']) && isset($_COOKIE['username']))
$_SESSION['username'] = $_COOKIE['username'];
// ��� ��� ���� ��� ������������ � ��������� ������.
$username = $_SESSION['username'];
// ���������������� ������������� ���������� �� �������� �����������.
if ($username == null)
{
header("Location: login.php");
exit();
}
else 
    $last = $_COOKIE['last'];
    header("Location: $last");
//    header("Location: a.php");



?>