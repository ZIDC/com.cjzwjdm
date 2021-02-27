<?php
$mod='blank';
include("../includes/common.php");
$title='后台管理';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
function alert($tips)
{
return '<script>window.alert("'.$tips.'");window.location.href="./kmlist.php";</script>';
}
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
<?php 

if($_GET['my']=='rm')
{
$rs=$DB->query("SELECT * FROM km_list WHERE 1");
while($res = $DB->fetch($rs))
{
$id = $res['id'];
$sql="DELETE FROM km_list WHERE id='$id' limit 1";
$DB->query($sql);
}
exit(alert("清空完成"));
}

if($_GET['my']=='s')
{
$rs=$DB->query("SELECT * FROM km_list WHERE status=1");
while($res = $DB->fetch($rs))
{
$id = $res['id'];
$sql="DELETE FROM km_list WHERE id='$id' limit 1";
$DB->query($sql);
}
exit(alert("清空所有已使用卡密完成"));
}

if($_GET['my']=='del'){
	$id=intval($_GET['id']);
	$sql="DELETE FROM km_list WHERE id='$id' limit 1";
	if($DB->query($sql)){
		showmsg('删除成功！',1,$_SERVER['HTTP_REFERER']);exit;
	}
	else showmsg('删除失败！<br/>'.$DB->error(),4,$_SERVER['HTTP_REFERER']);exit;
}
	$gls=$DB->count("SELECT count(*) from km_list WHERE 1");
	$sql=" 1";
	//$con='当前系统共有 <b>'.$gls.'</b> 个卡密';


$pagesize=30;
if (!isset($_GET['page'])) {
	$page = 1;
	$pageu = $page - 1;
} else {
	$page = $_GET['page'];
	$pageu = ($page - 1) * $pagesize;
}

$ok=$DB->count("SELECT count(*) from km_list WHERE status=0");
$no=$DB->count("SELECT count(*) from km_list WHERE status=1");
echo '当前系统共有：<b>'.$gls.'</b>张卡密，其中<b>'.$ok.'</b>张卡密未使用，<b>'.$no.'</b>张卡密已使用<br/><br/>功能选项：[<a href="./kmlist.php?my=rm"onclick="return confirm(\'你真的要清空所有卡密吗\');">清空卡密</a>] [<a href="./kmlist.php?my=s"onclick="return confirm(\'你真的要清空所有已使用卡密吗\');">清空已使用卡密</a>]';
?>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>ID</th><th>卡密</th><th>金额</th><th>状态</th><th>操作</th></tr></thead>
          <tbody>
<?php
$rs=$DB->query("SELECT * FROM km_list WHERE{$sql} order by id desc limit $pageu,$pagesize");
while($res = $DB->fetch($rs))
{
echo '<tr><td>'.$res['id'].'</td><td>'.$res['km'].'</td><td>'.$res['money'].'</td>';
if($res['status'] == '0')
{
echo '<td><font color="green">未使用</font></td>';
}
elseif($res['status'] == '1')
{
echo '<td><font color="red">已使用</font></td>';
}
echo '<td> <a href="./kmlist.php?my=del&id='.$res['id'].'" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除这个卡密吗？\');">删除</a></td></tr>';
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
echo '<li><a href="kmlist.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="kmlist.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="kmlist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$s;$i++)
echo '<li><a href="kmlist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$s)
{
echo '<li><a href="kmlist.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="kmlist.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
#分页
?>
    </div>
  </div>