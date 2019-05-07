<?php 
	require_once('../functions.php');
  $current_user = balls_get_current_user();
  $query = balls_fetch_all('select * from `module`');
  // echo '<pre>';
  // print_r($query);
  // echo '</pre>';
  // exit;
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
        <h1>单页列表</h1>
        <a href="/admin/addpage.php" class="btn btn-primary btn-xs">新增单页</a>
      </div>
      <div class="row">
        <div class="col-md-10">
          <table class="table table-striped table-bordered table-hover text-center">
            <thead>
               <tr>
                <th class="text-center" width="50">序号</th>
                <th class="text-center" width="60">ID</th>
                <th class="text-center">标题</th>
                <th class="text-center">内容</th>
                <th class="text-center" width="150">操作</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                if($query){
                  foreach ($query as $key => $value) {
                    echo '<tr>';
                    echo "<td>".($key+1)."</td>";
                    echo "<td>{$value['id']}</td>";
                    echo "<td>{$value['name']}</td>";
                    echo '<td>'.mb_substr(strip_tags(htmlspecialchars_decode($value['content'])), 0, 10,'utf-8').'...</td>';
                    //去除所有html标签
                    echo "<td>
                            <a href='./editpage.php?id={$value['id']}' class='btn btn-success btn-sm'>修改</a>
                            <a href='./api/page_delete.php?id={$value['id']}' class='btn btn-danger btn-sm del'>删除</a>
                          </td>";

                    echo '</tr>';
                  }
                }else{
                  echo '<tr><td colspan="5">没有更多数据！</td></tr>';
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
      
    </div>
  </div>

  <?php include 'inc/asidebar.php' ; ?>

  <script src="/static/assets/vendors/jquery/jquery.js"></script>
  <script src="/static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script type="text/javascript">
    var del = $('.del');
    del.on('click',function(){
      var res = confirm('确定要删除该单页吗？');
      if(!res){
        return false;
      }
    });
  </script>
</body>
</html>
