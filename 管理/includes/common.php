<?php
error_reporting(0);
define('IN_CRONLITE', true);
define('SYSTEM_ROOT', dirname(__FILE__).'/');
define('ROOT', dirname(SYSTEM_ROOT).'/');
define('SYS_KEY', 'iapp_admin_key');
define('CC_Defender', 1); //防CC攻击开关(1为session模式)
include_once(SYSTEM_ROOT."function.php");
include_once(SYSTEM_ROOT."member.php");


if(phpversion() < 5.6){
exit(sysmsg("为了网站更高的性能，请将php版本设置为5.6或更高的版本"));
}
date_default_timezone_set("PRC");

$date = date("Y-m-d H:i:s");

session_start();

if(CC_Defender!=0)

if(is_file(SYSTEM_ROOT.'360safe/360webscan.php')){//360网站卫士
require_once(SYSTEM_ROOT.'360safe/360webscan.php');
}
require ROOT.'config.php';
if(!defined('SQLITE') && (!$dbconfig['user']||!$dbconfig['pwd']||!$dbconfig['dbname']))//检测安装
{
header('Content-type:text/html;charset=utf-8');
echo '你还没安装！<a href="install/">点此安装</a>';
exit();
}
//连接数据库
include_once(SYSTEM_ROOT."db.class.php");
$DB=new DB($dbconfig['host'],$dbconfig['user'],$dbconfig['pwd'],$dbconfig['dbname'],$dbconfig['port']);
if($DB->query("select * from iapp_config where 1")==FALSE)//检测安装2
{
header('Content-type:text/html;charset=utf-8');
echo '<div class="row">你还没安装！<a href="install/">点此安装</a></div>';
exit();

}


$siteid=1;
$conf=$DB->get_row("SELECT * FROM iapp_config WHERE id='$siteid' limit 1");
$password_hash='!@#%!s!0';
$admin_user = $conf["user"];
$admin_pasa = $conf["pwd"];
?>