<?php
header('content-type:text/html;charset=utf-8');
session_start();

//检测是否登录，若没登录则转向登录界面
if(isset($_SESSION['userid']))
{
    unset($_SESSION['userid']);
    unset($_SESSION['username']);
}
header("Location:login.html");
exit();
?>