<?php
//dl("php_gd.dll"); 
header ("Content-type: image/png");
$string = $_GET['string'];
if($string=="") $string="00000";                                              
$font   = 5;
$width  = imagefontwidth($font) * strlen($string);
$height = imagefontheight($font);
$im = @imagecreate ($width,$height);
//$birutua = imagecolorallocate($im,245,170,1); 
//$putih = imagecolorallocate($im,0,0,0); 
$birutua = imagecolorallocate($im,0,94,32); 
$putih = imagecolorallocate($im,255,255,255); 
//$grey_shade = imagecolorallocate($im,217,215,157); 
imagefill($im,0,0,$birutua); 
imagerectangle($im,0,5, 243, 59,$white); 
imagerectangle($im,0,10, 243, 59,$white); 
imagerectangle($im,10,0, 243, 59,$white); 
imagerectangle($im,20,0, 243, 59,$white); 
imagerectangle($im,30,0, 243, 59,$white); 
imagerectangle($im,40,0, 243, 59,$white); 
imagerectangle($im,50,0, 243, 59,$white); 
imagestring ($im, $font, 0, 0,  $string, $putih);
imagepng ($im);
?>
