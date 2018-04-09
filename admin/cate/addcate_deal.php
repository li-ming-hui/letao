<?php 
header('content-type:text/html;charset=utf-8');
//1. 接收表单提交的数据
$name  = $_POST['name'];
$slug  = $_POST['slug'];
$state = $_POST['state'];
$show  = $_POST['show'];

//2. 补充创建时间 --- 当前时间点转为年月日时分秒的形式
$time  = date('Y-m-d H:i:s');

//3. 拼接SQL语句
$sql = "insert into ali_cate values(null, '$name', '$slug', '$time', $state, $show)";

//4. 引入链接MySQL的文件
include_once '../include/mysql.php';

//5. 执行SQL, 返回布尔值
$res = mysql_query($sql);

if($res){
    echo "添加新栏目成功";
    //header('refresh:2;url=categories.php');
} else {
    echo "添加新栏目失败";
    //header('refresh:2;url=addcate.php');
}
?>