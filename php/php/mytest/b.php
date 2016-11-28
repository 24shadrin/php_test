<?php
//
// Точка входа.
//
session_start();
// Если в контексте сессии не установлено имя пользователя, пытаемся взять его
// из cookies.
if (!isset($_SESSION['username']) && isset($_COOKIE['username']))
    $_SESSION['username'] = $_COOKIE['username'];
    setcookie('last', 'b.php', time() + 3600 * 24 * 7);
// Еще раз ищем имя пользователя в контексте сессии.
$username = $_SESSION['username'];
// Неавторизованных пользователей отправляем на страницу регистрации.
if ($username == null)
{
header("Location: login.php");
exit();
}
?>
<html>
<head>
<title>Страница Б</title>
</head>
<body>
<h1>Страница "Б"</h1>
<a href="a.php">А</a> и <b>Б</b> сидели на трубе.
<br/>
<br/>
Вы вошли как <b><?php echo $username; ?></b> | <a
href="login.php">Выход</a>
</body>
</html>