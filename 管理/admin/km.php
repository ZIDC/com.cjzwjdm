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
$money = $_POST["money"];//面额
$num = $_POST["number"];//数量
if($money && $num)
{
if($num > '100')
{
exit(showmsg('卡密最大生成数不能大于100张<br/><br/><a href="./kmlist.php">>>返回卡密列表</a>', 4));
}
else
{
echo "<ul class='list-group'><li class='list-group-item active'>成功生成以下卡密</li>";
for ($i = 0; $i < $num; $i++) {
	$km = random("18");
$sql="insert into `km_list` (`km`,`money`,`status`) values ('$km','$money','0')";
$DB->query($sql);
	
		echo "<li class='list-group-item'>$km</li>";
	}
}
echo '<a href="./kmlist.php" class="btn btn-default btn-block">>>返回卡密列表</a>';exit;
}?>
      <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">添加卡密</h3></div>
        <div class="panel-body">
          <form action="./km.php" method="post" class="form-horizontal" role="form">
<?php 
for($i=1;$i<10001;$i++){
	$select.='<option value="'.$i.'">'.$i.'元</option>';
}

 echo '                   <div class="input-group">  <span class="input-group-addon">面额</span> <select name="money" class="form-control">'.$select.'</select> </div><br/>';
?>
            <div class="input-group">
              <span class="input-group-addon">生成数量</span>
              <input type="number" name="number" value="1" class="form-control" autocomplete="off" required/>
           </div><br/>
            <div class="form-group">
              <div class="col-sm-12"><input type="submit" value="添加" class="btn btn-primary form-control"/></div>
            </div>
          </form>

      </div>
    </div>
  </div>