<?php

//Boylett's query
require_once('inc/lib/IV-MP_QUERY.php');

//Connect Parameters
$ip1 = $_GET["ip"];
$port1 = $_GET["port"];

$q = new IVMPQuery;
//Connecting
if(!$q->Query($ip1,$port1,$errno,$errstr,2))
{
	echo 'Failed to query server ('.$errstr.')';
}
else
{
	//Image parameters
	$gd = imagecreatefrompng("inc/other/userbar.png");
	$white = imagecolorallocate($gd, 255, 255, 255); 
	$black = imagecolorallocate($gd, 0, 0, 0);
	$font = 'inc/font/userbarfont.ttf';
	$text_size = 7;
	$border = 1.0;
	$y = 13;

	//Getting Data
	$server = $q->ServerData();

	if($server['maxplayers'] == 0)
	{
		imagettfstroketext($gd, $text_size, 0, 5, $y, $white, $black, $font, 'Server Down ('.$ip1.':'.$port1.')', $border);
	}
	else
	{
		//Successfully got data and adding them to the image
		imagettfstroketext($gd, $text_size, 0, 5, $y, $white, $black, $font, $server['hostname'], $border);
		imagettfstroketext($gd, $text_size, 0, 310, $y, $white, $black, $font, $server['players'].'/'.$server['maxplayers'], $border);
	}

	//Closing Connection
	$q->Close();

	//Creating the image
	header('Content-Type: image/png');
	imagepng($gd);
}

//Used for shadow
function imagettfstroketext(&$image, $size, $angle, $x, $y, &$textcolor, &$strokecolor, $fontfile, $text, $px) {

	for($c1 = ($x-abs($px)); $c1 <= ($x+abs($px)); $c1++)
		for($c2 = ($y-abs($px)); $c2 <= ($y+abs($px)); $c2++)
			$bg = imagettftext($image, $size, $angle, $c1, $c2, $strokecolor, $fontfile, $text);

	return imagettftext($image, $size, $angle, $x, $y, $textcolor, $fontfile, $text);
}
?>