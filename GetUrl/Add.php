<?php
header('content-type:text/html;charset=utf-8');
session_start();

//检测是否登录，若没登录则转向登录界面
if(!isset($_SESSION['userid'])){
    header("Location:login.html");
    exit();
}
?>
<?php
require("config.php");
$name="";
$jmpurl="";
$title="";
$png="";
$content="";
$uid=$_SESSION['userid'];
if (isset($_POST["username"]))
{
    $name=addslashes(trim($_POST["username"]));

}
if (isset($_POST["jmpurl"]))
{
    $jmpurl=addslashes(trim($_POST["jmpurl"]));
}
if (isset($_POST["title"]))
{
    $title=addslashes(trim($_POST["title"]));
}
if (isset($_POST["png"]))
{
    $png=addslashes(trim($_POST["png"]));
}
if (isset($_POST["content"]))
{
    $content=addslashes(trim($_POST["content"]));
}
if (empty($name)||empty($jmpurl)||empty($title)||empty($png)||empty($content))
{
    echo"<script>alert('请填写');history.go(-1);</script>";
    die(0);
}
$randId=build_order_no();



try {
    $dbh = new PDO($g_dsn, $g_user, $g_pass);
} catch (PDOException $e)
{
    echo 'Connection failed: ' . $e->getMessage();
}


    //在表user_list中插入数据
    $dbh->exec("insert into ipinfo(uid,urlname, jmpurl, randid,title,png,content) values($uid,'$name','$jmpurl','$randId','$title','$png','$content')");
    if ($dbh->errorCode() != '00000')
    {echo "errorInfo为： ";
        print_r($pdo->errorInfo());
       die(0);
}
echo"<script>alert(\"生成完成！\"); top.location='Index.php'; </script>";
function build_order_no()
{
    return base64_encode (date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8));
}

?>