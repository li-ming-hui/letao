<?php 
session_start();
if(empty($_SESSION['id'])){
    echo "您尚未登录，请登录后再访问";
    header('refresh:2;url=/admin/login.html');
    die;
}
?>