<?php 
//1. 接收表单提交数据
$email = $_POST['email'];
$nickname = $_POST['nickname'];
$password = md5($_POST['password']);
$age = $_POST['age'];
$gender = $_POST['gender'];
$state = $_POST['state'];
//补充添加该管理员的时间戳
$time = time();

//2. 链接数据库
include_once '../include/mysql.php';

//3. 拼接SQL语句并执行
$sql = "insert into ali_admin values(null, '$email', '$nickname', '$password', $age, '$gender', $time, $state)";
echo $sql;die;
$res = mysql_query($sql);

//4. 判断添加结果
if($res){
    //添加成功输出1，前台msg接收到的就是1
    echo 1;
} else {
    //添加失败输出2，前天msg接收到的就是2
    echo 2;
}
?>