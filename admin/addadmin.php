<?php 
	require_once('../functions.php');
  $current_user = balls_get_current_user();
  // echo '<pre>';
  // print_r($current_user);
  // echo '</pre>';
  if($current_user['flag'] !=1 ){
    echo '<script>alert("没有权限添加管理员！");location.href="/admin"</script>';
  }
  //exit;
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Dashboard &laquo; Admin</title>
  <link rel="stylesheet" href="/static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/static/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/static/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/static/assets/css/admin.css">
  <script src="/static/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
    <?php include 'inc/navbar.php' ; ?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>新增管理员</h1>
        <a href="/admin/adminlist.php" class="btn btn-primary btn-xs">管理员列表</a>
      </div>
      <div class="row">
        <form action="./api/admin_add.php" method="post" enctype="multipart/form-data" class="col-sm-8">
          <div class="form-group">
            <label for="nickname">名称</label>
            <input type="text" class="form-control" name="nickname" id="nickname" placeholder="名称" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="password">密码</label>
            <input type="password" class="form-control" name="password" id="password">
          </div>
          <div class="upload-img">
            <span>上传头图</span>
            <label>
              <input type="file" name="avatar" accept="image/*" class="imginput" multiple="multipart">
              <img src="/static/assets/img/upload.jpg" class="img">
            </label>
          </div>
          <button class="btn btn-primary" type="submit">添加</button>
        </form>
      </div>
    </div>
  </div>

  <?php include 'inc/asidebar.php' ; ?>

  <script src="/static/assets/vendors/jquery/jquery.js"></script>
  <script src="/static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script type="text/javascript">
    var input = document.querySelector('.imginput');
    input.addEventListener('change',function(e){
      //console.log(e);
      var reader = new FileReader();
      var file = input.files[0];
      if(!file) return ;
      if(file.type.indexOf('image/')!==0){
        alert('请上传图片文件');
        return ;
      }
      // console.log(file.type);
      reader.readAsDataURL(file);
      reader.onload = function(){
        document.querySelector('.img').src = reader.result ;
      }
    },false);
  </script>
</body>
</html>
