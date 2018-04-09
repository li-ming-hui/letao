<?php 
//1. 接收前台传递的admin_id
$admin_id = $_GET['id'];
//2. 链接数据库
include_once '../include/mysql.php';
//3. 编写SQL语句并执行
$sql = "delete from ali_admin where admin_id=$admin_id";
//echo $sql;die;
$res = mysql_query($sql);
//4. 根据执行结果返回数据
if($res){
    //code: 返回状态码，自定义
    $result = '{
        "code": 200,  
        "msg": "删除用户成功"
    }';
} else {
    $result = '{
        "code": 500,
        "msg": "删除用户失败"
    }';
}
echo $result;
?>