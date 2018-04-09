<?php 
//链接MySQL服务器
//参数1: MySQL服务器的地址，因为链接的是本机的MySQL，所以用localhost
//参数2: MySQL服务器的用户名，root是MySQL的最高权限用户
//参数3: 密码，用户对应的密码
//返回值: MySQL的链接资源
$conn = mysql_connect('localhost', 'root', '123');
mysql_select_db('alishow');
mysql_query('set names utf8');
?>