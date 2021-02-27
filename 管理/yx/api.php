<?php
/* 漫夜邮箱接口v1.5版本
    QQ:85367802
    加群免费发布更新程序:635689680 
    更新发布网站：https://www.manye.net
    */
header("content-type:text/html;charset=utf-8");

$mail=$_GET[shouxin];
$cneno=$_GET[neirong];
$zhuti=$_GET[zhuti];

if($mail==null||$cneno==null){

echo '内容和收件人是必须填写的！！！！！';

}else{


require_once ('email.manye.php');
$smtpserver = "smtp.qq.com"; //SMTP服务器
$smtpserverport = 587; //SMTP服务器端口
$smtpusermail = "cjzwj@foxmail.com"; //SMTP服务器的用户邮箱
$smtpemailto = $mail; //发送给谁
$smtpuser = "cjzwj@foxmail.com"; //SMTP服务器的用户帐号
$smtppass = "zkgqcxbhrzpxdedh"; //SMTP服务器的用户密码
$mailsubject = $zhuti; //邮件主题
$mailbody = $cneno; //邮件内容
$mailtype = "HTML"; //邮件格式（HTML/TXT）,TXT为文本邮件

$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
$smtp->debug = false;//是否显示发送的调试信息
$av=$smtp->sendmail($smtpemailto,$smtpusermail, $mailsubject,$mailbody,$mailtype);

if($av!="1"){

echo '邮件发送失败，请检查发信服务器、端口、邮箱与密码是否正确！';

}else{

echo '发信成功！！！';

}

}



?>