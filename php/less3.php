<?php

echo "<meta charset='koi8-r'>";
$str = "мама папа";
echo "<br>";
echo $str;
echo "<br>";

//$trans = array('а' => 'a', 'б' => 'b', 'в' => 'v', 'г'=>'g', 'д'=>'d', 'е'=> 'e', 'ё'=>'e', 'ж'=>'zh', 'з'=>'z', 'и'=>'i', 'й'=>'y', 'к'=>'k', 'л'=>'l', 'м'=>'m', 'н'=>'n', 'о'=>'o', 'п'=>'p',
//'р'=>'r', 'c'=>'s', 'т'=>'t', 'у'=>'u', 'ф'=>'f', 'х'=>'h', 'ц'=>'c', 'ч'=>'ch', 'ш'=>'sh', 'щ'=>'sch', 'ъ'=>'', 'ы'=>'i', 'ь'=>'ь', 'э'=>'e', 'ю'=>'yu', 'я'=>'ya');

//$trans = array('м' => 'm', 'б' => 'b', 'с'=>'s');


function translate($stroka)
{
$trans = array('а' => 'a', 'б' => 'b', 'в' => 'v', 'г'=>'g', 'д'=>'d', 'е'=> 'e', 'ё'=>'e', 'ж'=>'zh', 'з'=>'z',
'и'=>'i', 'й'=>'y', 'к'=>'k', 'л'=>'l', 'м'=>'m', 'н'=>'n', 'о'=>'o', 'п'=>'p', 'р'=>'r', 'c'=>'s', 'т'=>'t',
'у'=>'u', 'ф'=>'f', 'х'=>'h', 'ц'=>'c', 'ч'=>'ch', 'ш'=>'sh', 'щ'=>'sch', 'ъ'=>'', 'ы'=>'i', 'ь'=>'ь', 'э'=>'e', 'ю'=>'yu', 'я'=>'ya');

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
echo (translate('щ'));
echo "<br>";
$str2="st";
for ($i=0; $i < 17; $i++)
{
$str[$i]=translate($str[$i]);
//echo "<br>";
}

echo $str;

?>