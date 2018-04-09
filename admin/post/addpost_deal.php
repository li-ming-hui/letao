<?php 
header('Content-type:text/html;charset=utf-8');
include_once '../include/checksession.php';

//1. 文件上传
//$_FILES是二维数组，第一维是文件域的name值
//第二维有5个单元  
//name:上传文件名
//type: 上传文件类型
//tmp_name: 临时保存路径
//error: 错误码， 0时说明文件正常上传
//size: 上传文件大小
//判断是否有文件上传
$new_name = '';
if($_FILES['feature']['error'] == 0){
    //文件上传成功时，改名、移动
    $pos = strrpos($_FILES['feature']['name'], '.');
    $ext = substr($_FILES['feature']['name'], $pos);

    $new_name = '../uploads/'.time().rand(10000, 99999).$ext;
    move_uploaded_file($_FILES['feature']['tmp_name'], $new_name);
}

//2. 接收表单传递的其他数据
$title = $_POST['title'];
//使用htmlspecialchars函数将字符串中的特殊字符进行转义
//将 < > 转为html实体  &lt;  &gt;
$content = htmlspecialchars($_POST['content']);
$cate = $_POST['category'];
$status = $_POST['status'];

//3. 手动补充其他数据
$time = time();
$click = rand(300, 500);
$good = rand(100, 300);
$bad  = rand(0, 50);
//截取文章内容的前200个字符来作为摘要
$desc = substr($content, 0, 200);
$adminid = $_SESSION['id'];

//4. 链接数据库
include_once '../include/mysql.php';
$sql = "insert into ali_article values(null, '$title', '$desc', '$content', $adminid, $cate, $time, '$new_name', $click, $good, $bad, $status, 1)";
//echo $sql;die;
$res = mysql_query($sql);

if($res){
    echo "添加新文章成功";
    header('refresh:2;url=posts.php');
} else {
    echo "添加新文章失败";
    header('refresh:2;url=addpost.php');
}

?>