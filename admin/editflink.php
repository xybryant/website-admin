<?php 
	require_once('../functions.php');
  $current_user = balls_get_current_user();
  $id = $_GET['id'];
  if(!is_numeric($id)){
    echo '<script>alert("参数id不是合法数值");location.href="/admin/flinklist.php"</script>';
  }
  //$sql = "select * from `module` where id={$id} limit 1";
  //echo  $sql;
  //exit;
  $query = balls_fetch_one("select * from `flink` where id={$id} limit 1");
  if(!$query){
    echo '<script>alert("没有数据！");location.href="/admin/flinklist.php"</script>';
  }

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
        <h1>编辑单页</h1>
        <a href="/admin/pagelist.php" class="btn btn-primary btn-xs">单页列表</a>
      </div>
      <div class="row">
        <form action="./api/flink_update.php" method="post" class="col-sm-10">
          <input type="hidden" name="id" value="<?php echo $query['id'] ?>">
          <div class="form-group">
            <label for="site">网站名</label>
            <input type="text" class="form-control" name="site" id="site" value="<?php echo $query['site'] ?>" placeholder="网站名" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="url">网址</label>
            <input type="text" class="form-control" name="url" id="url" value="<?php echo $query['url'] ?>" placeholder="网址" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="description">描述</label>
            <textarea class="form-control" rows="8" name="description" id="description"><?php echo $query['description'] ?></textarea>
          </div>
          <button class="btn btn-primary" type="submit">提交</button>
        </form>
      </div>
      
    </div>
  </div>
  
  <?php include 'inc/asidebar.php' ; ?>

  <script src="/static/assets/vendors/jquery/jquery.js"></script>
  <script src="/static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script charset="utf-8" src="/static/assets/vendors/kindeditor/kindeditor-all-min.js"></script>
  <script charset="utf-8" src="/static/assets/vendors/kindeditor/lang/zh-CN.js"></script>
  <script>NProgress.done()</script>
  <script type="text/javascript">
    KindEditor.ready(function(K) {
      var options = {
              //cssPath : '/static/assets/vendors/kindeditor/themes/simple/simple.css',
              filterMode : true,
              //allowImageUpload: true
              minHeight:350,
              resizeType:0,
              uploadJson : '/static/assets/vendors/kindeditor/php/upload_json.php',
              fileManagerJson : '/static/assets/vendors/kindeditor/php/file_manager_json.php',
              allowFileManager : true
      };
      var editor = K.create('#content', options);
    });
    
  </script>
</body>
</html>
