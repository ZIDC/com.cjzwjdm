<?php
$mod='blank';
include("../includes/common.php");
$title='后台管理';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
<?php
	$gls=$DB->count("SELECT count(*) from qd_list WHERE 1");
	$sql=" 1";
	$con='当前系统共有 <b>'.$gls.'</b> 个签到记录';
function alert($tips)
{
return '<script>window.alert("'.$tips.'");window.location.href="./qdlist.php";</script>';
}

if($_GET['my']=='rm')
{
$rs=$DB->query("SELECT * FROM qd_list WHERE 1");
while($res = $DB->fetch($rs))
{
$id = $res['id'];
$sql="DELETE FROM qd_list WHERE id='$id' limit 1";
$DB->query($sql);
}
exit(alert("日志清空完成"));
}

$pagesize=30;
if (!isset($_GET['page'])) {
	$page = 1;
	$pageu = $page - 1;
} else {
	$page = $_GET['page'];
	$pageu = ($page - 1) * $pagesize;
}

echo $con;
?> <br/>功能选项：[<a href="./qdlist.php?my=rm"onclick="return confirm(\'清空日志后，所有用户可以重新签到，你确定清空吗\');">清空日志</a>]
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>ID</th><th>用户名</th><th>签到IP</th><th>签到时间</th> <th>奖励金币</th></tr></thead>
          <tbody>
<?php
$rs=$DB->query("SELECT * FROM qd_list WHERE{$sql} order by id desc limit $pageu,$pagesize");
while($res = $DB->fetch($rs))
{
echo '<tr><td>'.$res['id'].'</td><td>'.$res['user'].'</td><td>'.$res["ip"].'</td><td>'.$res['date'].'</td><td>'.$res["money"].'</td></td></tr>';
}
?>
          </tbody>
        </table>
      </div>
<?php
echo'<ul class="pagination">';
$s = ceil($gls / $pagesize);
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$s;
if ($page>1)
{
echo '<li><a href="qdlist.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="qdlist.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="qdlist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$s;$i++)
echo '<li><a href="qdlist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$s)
{
echo '<li><a href="qdlist.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="list.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
#分页
?>
    </div>
  </div>