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
$id=0;


if (isset($_GET["id"]))
{
    $id=intval($_GET["id"]);

}

if ($id==0)
{
    die(0);
}
$uid=$_SESSION['userid'];

require("config.php");

$url="bbs.microdesktop.com";
try {
    $dbh = new PDO($g_dsn, $g_user, $g_pass);
} catch (PDOException $e)
{
    echo 'Connection failed: ' . $e->getMessage();
}

foreach ($dbh->query("SELECT * FROM ipinfo where uid=$uid and id=".$id) as $row)
{
    $title= $row['title'];
    $png= $row['png'];
    $content= $row['content'];
    $magic=$row['randid'];
   // http://connect.qq.com/widget/shareqq/index.html?url=http%3A%2F%2Fbbs.microdesktop.com/index.php%3Fid%3D41P3w80rxV2&desc=&title=%E8%85%BE%E4%BF%A1%20-%20%E9%80%81qb&summary=%E9%A9%AC%E5%8C%96%E8%85%BE70%E5%B2%81%E7%94%9F%E6%97%A5%EF%BC%8C%E7%8E%B0%E5%9C%A8%E6%AF%8F%E4%BA%BA%E9%80%81100%E4%B8%AAqb%EF%BC%88%E6%9D%A5%E8%87%AA%20PC%20%E9%85%B7%E7%8B%97%E9%9F%B3%E4%B9%90%EF%BC%89&pics=http://imge.kugou.com/stdmusic/135/20150720/20150720173400344661.jpg&flash=&site=bbs.microdesktop.com
    $url="http://www.tencentbaby.com/widget/shareqq/index.html?url=".$g_rootUrl."Parser.php?id=".$magic."&desc=&title=".$title."&summary=".$content."&pics=".$png."&flash=&site=".$g_doman;
}

?>

<!DOCTYPE html><html><head>  <meta http-equiv="Content-Type" content="text/html; charset=gb18030"/>  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />    <style>    /* common */    td,input,button,select,body {font-family:"lucida Grande",Verdana;font-size:12px;}    h1,h2,h3,h4,h5,h6 {font-size:12px; font-weight:normal; margin:0;}    ul,li{list-style:none;}    input,textarea,a {outline:none;}    form,body,ul,li {margin:0;padding:0;}    select,body,textarea {background:#fff;font-size:12px;}    select {font-weight:normal; font-size:12px; font-family:Tahoma;line-height:20px;}    textarea {width:540px;border:1px solid #718da6;padding:3px;font-family:"lucida Grande",Verdana;}    img {border:none}    body {        padding: 0 30px;    }    a {text-decoration:none;cursor:pointer;outline:none;}    a:hover {text-decoration:underline;}    a,a:link,a:visited,li.fs a.fdleft:hover,li.fd_mg a.fdleft:hover {color:#1e5494;}    a.btn_blue{display:inline-block;_overflow:hidden; padding:6px 25px; margin:0; font-size:14px;font-weight:bold;text-align:center; border-radius:3px;}    a.btn_blue:focus, a.btn_red:focus, a.btn_gray:focus {border-color:#93d4fc; box-shadow:0 0 5px #60caff;}    a.btn_blue:active, a.btn_red:active, a.btn_gray:active {outline:none;}    a.btn_blue{border:1px solid #0d659b; color:#fff; color:#fff!important; background-color:#238aca; background:-moz-linear-gradient(top, #238aca, #0074bc); background:-webkit-linear-gradient(top, #238aca, #0074bc); filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#238aca', endColorstr='#0074bc'); -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr='#238aca', endColorstr='#0074bc')";}    a.btn_blue:hover{text-decoration:none; background-color:#238aca; background:-moz-linear-gradient(top, #2a96d8, #0169a9); background:-webkit-linear-gradient(top, #2a96d8, #0169a9); filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#2a96d8', endColorstr='#0169a9'); -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr='#2a96d8', endColorstr='#0169a9')";}    a.btn_blue:active{background-color:#238aca; background:-moz-linear-gradient(top, #0074bc, #238aca); background:-webkit-linear-gradient(top, #0074bc, #238aca); filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#0074bc', endColorstr='#238aca'); -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr='#0074bc', endColorstr='#238aca')";}    .hide {visibility:hidden;}    /* remind_block 带icon的消息提示块 */    .remind_block {overflow:hidden;}    .remind_block .remind_icon {float:left;margin-right:10px;width:32px;height:32px;background:url(resource/qq1.png) no-repeat;}    .remind_block .remind_content {overflow:hidden;*zoom:1;}    .remind_block .remind_title {margin-bottom:10px;padding-top:3px;_margin-top:4px;font-weight:bold;font-size:20px;font-family:"Microsoft YaHei","lucida Grande",Verdana;}    .remind_block .remind_detail {line-height:1.5;font-size:14px;color:#535353;}    .remind_block.notitle .remind_content {padding-top:8px;}    .error .remind_icon {background-position:-256px top;}    .error .remind_title {color:#cc0000;}    .warning .remind_icon {background-position:-64px 0;}    .warning .remind_title {color:#d68300;}    /* layout */    .container {      max-width:640px;      margin:0 auto;      padding-top:25px;    }    .header {      margin-bottom:5px;    }    .footer {      margin-top:18px;      text-align:center;      color:#a0a0a0;      font-size:10px;    }    .content {      border:1px solid #bbb;      box-shadow:0 0 3px #d4d4d4;    }    .c-container {      padding:30px;    }    .c-footer {      padding:10px 15px;      background:#f1f1f1;  border-top:1px solid #bbb;      overflow:hidden;      *zoom:1;    }    .c-footer-a1,.c-footer-a2,.c-footer-a3 {float:left;}    .c-footer-a2 {margin:8px 0 0 15px;}    /* page */    .safety-detail {      font-size:12px;      margin-top:10px;  padding-bottom:60px;  -webkit-transition:padding 0.2s ease-in;  -moz:padding 0.2s ease-in;  transition:padding 0.2s ease-in;    }    .safety-detail.show .safety-icon-arrow {  background-position:right top;  -webkit-transform:rotate(180deg);  -moz-transform:rotate(180deg);  transform:rotate(180deg);    }@media screen and (-webkit-min-device-pixel-ratio:0) {      .safety-detail.show .safety-icon-arrow {    background-position:right -18px;  }}@-moz-document url-prefix() {      .safety-detail.show .safety-icon-arrow {    background-position:right -18px;  }}    .safety-detail.show .safety-detail-txt {      /*visibility:visible;*/  height:60px;    }       .safety-detail-txt {      margin-top:6px;      line-height:20px;      color:#a0a0a0;      /*visibility:hidden;*/  height:0;  overflow:hidden;  -webkit-transition:height 0.2s ease-in;  -moz:height 0.2s ease-in;  transition:height 0.2s ease-in;    }    .safety-url {      margin-bottom:15px;      padding-bottom:15px;      border-bottom:1px solid #dfdfdf;      word-wrap:break-word;      word-break:break-all;    }.ico_Avira{display:inline-block;width:12px;height:13px;_font-size:12px;margin:0 2px -2px 0;background:url(resource\qq4.png) scroll -48px -208px no-repeat;background-image:-webkit-image-set(url(resource\qq3.png) 1x, url(resource\qq2.png) 2x);}@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min-device-pixel-ratio: 2){.remind_block .remind_icon {background-image:-webkit-image-set(url(resource\qq5.png) 1x,url(resource\qq6.png) 2x);}}.safety-qqbrowser{font-size:14px;line-height:1.5;margin-top:12px;-webkit-transition:margin 0.2s ease-in;-moz-transition:margin 0.2s ease-in;-o-transition:margin 0.2s ease-in;transition:margin 0.2s ease-in;}.show{padding-bottom:0;}    @media (max-width: 420px) {        .remind_icon {            display: none;        }    }  </style></head>        <body>  <div class="container">    <div class="header">         </div>    <div class="content">      <div class="c-container warning">        <div id="remind_block" class="remind_block">          <span class="remind_icon"></span>          <div class="remind_content">            <div class="remind_title">您将要访问：</div>            <div class="remind_detail">              <div class="safety-url"><?=$url?></div>                            或者自己复制链接到安装qq的电脑上，在浏览器中运行                          </div>          </div>        </div>      </div>      <div class="c-footer">        <a onclick="goUrl(1);" class="c-footer-a1 btn_blue">继续访问</a><a class="c-footer-a2" onclick="closeURLWindow()">关闭网页</a>      </div>    </div>      </div>  <script type="text/javascript">


    function goUrl(type) {
        window.location.replace("<?=$url?>")
       // setTimeout(function(){window.location.replace(<?=$url?>)},50);
    }
    function closeURLWindow() {
        //  report(2);
        setTimeout( function(){ window.close(); }, 80 );
    }

    window.onload = function() {
        // report(10);
        var detailContainer = document.getElementById("detail_container");
        var detailToggle = document.getElementById("detail_toggle");
        var container = document.getElementById("remind_block");
        var containerClassName = "safety-detail";
        if(detailToggle) {
            detailToggle.onclick = function() {

                var offsetHeight = container.offsetHeight;
                if(offsetHeight){
                    container.style.height = container.offsetHeight + 'px';
                }

                if(detailContainer.className.indexOf("show") > -1) {
                    detailContainer.className = containerClassName;
                } else {
                    detailContainer.className = containerClassName + " show";
                }
            }
        }
    }
</script></body></html>
