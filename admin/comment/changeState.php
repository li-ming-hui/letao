<?php 
//1. 接收前台发送的数据
$cmt_id = $_GET['id'];       //16
$cmt_state = $_GET['state']; //批准
//2. 链接数据库
include_once '../include/mysql.php';
//3. 编写SQL语句并执行
$sql = "update ali_comment set cmt_state='$cmt_state' where cmt_id=$cmt_id";
$res = mysql_query($sql);
//4. 判断SQL结果，将数据返回给前端
if($res){
    echo 1;
} else {
    echo 2;
}

?>