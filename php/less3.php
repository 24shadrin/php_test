<?php

echo "<meta charset='koi8-r'>";
$str = "���� ����";
echo "<br>";
echo $str;
echo "<br>";

//$trans = array('�' => 'a', '�' => 'b', '�' => 'v', '�'=>'g', '�'=>'d', '�'=> 'e', '�'=>'e', '�'=>'zh', '�'=>'z', '�'=>'i', '�'=>'y', '�'=>'k', '�'=>'l', '�'=>'m', '�'=>'n', '�'=>'o', '�'=>'p',
//'�'=>'r', 'c'=>'s', '�'=>'t', '�'=>'u', '�'=>'f', '�'=>'h', '�'=>'c', '�'=>'ch', '�'=>'sh', '�'=>'sch', '�'=>'', '�'=>'i', '�'=>'�', '�'=>'e', '�'=>'yu', '�'=>'ya');

//$trans = array('�' => 'm', '�' => 'b', '�'=>'s');


function translate($stroka)
{
$trans = array('�' => 'a', '�' => 'b', '�' => 'v', '�'=>'g', '�'=>'d', '�'=> 'e', '�'=>'e', '�'=>'zh', '�'=>'z',
'�'=>'i', '�'=>'y', '�'=>'k', '�'=>'l', '�'=>'m', '�'=>'n', '�'=>'o', '�'=>'p', '�'=>'r', 'c'=>'s', '�'=>'t',
'�'=>'u', '�'=>'f', '�'=>'h', '�'=>'c', '�'=>'ch', '�'=>'sh', '�'=>'sch', '�'=>'', '�'=>'i', '�'=>'�', '�'=>'e', '�'=>'yu', '�'=>'ya');

    foreach ($trans as $key => $item)
{

    if( $stroka == $key )
{
return $item;
}
//    else
//{
//return $item;
//}
}


}
//echo $str;


//translate($str);
echo (translate('�'));
echo "<br>";
$str2="st";
for ($i=0; $i < 17; $i++)
{
$str[$i]=translate($str[$i]);
//echo "<br>";
}

echo $str;

?>