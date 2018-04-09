<?php 
//如果响应类型写成 image/jpeg 就会输出成图片
//如果响应类型写成 text/html 就会输出成文字
header('Content-type:image/jpeg');
//创建验证码
//定义左右可以用作验证码的字符
$str = '2345678abcdefgABCDEFGUVWXYZ';
//定义$code用来保存产生好的验证码
$code = '';
//循环，每次从$str中取出一个字符
for($i = 0; $i < 4; $i++){
    $code .= $str[rand(0, strlen($str) - 1)];
}
//将验证码加入到session中
session_start();
$_SESSION['code'] = $code;

//绘制图片时，不要出现任何的输出
//echo $code;
//die;
// 定义一个固定的验证码字符串
//$code = 'asd2';
//1. 创建画布
$img = imagecreatetruecolor(110, 34);

//2. 创建画笔
$green = imagecolorallocate($img, 0, 255, 0);
$white = imagecolorallocate($img, 255, 255, 255);

//3. 填充背景色
imagefill($img, 0, 0, $green);

//4. 绘制验证码  $code = '3yh6'
//imagestring($img , 10, 10, 15 , $str, $white);
for($i = 0; $i < 4; $i++){
    imagettftext(
        $img, //画布资源
        rand(20, 25), //字体大小，像素级别
        rand(-15, 15), // 倾斜角度
        10 + $i * 23,  //绘制字符的起始x坐标
        30,            //绘制字符的起始y坐标
        //随机产生一根画笔
        imagecolorallocate($img, rand(0, 255), rand(0, 100), rand(0, 255)),
        'msyh.ttf', // 字形文件的路径
        $code[$i]
    );
}


//5. 显示/保存验证码
imagejpeg($img);

//6. 销毁画布资源
//一般资源类型的数据，我们都手动清除
imagedestroy($img);
?>