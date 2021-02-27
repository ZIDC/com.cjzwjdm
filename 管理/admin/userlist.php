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
	$gls=$DB->count("SELECT count(*) from user_list WHERE 1");
	$sql=" 1";
	$con='当前系统共有 <b>'.$gls.'</b> 个用户';

$pagesize=30;
if (!isset($_GET['page'])) {
	$page = 1;
	$pageu = $page - 1;
} else {
	$page = $_GET['page'];
	$pageu = ($page - 1) * $pagesize;
}

echo $con;
?>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>ID</th><th>用户名</th><th>金币数量</th><th>注册时间</th> <th>密码</th> <th>操作</th></tr></thead>
          <tbody>
<?php
$rs=$DB->query("SELECT * FROM user_list WHERE{$sql} order by id desc limit $pageu,$pagesize");
while($res = $DB->fetch($rs))
{
$pass = $res["pass"];//显示部分密码
echo '<tr><td>'.$res['id'].'</td><td>'.$res['user'].'</td><td>'.$res["money"].'</td><td>'.$res['date'].'</td><td>'.$pass[0].$pass[1].'****</td><td><a href="./edit.php?my=update&id='.$res['id'].'" class="btn btn-xs btn-info">修改</a> <a href="./edit.php?my=del&id='.$res['id'].'" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除这个用户吗？\');">删除</a></td></tr>';
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
echo '<li><a href="userlist.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="userlist.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="userlist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$s;$i++)
echo '<li><a href="userlist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$s)
{
echo '<li><a href="userlist.php?page='.$next.$link.'">&raquo;</a></li>';
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