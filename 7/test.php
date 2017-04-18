<html>
<head>
<title>устройства raspberry pi 2</title>
<meta http-equiv="Refresh" content="<?=$delay?>" />
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
header("Content-Type: text/html; charset=utf-8");
header('Refresh: 30; url=' .$_SERVER['PHP_SELF']);
?>

<br></br>
<form action="" method="post">
<input type="submit" name="relay01p01up" value="включить реле 01p01(лампа)">
<br></br>
<input type="submit" name="relay01p01down" value="выключить реле 01p01(лампа)">
</form>
<?php
if ($_POST[relay01p01up]) {
$a- exec("sudo /script/gpio/relay01-01-up.sh");
echo $a;
}
if ($_POST[relay01p01down]) {
$a- exec("sudo /script/gpio/relay01-01-down.sh");
echo $a;
}
?>
<br></br>

</body>
</html>
