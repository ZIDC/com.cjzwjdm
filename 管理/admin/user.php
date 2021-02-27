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

if(isset($_POST['user']) && isset($_POST['pass'])){
$money=daddslashes($_POST['money']);
$user=daddslashes($_POST['user']);
$pass=daddslashes($_POST['pass']);
$date = date("Y-m-d H:i:s");
if(is_numeric($money)==false){
if(is_numeric($conf["money"])){
$money = $conf["money"];
}
else{
$money = 0;//不添加金额
}
}
$row=$DB->get_row("SELECT * FROM user_list WHERE user='{$user}' limit 1");
if($row!='')exit(showmsg("该用户名已经存在",4));
	$sql="insert into `user_list` (`user`,`pass`,`money`,`date`) values ('$user','$pass','$money','$date')";
if($DB->query($sql)){

exit(showmsg("用户[".$user."]添加成功",1,"./userlist.php"));

}
else{
exit(showmsg("用户[".$user."]添加失败<br/>错误信息:".$DB->error(),4));
}

} ?>
      <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">添加用户</h3></div>
        <div class="panel-body">
          <form action="./user.php" method="post" class="form-horizontal" role="form">
            <div class="input-group">
              <span class="input-group-addon">用户名</span>
              <input type="text" name="user" value="<?=@$_POST['user']?>" class="form-control" placeholder="admin" autocomplete="off" required/>
            </div><br/>
            <div class="input-group">
              <span class="input-group-addon">密码</span>
              <input type="password" name="pass" value="<?=@$_POST['pass']?>" class="form-control" placeholder="123456" autocomplete="off" required/>
            </div><br/>
            <div class="input-group">
              <span class="input-group-addon">金币数量</span>
              <input type="number" name="money" class="form-control"  value="<?=$conf['money']?>" placeholder="0" autocomplete="off" required/>
            

            </div><br/>
            <div class="form-group">
              <div class="col-sm-12"><input type="submit" value="添加" class="btn btn-primary form-control"/></div>
            </div>
          </form>
      </div>
    </div>
  </div>