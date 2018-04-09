<?php 
//1. 引入mysql.php文件
include_once '../include/mysql.php';

//2. 查询所有的管理员信息
$sql = "select * from ali_admin";

//3. 执行SQL --- 返回资源（二维数组形式）
$res = mysql_query($sql);

//4. 转为二维数组
$arr = [];
while($row = mysql_fetch_assoc($res)){
    $arr[] = $row;
}

echo json_encode($arr);
?>