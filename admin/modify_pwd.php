<?php 
//1. 接收数据
$old_pwd = md5($_POST['oldpwd']);
$new_pwd = $_POST['newpwd'];
$new_pwd2 = $_POST['re-newpwd'];

//2. 验证两个新密码一致
if($new_pwd != $new_pwd2){
    //如果两个新密码不相等
    echo 1;
    die;
}

//3. 验证旧密码是否正确
//链接数据库进行验证
include_once 'include/mysql.php';
//根据id查询当前用户的密码
session_start();
$id = $_SESSION['id'];
//编写SQL语句
$sql = "select admin_pwd from ali_admin where admin_id=$id";
$res = mysql_query($sql);
//$admin_info中只有一个 admin_pwd 单元
$admin_info = mysql_fetch_assoc($res);
//验证接收的旧密码和数据表中查询的旧密码是否一致
if($admin_info['admin_pwd'] != $old_pwd){
    echo 2;
    die;
} else {
    //如果旧密码验证通过，则将新密码更新到admin表中
    $new_pwd = md5($new_pwd);
    $sql = "update ali_admin set admin_pwd='$new_pwd' where admin_id=$id";
    $res = mysql_query($sql);
    if($res){
        echo 3;
    } else {
        echo 4;
    }
}

?>