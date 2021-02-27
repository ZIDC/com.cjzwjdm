<?php

include("../includes/common.php");
$title='用户公告';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
$my=isset($_GET['my'])?$_GET['my']:null;
?>
<div class="container" style="padding-top:70px;">
<div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
<?php
$my=isset($_GET['my'])?$_GET['my']:null;

if($my == "edit"){
$id=intval($_GET['id']);
$row=$DB->get_row("select * from iapp_notice where id='$id' limit 1");

echo '<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">公告信息</h3></div>';
echo '<div class="panel-body">';
echo '<form action="./notice.php?my=edit_submit&id='.$id.'" method="POST">

<div class="input-group">
<span class="input-group-addon">公告内容</span>
<textarea class="form-control" name="center" rows="6">';echo htmlspecialchars($row['center']);echo '</textarea>
</div><br/>

<input type="submit" class="btn btn-primary btn-block" value="确定修改"></form>';
echo '<br /><a href="./notice.php">>>返回公告列表</a>';
echo '</div></div>';
}elseif($my=='edit_submit'){
$id=intval($_GET['id']);
$center=daddslashes($_POST['center']);
if($DB->query("update iapp_notice set center='$center' where id='{$id}'"))
echo "<script language='javascript'>alert('修改成功');window.location.href='./notice.php';</script>";
else
echo "<script language='javascript'>alert('修改失败');window.location.href='./notice.php';</script>";
}else{
?>
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">用户公告</h3></div>
<div class="panel-body">
<form action="./notice.php?my=add_submit" method="POST">

<div class="input-group">
<span class="input-group-addon">公告内容</span>
<textarea class="form-control" rows="10" name="center" placeholder="支持HTML编程代码"></textarea>
</div><br/>

<div class="form-group">
<div class="col-sm-12"><input type="submit" name="submit" value="添加" class="btn btn-primary form-control"/></div>
</div>

</div>
</form>
<div class="table-responsive">
<table class="table table-striped">
<thead><tr><th>UID</th><th>内容</th><th>添加时间</th><th>操作</th></tr></thead>
<tbody>
<?php
$rs=$DB->query("SELECT * FROM iapp_notice WHERE 1 order by id asc");
while($res = $DB->fetch($rs))
{
echo '<tr><td><b>'.$res['id'].'</b></td><td>'.substr($res['center'],0,100).'</td><td>'.$res['date'].'</td><td><a href="./notice.php?my=edit&id='.$res['id'].'" class="btn btn-xs btn-info">编辑</a> <a href="./notice.php?my=del_submit&id='.$res['id'].'" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除此任务吗？\');">删除</a></td></tr>';
}
?>
</tbody>
</table>
</div>
</div>
<?php
}if($my=="add_submit"){
if($_POST['center'] == NULL) {
echo "<script language='javascript'>alert('信息不能为空');window.location.href='./notice.php';</script>";
}else{
$center=daddslashes($_POST['center']);
echo "<script language='javascript'>alert('添加成功！');window.location.href='./notice.php';</script>";
$DB->query("insert into `iapp_notice` (`center`,`date`) values ('".$center."','".$date."')");
}
}elseif($my == "del_submit"){
$id = $_GET['id'];

$sql="alter table `iapp_notice` AUTO_INCREMENT=1";
$DB->query("DELETE FROM iapp_notice WHERE id='$id'");
if($DB->query($sql))
echo "<script language='javascript'>alert('删除成功');window.location.href='./notice.php';</script>";
}
?>
</div>
</div>