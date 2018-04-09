<?php 
//1. 接收用户输入的验证码
$verify = $_GET['verify'];
//2. 读取session中的验证码
session_start();
$code = $_SESSION['code'];
//3. 检测用户输入的验证码和系统产生的验证码是否一致
//strtolower: 将字符串转为小写
//strtoupper: 将字符串转为大写
if(strtolower($verify) != strtolower($code)){
    //当用户输入和系统产生亦一样时，提示错误
    echo 1;
    die;
}

//1. 接收用户email
$email = $_GET['email'];
//2. 链接数据库
include_once 'include/mysql.php';
//3. 编写SQL并执行
$sql = "select * from ali_admin where admin_email='$email'";
$res = mysql_query($sql);
//4. 资源转数组
//$admin_info = ['admin_id'=>1, 'admin_email'=>admin@ali.com, 'admin_pwd'=>202...]
$admin_info = mysql_fetch_assoc($res);
//5. 验证用户数组是否为空
if(empty($admin_info)){
    echo 2;
    die;
}

//1. 接收密码
$pwd = md5($_GET['pwd']); //08438340dasd3747
//2. 比对用户输入的密码和根据用户名取出的密码
if($pwd != $admin_info['admin_pwd']){
    //如果两个密码不相等，说明用户输入的密码不正确
    echo 3;
    die;
} else {
    //如果两个密码相等，则正常登录
    //将用户的重要信息保存到session当中
    $_SESSION['id'] = $admin_info['admin_id'];
    $_SESSION['email'] = $admin_info['admin_email'];
    $_SESSION['nickname'] = $admin_info['admin_nickname'];

    echo 4;
    die;
}
?>