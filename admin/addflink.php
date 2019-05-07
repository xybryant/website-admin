<?php 
	require_once('../functions.php');
  $current_user = balls_get_current_user();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
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
        <h1>新增链接</h1>
        <a href="/admin/flinklist.php" class="btn btn-primary btn-xs">链接列表</a>
      </div>
      <div class="row">
        <form action="./api/flink_add.php" method="post" class="col-sm-10">
          <div class="form-group">
            <label for="site">网站名</label>
            <input type="text" class="form-control" name="site" id="site" placeholder="网站名" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="url">网址</label>
            <input type="text" class="form-control" name="url" id="url" placeholder="网址" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="description">描述</label>
            <textarea class="form-control" rows="8" name="description" id="description"></textarea>
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
