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
if($_GET['my']=='update') {
$id=intval($_GET['id']);
$row=$DB->get_row("SELECT * FROM feed_list WHERE id='{$id}' limit 1");
if($row=='')exit(showmsg("后台不存在该反馈",4));
if(isset($_POST['submit'])) {
	$return=daddslashes($_POST['return']);


		$sql="update `feed_list` set `return` ='{$return}' where `id`='{$id}'";
	if($DB->query($sql)){
		showmsg('回复成功！',1,$_POST['backurl']);
	}
	else showmsg('回复失败！<br/>'.$DB->error(),4,$_POST['backurl']);
}else{
?>
      <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">回复反馈</h3></div>
        <div class="panel-body">
          <form action="./feededit.php?my=update&id=<?php echo $id; ?>" method="post" class="form-horizontal" role="form">
		  <input type="hidden" name="backurl" value="<?php echo $_SERVER['HTTP_REFERER']; ?>"/>
			<div class="form-group">
              <label class="col-sm-2 control-label">反馈时间</label>
              <div class="col-sm-10"><input type="text" value="<?php echo $row['date']; ?>" class="form-control" readonly/></div>
            </div><br/>


	<div class="form-group">
	  <label class="col-sm-2 control-label">反馈内容</label>
	
	  <div class="col-sm-10"><textarea class="form-control" rows="6" readonly><?php echo $row['data']; ?></textarea></div>

</div><br/>

	<div class="form-group">
	  <label class="col-sm-2 control-label">回复内容</label>
	
	  <div class="col-sm-10"><textarea class="form-control" name="return" rows="6"><?php echo $row['return']; ?></textarea></div>

</div><br/>


            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
			  <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">返回反馈列表</a></div>
            </div>
          </form>
        </div>
      </div>
<?php
}
}elseif($_GET['my']=='del'){
	$id=intval($_GET['id']);
	$sql="DELETE FROM feed_list WHERE id='$id' limit 1";
	if($DB->query($sql)){
		showmsg('删除成功！',1,$_SERVER['HTTP_REFERER']);
	}
	else showmsg('删除失败！<br/>'.$DB->error(),4,$_SERVER['HTTP_REFERER']);
}?>

    </div>
  </div>