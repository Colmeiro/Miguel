<?php
function limpiar_acentos($s)
{
//$s = ereg_replace("[����]","a",$s);
//$s = ereg_replace("[����]","A",$s);
//$s = ereg_replace("[���]","I",$s);
//$s = ereg_replace("[���]","i",$s);
//$s = ereg_replace("[���]","e",$s);
//$s = ereg_replace("[���]","E",$s);
//$s = ereg_replace("[�����]","o",$s);
//$s = ereg_replace("[����]","O",$s);
//$s = ereg_replace("[���]","u",$s);
//$s = ereg_replace("[���]","U",$s);
//$s = str_replace("�","c",$s);
//$s = str_replace("�","C",$s);
//$s = str_replace("[�]","n",$s);
//$s = str_replace("[�]","N",$s);
$s = str_replace(
				 array('�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�'),
				 array('a','e','i','o','u','n','A','E','I','O','U','N','c','C','u','',''),
				 utf8_decode(strtolower($s)));
return $s;
}

function getEmbedUrlYoutube($url_original) {
	if(empty($url_original)) {
		return '';
	}

	$ar_url = explode('/', $url_original);
	$count = count($ar_url);
	if($count != 4) {
		return $url_original;
	}

	$url_embed = 'https://youtube.com/embed/' . $ar_url[$count -1];
	return $url_embed;
}
?>