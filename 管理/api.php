<?php
//版权所有:wlkjyy 
//QQ:1478686138
header("Content-Type:Appliction/Json;charset=utf-8");
include './includes/common.php';
function ret($msg=0,$status=0){
if($status){
exit('{"code":1,"msg":"'.$msg.'"}');
}
exit('{"code":-1,"msg":"'.$msg.'"}');
}

$act = $_GET["act"];
if(empty($act)){
ret("No Act！");
}


if($act=="reg"){
$user = $_GET["user"];
$pass = $_GET["pass"];
$money = $_GET["money"];
$date = date("Y-m-d H:i:s");
if(empty($user)){
ret("用户名不能为空");
}
if(empty($pass)){
ret("密码不能为空");
}
if(empty($money)){
$money = $conf["money"];//数据库中查询
}
if(is_numeric($money)==false){
$money = '0';//设置金币为0
}
$user = htmlspecialchars($user);
$pass = htmlspecialchars($pass);
//转义参数，防止xss
if($DB->get_row("SELECT * FROM `user_list` WHERE `user` ='{$user}' limit 1")){
ret("当前用户已经存在");
}
if($DB->query("insert into `user_list` (`user`,`pass`,`money`,`date`) values ('{$user}','{$pass}','{$money}','{$date}')")){
ret("注册成功！",true);
}
else{
ret("注册失败！");
}
}
if($act=="km"){//卡密使用
$km = htmlspecialchars($_GET["km"]);
$user = htmlspecialchars($_GET["user"]);
if(empty($km)){
ret("卡密不能为空");
}
if(empty($user)){
ret("用户名不能为空");
}
if($DB->get_row("SELECT * FROM `user_list` WHERE `user` ='{$user}' limit 1")==false){
ret("当前用户不存在");
}

$res=$DB->get_row("SELECT * FROM km_list WHERE km='".$km."'");
if($res)
{
if($res["status"]==0)
{
$money = $res['money'];//卡密值
$deduct="update km_list set status=1 where km='{$km}'";
if($DB->query($deduct)==false){
ret("卡密使用失败");
}

$deduct="update user_list set money = money+{$money}  where user = '{$user}'";
if($DB->query($deduct)){
ret('卡密充值成功，面额:'.$money."元",1);
}
else{
ret("卡密使用失败.");
}
}else
{
ret("卡密已被使用");
}
}
else
{
ret("卡密不存在");
}
}
if($act=="info"){
$param = [
"name" => $conf["appname"],//软件名称
"version" => $conf["appversion"],//软件版本
"build" => $conf["appbuild"],//软件识别号
];
$json = json_encode($param,JSON_UNESCAPED_UNICODE);
exit($json);
}
if($act=="update"){
$version = $_GET["version"];
if(empty($version)){
ret("软件版本号不能为空");
}
if($version==$conf["appversion"]){
ret("你当前使用的已是最新版，无需更新",1);
}
$glob = glob("./app/*");
for($i=0;$i<count($glob);$i++){
$preg = '/'.$conf['appbuild'].'/is';
if(preg_match($preg,$glob[$i])){
$file =  $glob[$i];
}
else{
continue;//跳出循环
}
}
if(empty($file)){
ret("未找到对应的版本对应文件");
}
$file = preg_replace("/.\/app\//","",$file);
$url = "http://".$_SERVER["HTTP_HOST"]."/app/".$file;//找到文件
$param = [
"code" => 1,
"msg" => "发现新版本",
"update" => $conf["appmsg"],
"version" => $conf["appversion"],//软件版本
"build" => $conf["appbuild"],//软件识别号
"url" => $url,
];
$json = json_encode($param,JSON_UNESCAPED_UNICODE);
exit($json);
}
if($act=="notice"){
$rs=$DB->get_row("SELECT  *  FROM iapp_notice WHERE 1 order by id asc"); 
while($res = $DB->fetch($rs)) { 
$resd[] = [
'date' => $res['date'],
"center" => $res['center'],
];
} 
$param = [
"code" => 1,
"data" => $resd,
];
$json = json_encode($param,JSON_UNESCAPED_UNICODE);
exit($json);
}
if($act=="login"){
$user = $_GET["user"];
$pass = $_GET["pass"];
if(empty($user)){
ret("账号不能为空");
}
if(empty($pass)){
ret("密码不能为空");
}
$user = htmlspecialchars($user);
$pass = htmlspecialchars($pass);

$row = $DB->get_row("SELECT * FROM `user_list` WHERE `user` ='{$user}' limit 1");
if(!$row){
ret("账号或密码错误！");
}
$password = $row["pass"];
if($password!=$pass){
ret("账号或密码错误！");
}
ret("登陆成功！",1);
}
if($act=="money"){
$user = $_GET["user"];
if(empty($user)){
ret("账号不能为空");
}
$user = htmlspecialchars($user);
$row = $DB->get_row("SELECT * FROM `user_list` WHERE `user` ='{$user}' limit 1");
if(!$row){
ret("不存在该用户");
}
$money = $row["money"];
ret($money,1);
}
if($act=="qd"){
if($conf["qd"]!=1){
ret("签到功能已关闭！");
}
$user = $_GET["user"];
if(empty($user)){
ret("账号不能为空");
}
$user = htmlspecialchars($user);

$row = $DB->get_row("SELECT * FROM `user_list` WHERE `user` ='{$user}' limit 1");
if(!$row){
ret("用户不存在");
}//找到用户
$ip = real_ip();
$date = date("Y-m-d H:i:s");
$time = date("Y-m-d");

$row = $DB->get_row("SELECT * FROM `qd_list` WHERE `user` ='{$user}' and  `time` ='{$time}' limit 1");
if($row){
ret("你今日已经签到过了，无需再次签到");
} 
if($conf["qdip"]==1){//验证ip
$row = $DB->get_row("SELECT * FROM `qd_list` WHERE `ip` ='{$ip}' and  `time` ='{$time}' limit 1");
if($row){
ret("该设备已在其他账号上签到过了，请勿再次签到");
}
}
$money = $conf["qdjb"];
$deduct="update user_list set money = money+{$money}  where user = '{$user}'";
if($DB->query($deduct)){
if($DB->query("insert into `qd_list` (`user`,`date`,`money`,`time`,`ip`) values ('{$user}','{$date}','{$money}','{$time}','{$ip}')")){
if($money=="0"){
ret("签到成功！",true);
}
else{
ret("签到成功，获得奖励：".$money."个金币",true);
}

}
else{
ret("签到失败！");
}
}
else{
ret("签到失败");
}
}
if($act=="pass"){
$user = $_GET["user"];
$pass = $_GET["pass"];
$new = $_GET["new"];
if(empty($user)){
ret("账号不能为空");
}
if(empty($pass)){
ret("旧密码不能为空");
} 
if(empty($new)){
ret("新密码不能为空");
}
$user = htmlspecialchars($user);
$pass = htmlspecialchars($pass);
$new = htmlspecialchars($new);
$row = $DB->get_row("SELECT * FROM `user_list` WHERE `user` ='{$user}' limit 1");
if(!$row){
ret("用户不存在");
}//找到用户
$passs = $row["pass"];
if($pass!=$passs){
ret("旧密码不正确");
}
if($pass==$new){
ret("新密码与旧密码相同！");
}
$deduct="update user_list set pass='{$new}'  where user = '{$user}'";
if($DB->query($deduct)){
ret("密码修改成功",true);
}
else{
ret("密码修改失败");
}
}
if($act=="fk"){
if($conf["feed"]!=1){
ret("反馈功能已关闭！");
}
$user = $_GET["user"];
$msg = $_GET["msg"];
$date = date("Y-m-d H:i:s");
if(empty($user)){
ret("用户名不能为空");
}
if(empty($msg)){
ret("反馈信息不能为空");
}
$user = htmlspecialchars($user);
$msg = htmlspecialchars($msg);
//转义参数，防止xss
if($DB->get_row("SELECT * FROM `user_list` WHERE `user` ='{$user}' limit 1")==false){
ret("用户不存在");
}
$size = $conf["feedsize"];
$size = explode("-",$size);
$x = $size[0];
$d = $size[1];
if(is_numeric($x)==false){//非标准字符串
$x = "10";
}
if(is_numeric($d)==false){//非标准字符串
$d = "200";
}

$strlen = strlen($msg);
if($strlen > $d){
ret("反馈信息不能超过".$d."个字符");
} 
if($strlen < $x){
ret("反馈信息不能小于".$x."个字符");
}
$errno = str_replace(",","|",$conf["feedkeyword"]);
$errno = str_replace("/","\/",$errno);
$preg = "/".$errno."/is";
if(preg_match($preg,$msg)){
ret("反馈信息不合法：包含敏感信息");
}
if($conf["feedsame"]==1){
$row = $DB->get_row("SELECT * FROM `feed_list` WHERE `user` ='{$user}' and  `data` ='{$msg}' and  `return` ='' limit 1");
if($row){
ret("请不要多次提交");
}

}
if($DB->query("insert into `feed_list` (`user`,`data`,`date`,`return`) values ('{$user}','{$msg}','{$date}','')")){
ret("反馈成功！",true);
}
else{
ret("反馈失败！");
}

}
if($act=="fklist"){
if($conf["feed"]!=1){
ret("反馈功能已关闭！");
}
$user = $_GET["user"];
if(empty($user)){
ret("用户名不能为空");
}
$user = htmlspecialchars($user);
//转义参数，防止xss
if($DB->get_row("SELECT * FROM `user_list` WHERE `user` ='{$user}' limit 1")==false){
ret("用户不存在");
}

$rs=$DB->query("SELECT * FROM `feed_list` WHERE user='{$user}'");
function tr($str=0){
if($str){
return '已回复';
}
else{
return '待回复';

}
}
while($res = $DB->fetch($rs))
{
$resd[] = [
"date" => $res["date"],
"data" => $res["data"],
"status" => tr($res['return']),
"return" => $res['return'],
];

}
$res = [
"code" => 1,
"data" => $resd,
];
exit(json_encode($res,JSON_UNESCAPED_UNICODE));
}


ret("No Act！");

?>