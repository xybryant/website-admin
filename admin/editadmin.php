<?php 
  require_once('../functions.php');
  $current_user = balls_get_current_user();
  $id = $_GET['id'];
  if(!is_numeric($id)){
    echo '<script>alert("参数id不是合法数值");location.href="/admin/adminlist.php"</script>';
  }
  $query = balls_fetch_one("select * from `admin` where id={$id} limit 1");
  if(!$query){
    echo '<script>alert("没有数据！");location.href="/admin/adminlist.php"</script>';
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
        <h1>修改管理员</h1>
        <a href="/admin/adminlist.php" class="btn btn-primary btn-xs">管理员列表</a>
      </div>
      <div class="row">
        <form action="./api/admin_update.php" method="post" enctype="multipart/form-data" class="col-sm-6">
          <input type="hidden" name="id" value="<?php echo $query['id'] ?>">
          <input type="hidden" name="originavatar" value="<?php echo $query['avatar'] ?>">
          <div class="form-group">
            <label for="nickname">名称</label>
            <input type="text" class="form-control" value="<?php echo $query['nickname'] ?>" name="nickname" id="nickname" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="password">密码 - <span style="color:red">不改则无需操作</span></label>
            <input type="password" class="form-control" name="password" id="password" value="<?php echo $query['password'] ?>">
          </div>
          <div class="upload-img">
            <span>上传头图</span>
            <label>
              <input type="file" name="avatar" accept="image/*" class="imginput">
              <img src="<?php echo $query['avatar'] ?>" class="img">
            </label>
          </div>
          <button class="btn btn-primary" type="submit">提交</button>
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
