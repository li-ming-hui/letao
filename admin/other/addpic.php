<?php 
header('Content-type:text/html;charset=utf-8');
//1. 处理上传文件
if($_FILES['image']['error'] != 0){
    echo "文件上传失败，请重新上传";
    header('refresh:2;url=slides.php');
    die;
} else {
    //上传成功时，处理文件名称并移动
    $pos = strrpos($_FILES['image']['name'], '.');
    // .jpg  .png  .gif
    $ext = substr($_FILES['image']['name'], $pos);
    // 判断上传文件是否是图片
    $arr = array('.jpg', '.png', '.gif');
    if(!in_array($ext, $arr)){
        echo "上传文件格式不正确，必须是图片文件";
        header('refresh:2;url=slides.php');
        die;
    }
    // 如果是图片文件，定义保存路径，并移动
    $path = '../uploads/'.time().rand(10000, 99999).$ext;
    move_uploaded_file($_FILES['image']['tmp_name'], $path);
}

//2. 接收其他数据
$text = $_POST['text'];
$link = $_POST['link'];

//3. 链接数据库
include_once '../include/mysql.php';

//4. 编写SQL语句并执行
$sql = "insert into ali_pic values(null, '$path', '$text', '$link')";
$res = mysql_query($sql);

if($res){
    echo "添加新图片成功";
} else {
    echo "添加新图片失败";
}
header('refresh:2;url=slides.php');
?>