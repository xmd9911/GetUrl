<?php
header('content-type:text/html;charset=utf-8');
session_start();

//注销登录
if(isset($_POST['action'])){
    if($_GET['action'] == "logout"){
        unset($_SESSION['userid']);
        unset($_SESSION['username']);
        echo '注销登录成功！点击此处 <a href="login.html">登录</a>';
        exit;
    };
}
require("config.php");

//登录
if(!isset($_POST['submit'])){
    exit('非法访问!');
}
$username = addslashes(htmlspecialchars($_POST['username']));
$password = MD5($_POST['password']);

//包含数据库连接文件

try {
    $dbh = new PDO($g_dsn, $g_user, $g_pass);
} catch (PDOException $e)
{
    echo 'Connection failed: ' . $e->getMessage();
}
foreach ($dbh->query("select uid from ipuser where username='$username' and password='$password' limit 1") as $row)
{
    //登录成功
    $_SESSION['username'] = $username;
    $_SESSION['userid'] = $row['uid'];
    echo"<script> top.location='Index.php'; </script>";
    exit;
}

    exit('登录失败！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');


?>