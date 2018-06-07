<!-- 验证码 -->
<?php
header("Content-Type:text/html;Charset=UTF-8");//设置页面编码风格
header("Content-Type:image/jpeg");//通知浏览器输出的是JPEG格式的图像

$img=imagecreatetruecolor(150, 50);//创建画布
$bgcolor=imagecolorallocate($img, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));//分配背景颜色
for($i=0;$i<3;$i++){
	//画线
	$linecolor=imagecolorallocate($img, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));
	imageline($img, mt_rand(0,150), mt_rand(0,50), mt_rand(0,150), mt_rand(0,50), $linecolor);
}
for($j=0;$j<25;$j++){
	//画点
	$dotcolor=imagecolorallocate($img, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));
	imagesetpixel($img, mt_rand(0,150),mt_rand(0,60), $dotcolor);
}

$rand_str="qwertyuiopasdfghjklzxcvbnm1234567890";//需要使用的数字和字母
$str_arr=array();
// $checkcode=" ";
for($i=0;$i<4;$i++){
	$pos=mt_rand(0,strlen($rand_str)-1);
	$str_arr[]=$rand_str[$pos];
	// $checkcode=$checkcode.$rand_str[$pos];
}
// session_start();
// $_SESSION['checkcode']=$checkcode;
$x_start=150/4;

foreach($str_arr as $key){
	$fontcolor=imagecolorallocate($img, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));
	imagettftext($img, 25, mt_rand(-15,15), $x_start, 50/2, $fontcolor, "C:\Windows\Fonts\cambriaz.ttf", $key);//字体倾斜
	$x_start+=20;
}

imagefill($img,0,0,$bgcolor);
imagejpeg($img);
imagedestroy($img);
