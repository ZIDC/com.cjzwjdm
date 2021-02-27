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
	$qd=daddslashes($_POST['qd']);
	$qdjb=daddslashes($_POST['qdjb']);
	$qdip=daddslashes($_POST['qdip']);
	$sql="update `iapp_config` set `qd` ='{$qd}',`qdjb` ='{$qdjb}',`qdip` ='{$qdip}' where `id`='{$siteid}'";
	if($DB->query($sql))showmsg('修改成功！',1);
	else showmsg('修改失败！<br/>'.$DB->error(),4);
}else{
?>
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">签到配置</h3></div>
<div class="panel-body">
  <form action="./qdinfo.php" method="post" class="form-horizontal" role="form">

	<div class="form-group"> <div/>
	  <label class="col-sm-2 control-label">签到开关</label><div class="col-sm-10">
<select name="qd" class="form-control" default="<?php echo $conf['qd']; ?>">
	  <option value="1">开启</option>
       <option value="0">关闭</option>     
	  </select><div/><br/>
	<div class="form-group"> <div/>
	  <label class="col-sm-2 control-label">签到IP验证</label><div class="col-sm-10">
<select name="qdip" class="form-control" default="<?php echo $conf['qdip']; ?>">
	  <option value="1">开启</option>
       <option value="0">关闭</option>     
	  </select><div/><br/>




	<div class="form-group">
	  <label class="col-sm-2 control-label">签到赠送金币</label>
	  <div class="col-sm-10"><input type="text" name="qdjb" value="<?php echo $conf['qdjb']; ?>" class="form-control" required/></div>
	
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
