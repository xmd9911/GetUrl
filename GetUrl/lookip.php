<?php
header('content-type:text/html;charset=utf-8');
session_start();

//检测是否登录，若没登录则转向登录界面
if(!isset($_SESSION['userid'])){
    header("Location:login.html");
    exit();
}
?>
<!-- Javascript goes in the document HEAD -->
<script type="text/javascript">
    function altRows(id){
        if(document.getElementsByTagName){

            var table = document.getElementById(id);
            var rows = table.getElementsByTagName("tr");

            for(i = 0; i < rows.length; i++){
                if(i % 2 == 0){
                    rows[i].className = "evenrowcolor";
                }else{
                    rows[i].className = "oddrowcolor";
                }
            }
        }
    }

    window.onload=function(){
        altRows('alternatecolor');
    }
</script>


<!-- CSS goes in the document HEAD or added to your external stylesheet -->
<style type="text/css">
    table.altrowstable {
        font-family: verdana,arial,sans-serif;
        font-size:11px;
        color:#333333;
        border-width: 1px;
        border-color: #a9c6c9;
        border-collapse: collapse;
    }
    table.altrowstable th {
        border-width: 1px;
        padding: 8px;
        border-style: solid;
        border-color: #a9c6c9;
    }
    table.altrowstable td {
        border-width: 1px;
        padding: 8px;
        border-style: solid;
        border-color: #a9c6c9;
    }
    .oddrowcolor{
        background-color:#d4e3e5;
    }
    .evenrowcolor{
        background-color:#c3dde0;
    }
</style>



<!-- this table is show all info in database -->
<table class="altrowstable" id="alternatecolor">
    <tr>
        <th style="width: 160px;">ID</th>
        <th style="width: 160px;">IP</th>

    </tr>
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

require("config.php");
try {
    $dbh = new PDO($g_dsn, $g_user, $g_pass);
} catch (PDOException $e)
{
    echo 'Connection failed: ' . $e->getMessage();
}
$uid=$_SESSION['userid'];

foreach ($dbh->query("SELECT * FROM iplist where uid=$uid and ipinfo_id=".$id) as $row)
{
    ?>
    <tr>
        <td style="width: 160px;"><?= $row['id'] ?></td>
        <td style="width: 160px;"><?= $row['ip'] ?></td>


    </tr>
    <?php
}

?>
    </table>
