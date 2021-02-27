<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title><?=$title?></title>
  <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
  <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <!--[if lt IE 9]>
    <script src="http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script>
    <script src="http://libs.useso.com/js/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>

  <nav class="navbar navbar-fixed-top navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">导航按钮</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="./">白洁动漫管理控制系统</a>
      </div><!-- /.navbar-header -->
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">

          <li><a href="./"><span class="glyphicon glyphicon-home"></span>控制台首页</a></li>

		  <li class="">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>用户管理<b class="caret"></b></a>
            <ul class="dropdown-menu">
<li><a href="./user.php">添加用户</a></li>  
  <li><a href="./userlist.php">用户列表</a></li>
            </ul>
          </li>

		  <li class="">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-barcode"></span>卡密管理<b class="caret"></b></a>
            <ul class="dropdown-menu">
<li><a href="./km.php">添加卡密</a></li>  
  <li><a href="./kmlist.php">卡密列表</a></li>
            </ul>
          </li>

		  <li class="">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-gift"></span>签到管理<b class="caret"></b></a>
            <ul class="dropdown-menu">
<li><a href="./qdinfo.php">签到配置</a></li> 
  <li><a href="./qdlist.php">签到记录</a></li>
            </ul>
          </li>
		  <li class="">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-envelope"></span>用户反馈<b class="caret"></b></a>
            <ul class="dropdown-menu">
<li><a href="./feedinfo.php">反馈设置</a></li>  
  <li><a href="./feedlist.php">反馈列表</a></li>
            </ul>
          </li>

		  <li class="">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-tasks"></span>软件管理<b class="caret"></b></a>
            <ul class="dropdown-menu">
<li><a href="./appinfo.php">软件信息</a></li>  
  <li><a href="./addapp.php">上传软件</a></li>
  <li><a href="./applist.php">软件列表</a></li>
            </ul>
          </li>

          <li><a href="./notice.php"><span class="glyphicon glyphicon-list-alt"></span>发布公告</a></li>
<li><a href="./set.php"><span class="glyphicon glyphicon-cog"></span>网站信息配置</a></li>

<?php 
if(is_file("../includes/doc.zip")){
         echo ' <li><a href="../includes/doc.zip"><span class="glyphicon glyphicon-download-alt"></span>下载API文档</a></li>';
}
else{
echo ' <li><a href="http://down.ficwlkj.cn/doc.zip"><span class="glyphicon glyphicon-download-alt"></span>下载API文档</a></li>';

}
?>

          <li><a href="./login.php?logout"><span class="glyphicon glyphicon-log-out"></span> 退出登陆</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
  </nav><!-- /.navbar -->
