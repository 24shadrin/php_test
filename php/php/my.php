<?php

$a=-15;
$b=10;
//$c=$a+$b;

if (($a > 0) && ($b > 0))
{
$c=$a+$b;
}
    elseif (($a < 0) && ($b < 0))
{
$c=$a-$b;
}
    elseif ((($a < 0 ) && ($b > 0)) || (($a > 0) && ($b < 0)))
{
$c=$a*$b;
}
echo $c;
echo "<br>";
$c = ($a > $b) ? "$a" : "$b";
echo "big char is $c";

function sum($arg1, $arg2)
{
    return $arg1+$arg2;
}

function minus($arg1, $arg2)
{
    return $arg1-$arg2;
}


echo "<br>";
echo sum($a,$b);
echo "<br>";
echo minus($a,$b);

function matoper($arg1, $arg2, $oper)
{
    if ($oper == "-")
{
    return minus($arg1,$arg2);
}
else
{
echo "select operation";
}

}

echo "<br>";
echo matoper(25,1,"-");



?>