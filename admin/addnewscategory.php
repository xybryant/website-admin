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
        <h1>新增分类</h1>
        <a href="/admin/newslist.php" class="btn btn-primary btn-xs">新闻列表</a>
      </div>
      <div class="row">
        <form action="./api/news_category_add.php" method="post" enctype="multipart/form-data" class="col-sm-8">
          <div class="form-group">
            <label for="name">分类名</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="分类名" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="slug">昵称</label>
            <input type="text" class="form-control" name="slug" id="slug" placeholder="填写拼音" autocomplete="off">
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
</body>
</html>
