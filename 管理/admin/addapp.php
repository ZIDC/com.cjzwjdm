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
if(isset($_POST['build'])){

$build =daddslashes($_POST['build']);
$appname = $build.".";

$filename=$_FILES['file']['name'];
if(preg_match("/php|jsp|html|css|js|asp|png|jpeg|jpg|gif|GIF|PHP|ASP|HTML|CSS|JS|sql|SQL|PNG/is",$filename)){
exit(showmsg("禁止上传该文件类型！"));
}

$glob = glob("../app/*");
for($i=0;$i<count($glob);$i++){
$preg = '/'.$conf['appbuild'].'/is';
if(preg_match($preg,$glob[$i])){
$file =  $glob[$i];
}
else{
continue;//跳出循环
}
}
if($file){
showmsg("系统已经存在识别号为[".$build."]的软件应用了");exit;
}

$ext=substr($filename,strripos($filename,'.')+1);
if(copy($_FILES['file']['tmp_name'],'../app/'.$appname.$ext)){
exit(showmsg("软件上传成功,识别号[".$build."]",1));
}
else{
exit(showmsg("软件上传失败,请检测权限！"));
}


} ?>
      <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">上传软件</h3></div>
        <div class="panel-body">
          <form action="./addapp.php" method="post" class="form-horizontal" role="form" enctype="multipart/form-data"> 
            <div class="input-group">
              <span class="input-group-addon">软件文件</span>
<input type="file" name="file" id="file" class="form-control"/>
            </div><br/>

            <div class="input-group">
              <span class="input-group-addon">软件识别号</span>
              <input type="text" name="build" class="form-control"  placeholder="1000" autocomplete="off" required/>
           

            </div><br/>
            <div class="form-group">
              <div class="col-sm-12"><input type="submit" value="添加" class="btn btn-primary form-control"/></div>
            </div>
          </form>
      </div>
    </div>
  </div>