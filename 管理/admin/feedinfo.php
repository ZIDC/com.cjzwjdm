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
	$feed=daddslashes($_POST['feed']);
	$keyword=daddslashes($_POST['keyword']);
	$feedsize=daddslashes($_POST['feedsize']);
	$feedsame=daddslashes($_POST['feedsame']);

	$sql="update `iapp_config` set `feed` ='{$feed}',`feedkeyword` ='{$keyword}',`feedsize` ='{$feedsize}',`feedsame` ='{$feedsame}' where `id`='{$siteid}'";
	if($DB->query($sql))showmsg('修改成功！',1);
	else showmsg('修改失败！<br/>'.$DB->error(),4);
}else{
?>
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">反馈配置</h3></div>
<div class="panel-body">
  <form action="./feedinfo.php" method="post" class="form-horizontal" role="form">

	<div class="form-group"> <div/>
	  <label class="col-sm-2 control-label">反馈开关</label><div class="col-sm-10">
<select name="feed" class="form-control" default="<?php echo $conf['feed']; ?>">
	  <option value="1">开启</option>
       <option value="0">关闭</option>     
	  </select><div/><br/>

	<div class="form-group"> <div/>
	  <label class="col-sm-2 control-label">防同信息提交</label><div class="col-sm-10">
<select name="feedsame" class="form-control" default="<?php echo $conf['feedsame']; ?>">
	  <option value="1">开启</option>
       <option value="0">关闭</option>     
	  </select><div/><br/>

			<div class="form-group">
              <label class="col-sm-2 control-label">反馈信息长度限制(最低-最长)</label>
              <div class="col-sm-10"><input type="text" name="feedsize" value="<?php echo $conf['feedsize']; ?>" class="form-control" required/></div>
            </div><br/>

	<div class="form-group">
	  <label class="col-sm-2 control-label">敏感词屏蔽(,隔开)</label>
	
	  <div class="col-sm-10"><textarea class="form-control" name="keyword" rows="6"><?php echo $conf['feedkeyword']; ?></textarea></div>

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
