<?php 
header('content-type:text/html;charset=utf-8');
//1. 处理上传文件
$path = '../uploads/1.jpg';

//2. 接收表单其他数据
$name = $_POST['site_name'];
$desc = $_POST['site_description'];
$keys = $_POST['site_keywords'];
//判断是否有开启评论功能
$cmts = isset($_POST['comment_status'])?1:2;
$shen = isset($_POST['comment_reviewed'])?1:2;
// 在双引号之中的单引号只是一个普通的字符
$str = "<?php 
return array(
  'logo'  => '$path',
  'name'  => '$name',
  'desc'  => '$desc',
  'keys'  => '$keys',
  'cmts'  => $cmts,
  'shen'  => $shen
);
?>";

//file_put_contents会将文件原有内容清空，再将新内容写入
file_put_contents('site_conf.php', $str);
echo "修改网站设置成功";
header('refresh:2;url=settings.php');
?>