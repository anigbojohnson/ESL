<?php

session_start();
$randomAphaNumeric = md5(rand());
$captureCode = substr($randomAphaNumeric , 0 , 6);
$_SESSION['capture'] = $captureCode;
header('Content-type: image/png');
$image = imagecreatetruecolor(200 , 50);
$font = dirname(__FILE__) .'/CRAZH.ttf';
  $backgroundColor= imagecolorallocatealpha( $image, 34, 233  , 145 ,rand(22,110));
  $textColor = imagecolorallocate( $image ,rand(), rand() , rand());
imagefilledrectangle($image ,0 ,0, 195 , 45 , $backgroundColor);
imagettftext($image , 20 , 0 , 40 ,30,$textColor, $font, $captureCode);
imagepng($image);
imagedestroy($image);
 ?>
