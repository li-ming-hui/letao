<?php 
//1. 接收表单数据
$id = $_POST['id'];
$email = $_POST['email'];
$nickname = $_POST['nickname'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$state = $_POST['state'];

//2. 链接数据库
include_once '../include/mysql.php';

//3. 编写SQL语句并执行
$sql = "update ali_admin set admin_email='$email',admin_nickname='$nickname',admin_age=$age,admin_gender='$gender',admin_state=$state where admin_id=$id";
$res = mysql_query($sql);

//4. 判断结果
if($res){
    echo 1;
} else {
    echo 2;
}
?>