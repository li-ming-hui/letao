<?php 
//设置响应字符集为utf-8，用来解决页面乱码问题
header('content-type:text/html;charset=utf-8');
//1. 接收表单提交数据，表单method=post，所以此处使用$_POST来接收数据
$id = $_POST['id'];
$name = $_POST['name'];
$slug = $_POST['slug'];
$state = $_POST['state'];
$show = $_POST['show'];

//2. 拼接修改的SQL语句
$sql = "update ali_cate set cate_name='$name',cate_slug='$slug',cate_state=$state,cate_show=$show where cate_id=$id";

//3. 引入mysql.php
include_once '../include/mysql.php';

//4. 执行SQL语句
//返回值是布尔值，因为执行的是修改语句，修改成功就是true，修改失败就是false
$res = mysql_query($sql);

//5. 判断执行结果
if($res){
    echo "修改栏目信息成功";
    header('refresh:2;url=categories.php');
} else {
    echo "修改栏目信息失败";
    header('refresh:2;url=editcate.php?id='.$id);
}

?>