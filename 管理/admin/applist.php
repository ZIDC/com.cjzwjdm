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
$c = glob("../app/*");
$con = "当前系统共有<b>".count($c)."</b>个软件程序";
if($_GET["s"]==1){
$i = base64_decode($_GET["id"]);
@unlink($i);
exit(showmsg("软件删除成功",1));
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
?>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>ID</th><th>识别号</th> <th>文件名称</th> <th>文件类型</th> <th>操作</th></tr></thead>
          <tbody>
<?php
$glob = glob("../app/*");
for($i=0;$i<count($glob);$i++){
$res["id"] = $i + 1;
$res["u"] = $glob[$i];
$us = str_replace("../app/","",$glob[$i]);
$u = explode(".",$us);
$res["b"] =$u[0];
$res["t"] = $u[1];
$res["sid"]=base64_encode($res["u"]);
echo '<tr><td>'.$res['id'].'</td><td>'.$res['b'].'</td> <td>'.$us.'</td> <td>'.$res['t'].'</td> <td><a href="'.$res["u"].'" class="btn btn-xs btn-info">下载</a> <a href="./applist.php?s=1&id='.$res['sid'].'" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除这个应用吗？\');">删除</a> </td></tr>';
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
echo '<li><a href="applist.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="applist.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="applist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$s;$i++)
echo '<li><a href="applist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$s)
{
echo '<li><a href="applist.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="applist.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
#分页
?>
    </div>
  </div>