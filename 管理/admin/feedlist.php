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
$gls=$DB->count("SELECT count(*) from feed_list WHERE 1");
	$sql=" 1";
$pagesize=30;
if (!isset($_GET['page'])) {
	$page = 1;
	$pageu = $page - 1;
} else {
	$page = $_GET['page'];
	$pageu = ($page - 1) * $pagesize;
}
?>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>ID</th><th>用户名</th><th>反馈时间</th> <th>客服回复</th> <th>操作</th></tr></thead>
          <tbody>
<?php
$rs=$DB->query("SELECT * FROM `feed_list` WHERE{$sql} order by id desc limit $pageu,$pagesize");
function tr($str=0){
if($str){
return '<a href="javascript:;" class="btn btn-xs btn-success">已回复</a>';
}
else{
return '<a href="javascript:;" class="btn btn-xs btn-warning">待回复</a>';

}
}
while($res = $DB->fetch($rs))
{
echo '<tr><td>'.$res['id'].'</td><td>'.$res['user'].'</td><td>'.$res["date"].'</td><td>'.tr($res['return']).'</td><td><a href="./feededit.php?my=update&id='.$res['id'].'" class="btn btn-xs btn-info">回复</a> <a href="./feededit.php?my=del&id='.$res['id'].'" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除这个反馈吗？\');">删除</a></td></tr>';
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
echo '<li><a href="feedlist.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="feedlist.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="feedlist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$s;$i++)
echo '<li><a href="feedlist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$s)
{
echo '<li><a href="feedlist.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="feedlist.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
#分页
?>
    </div>
  </div>