<?php 
  require_once('../functions.php');
  $current_user = balls_get_current_user();
  $query = balls_fetch_all('select * from category_news');
  // echo '<pre>';
  // print_r($query);
  // echo '</pre>';
  // exit;
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
        <h1>发布新闻</h1>
        <a href="/admin/pagelist.php" class="btn btn-primary btn-xs">新闻列表</a>
      </div>
      <div class="row">
        <form action="./api/news_publish.php" method="post" enctype="multipart/form-data" class="col-sm-6">
          <div class="form-group">
            <label for="title">标题</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="标题" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="author">作者</label>
            <input type="text" class="form-control" name="author" id="author" placeholder="作者" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="category">分类</label>
            <select name="category" id="category" class="form-control">
              <option value="0">请选择分类</option>
              <?php 
                if($query){
                  foreach ($query as $key => $value) {
                    echo "<option value='{$value['id']}'>{$value['name']}</option>";
                  }
                }else{

                }
              ?>
              <!-- <option value="1">体育</option>
              <option value="2">生活</option>
              <option value="3">感情</option> -->
            </select>
          </div>
          <div class="upload-img">
            <span>上传头图</span>
            <label>
              <input type="file" name="images" accept="image/*" class="imginput" multiple="multipart">
              <img src="/static/assets/img/upload.jpg" class="img">
            </label>
          </div>
          <div class="form-group">
            <label for="content">内容</label>
            <textarea class="form-control" name="content" id="content"></textarea>
          </div>
          <button class="btn btn-primary" type="submit">发布</button>
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
