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
if(isset($_POST['submit'])) {
	$appname=daddslashes($_POST['appname']);
$appmsg=daddslashes($_POST['appmsg']);	$appversion=daddslashes($_POST['appversion']);
$appbuild=daddslashes($_POST['appbuild']);
	$sql="update `iapp_config` set `appname` ='{$appname}',`appversion` ='{$appversion}', `appmsg` ='{$appmsg}', `appbuild` ='{$appbuild}' where `id`='{$siteid}'";
	if($DB->query($sql))showmsg('修改成功！',1);
	else showmsg('修改失败！<br/>'.$DB->error(),4);
}else{
?>
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">软件信息配置</h3></div>
<div class="panel-body">
  <form action="./appinfo.php" method="post" class="form-horizontal" role="form">

	<div class="form-group">
	  <label class="col-sm-2 control-label">软件名称</label>
	  <div class="col-sm-10"><input type="text" name="appname" value="<?php echo $conf['appname']; ?>" class="form-control" required/></div>
	
	</div><br/>

	<div class="form-group">
	  <label class="col-sm-2 control-label">软件序列号(version)</label>
	  <div class="col-sm-10"><input type="text" name="appversion" value="<?php echo $conf['appversion']; ?>" class="form-control" required/></div>
	
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">软件识别号(build)</label>
	  <div class="col-sm-10"><input type="text" name="appbuild" value="<?php echo $conf['appbuild']; ?>" class="form-control" required/></div>
	
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">App更新内容</label>
	
	  <div class="col-sm-10"><textarea class="form-control" name="appmsg" rows="6"><?php echo $conf['appmsg']; ?></textarea></div>

</div><br/>

	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	 </div>
	</div>
  </form>
</div>
</div>
<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default"));
}
</script>
<?php
}?>

    </div>
  </div>
