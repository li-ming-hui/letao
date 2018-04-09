<?php 
header('Content-type:text/html;charset=utf-8');
//1. 接收要修改栏目的cate_id
$id = $_GET['id'];
//2. 接收要修改的状态
$state = $_GET['state'];

$sql = "update ali_cate set cate_state=$state  where cate_id=$id";

include_once '../include/mysql.php';
$res = mysql_query($sql);

if($res){
    echo "修改状态成功";
    header('refresh:2;url=categories.php');
} else {
    echo "修改状态失败";
    header('refresh:2;url=categories.php');
}
?>