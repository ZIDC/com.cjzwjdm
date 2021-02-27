<?php
include("../includes/common.php");
$title='后台首页';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
<?php
$count1=$DB->count("SELECT count(*) from user_list where 1");
$mysqlversion=$DB->count("select VERSION()");
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
      <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">后台管理首页</h3></div>
          <ul class="list-group">
			<li class="list-group-item"><span class="glyphicon glyphicon-tint"></span> <b></b>平台用户数量：<?php echo $count1?></li>
            <li class="list-group-item"><span class="glyphicon glyphicon-time"></span> <b>现在时间：</b> <?=date("Y-m-d H:i:s")?></li>
			<li class="list-group-item"><span class="glyphicon glyphicon-home"></span><a href="./userlist.php" class="btn btn-xs btn-success">用户管理</a>&nbsp;<a href="./kmlist.php" class="btn btn-xs btn-warning">卡密管理</a>
			</li>
          </ul>
      </div>


<div class="panel panel-info">
	<div class="panel-heading text-center">
		<h3 class="panel-title">安全中心</h3>
	</div>
	<ul class="list-group">
<?php
if($conf["pwd"] == "123456" and $conf["user"] == "admin"){
echo '<li class="list-group-item"><span class="btn-sm btn-danger">高危</span>&nbsp;请修改默认密码，防止黑客破解</li>';
$safe = 1;
$p = 1;
}
if($conf["pwd"]==$conf["user"]){
echo '<li class="list-group-item"><span class="btn-sm btn-danger">高危</span>&nbsp;账号密码相同，极易被恶意破解</li>';

}
if(strlen($conf["pwd"]) < 6){
echo '<li class="list-group-item"><span class="btn-sm btn-warning">建议</span>&nbsp;请设置大于6位的密码，降低爆破风险</li>';
$safe = 1;
}

if(is_numeric($conf["pwd"])){
if(empty($p)){
echo '<li class="list-group-item"><span class="btn-sm btn-warning">建议</span>&nbsp;密码建议不要设置为QQ或其他数字</li>';

$safe = 1;
}
}
if($dbconfig["user"]==$dbconfig["pwd"]){
echo '<li class="list-group-item"><span class="btn-sm btn-danger">危险</span>&nbsp;数据库账号密码相同，极易被黑客破解</li>';

}
if(preg_match("/5.6|56/",phpversion())==false){
echo '<li class="list-group-item"><span class="btn-sm btn-info">提示</span>&nbsp;为了网站更高性能，请将php版本调至5.6</li>';

}
$glob = glob("../*");
if($glob){
for($i=0;$i<count($glob);$i++){
if(preg_match("/.zip|.rar|.7z|.tar.gz/",$glob[$i])){

echo '<li class="list-group-item"><span class="btn-sm btn-warning">建议</span>&nbsp;网站根目录下存在压缩包文件，极易被恶意下载</li>';

$safe = 1;
}
else{
continue;
}
}
}
$func = ['exec','system','syslog','popen','shell_exec','dl','passthru','putenv','chroot','chown','readlink'];
for($i=0;$i<count($func);$i++){
if(function_exists($func[$i])){
$safe = 1;
echo '<li class="list-group-item"><span class="btn-sm btn-danger">危险</span>&nbsp;系统函数:<b>'.$func[$i].'</b>尚未被禁止</li>';
}
}
if(preg_match("/\/admin\//",__DIR__)){
echo '<li class="list-group-item"><span class="btn-sm btn-warning">建议</span>&nbsp;网站默认后台地址尚未重命名,若密码泄漏，极易被恶意使用</li>';

$safe = 1;

}
if(empty($safe))
{
echo '<li class="list-group-item"><span class="btn-sm btn-success">安全</span>&nbsp;暂未发现网站安全问题</li>';
}
?>
	</ul>
</div>

      
      
      
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">服务器信息</h3>
	</div>
	<ul class="list-group">
		<li class="list-group-item">
			<b>PHP 版本：</b><?php echo phpversion() ?>
			<?php if(ini_get('safe_mode')) { echo '线程安全'; } else { echo '非线程安全'; } ?>
		</li>
		<li class="list-group-item">
			<b>MySQL 版本：</b><?php echo $mysqlversion ?>
		</li>
		<li class="list-group-item">
			<b>服务器软件：</b><?php echo $_SERVER['SERVER_SOFTWARE'] ?>
		</li>
		
		<li class="list-group-item">
			<b>程序最大运行时间：</b><?php echo ini_get('max_execution_time') ?>s
		</li>
		<li class="list-group-item">
			<b>POST许可：</b><?php echo ini_get('post_max_size'); ?>
		</li>
		<li class="list-group-item">
			<b>文件上传许可：</b><?php echo ini_get('upload_max_filesize'); ?>
		</li>
	</ul>
</div>
    </div>
  </div>