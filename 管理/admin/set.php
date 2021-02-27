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
	$user=daddslashes($_POST['user']);
	$pwd=daddslashes($_POST['pwd']);
	$money=daddslashes($_POST['money']);
	$sql="update `iapp_config` set `user` ='{$user}',`money` ='{$money}' where `id`='{$siteid}'";
	if(!empty($pwd))$DB->query("update `iapp_config` set `pwd` ='{$pwd}' where `id`='{$siteid}'");
	if($DB->query($sql))showmsg('修改成功！',1);
	else showmsg('修改失败！<br/>'.$DB->error(),4);
}else{
?>
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">网站设置</h3></div>
<div class="panel-body">
  <form action="./set.php" method="post" class="form-horizontal" role="form">

	<div class="form-group">
	  <label class="col-sm-2 control-label">用户赠送金币(注册)</label>
	  <div class="col-sm-10"><input type="text" name="money" value="<?php echo $conf['money']; ?>" class="form-control" required/></div>
	
	</div><br/>

	<div class="form-group">
	  <label class="col-sm-2 control-label">用户名</label>
	  <div class="col-sm-10"><input type="text" name="user" value="<?php echo $conf['user']; ?>" class="form-control" required/></div>
	
	</div><br/>

  <form action="./set.php" method="post" class="form-horizontal" role="form">
	<div class="form-group">
	  <label class="col-sm-2 control-label">后台密码设置</label>
	  <div class="col-sm-10"><input type="text" name="pwd" value="" class="form-control" placeholder="不修改请留空"/></div>
	  <br/>
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
