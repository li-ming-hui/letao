<?php 
header('content-type:text/html;charset=utf-8');
//1. 接收要删除的id字符串
$ids = $_GET['ids'];
//2. 链接数据库
include_once '../include/mysql.php';
//3. 拼接SQL语句并执行
$sql = "delete from ali_article where article_id in ($ids)";
$res =mysql_query($sql);

if($res){
    echo "批量删除成功";
    header('refresh:2;url=posts.php');
} else {
    echo "批量删除失败";
    header('refresh:2;url=posts.php');
}
?>