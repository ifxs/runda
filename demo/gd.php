<?php

//画布
$img = imagecreatetruecolor(100,100);
//准备颜色
$green = imagecolorallocate($img,0,255,0);
$red = imagecolorallocate($img,255,0,0);
//填充画布
imagefill($img,0,0,$green);

//花图像
imagettftext($img, 40, 10, 80, 20, $red, "../Content/javascript/bootstrap/fonts/glyphicons-halflings-regular.ttf", '妹子妹子');


//输出
header("Content-Type:image/png");
echo imagepng($img);

//释放资源
imagedestroy($img);