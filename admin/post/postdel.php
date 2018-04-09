<?php  
//1. 接收要被删除的文章id
$id = $_GET['id'];
//2. 链接数据库
include_once '../include/mysql.php';
//3. 编写SQL语句并执行
$sql = "delete from ali_article where article_id=$id";
$res = mysql_query($sql);
//4. 根据结果返回数据
if($res){
    $result = '{
        "code": 200,
        "msg" : "删除文章成功"
    }';
} else {
    $result = '{
        "code": 500,
        "msg" : "删除文章失败"
    }';
}
echo $result;
?>