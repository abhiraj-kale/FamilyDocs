<?php

header('Content-type: image/jpeg');
session_start();
$text = $_SESSION['secure'];
$font_size = 25;

$image_width = 120;
$image_height = 50;

$image=imagecreate($image_width, $image_height);
imagecolorallocate($image,255,255,255);
$text_color = imagecolorallocate($image,0,0,0);

for ($i=0; $i <=80 ; $i++) {
  // code...
  $x1 = rand(1,120);
  $y1 = rand(1,120);
  $x2 = rand(1,120);
  $y2 = rand(1,120);

  imageline($image, $x1 , $y1 , $x2, $y2, $text_color);
}

imagettftext($image, $font_size,-8,20,35,$text_color, 'C:\xampp\htdocs\files\font.ttf',$text);
imagejpeg($image);
 ?>
