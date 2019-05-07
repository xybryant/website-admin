<?php 
	 require_once('../functions.php');
   $current_user = balls_get_current_user();
   $query = balls_fetch_all('select * from `admin`');
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
        <h1>管理员列表</h1>
        <a href="/admin/addadmin.php" class="btn btn-primary btn-xs">新增管理员</a>
      </div>
       <div class="row">
        <div class="col-md-10">
          <table class="table table-striped table-bordered table-hover text-center">
            <thead>
               <tr>
                <th class="text-center" width="50">序号</th>
                <th class="text-center" width="60">ID</th>
                <th class="text-center">名称</th>
                <th class="text-center">头像</th>
                <th class="text-center">级别</th>
                <th class="text-center" width="150">操作</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $flag_arr = array('1' => '超级管理员', '0' => '管理员');
                if($query){
                  foreach ($query as $key => $value) {
                    echo '<tr>';
                    echo "<td>".($key+1)."</td>";
                    echo "<td>{$value['id']}</td>";
                    echo "<td>{$value['nickname']}</td>";
                    echo "<td class='avatar'><img width='50' height='50' src='{$value['avatar']}'></td>";
                    echo '<td>'.$flag_arr[$value['flag']].'</td>';
                    /*if($value['flag']==1){
                      echo '<td>超级管理员</td>';
                    }elseif($value['flag']==0){
                      echo '<td>管理员</td>';
                    }*/
                   /* echo "<td>{$value['flag']}</td>";*/
                    echo "<td>
                            <a href='./editadmin.php?id={$value['id']}' class='btn btn-success btn-sm'>修改</a>
                            <a href='./api/admin_delete.php?id={$value['id']}' class='btn btn-danger btn-sm del'>删除</a>
                          </td>";

                    echo '</tr>';
                  }
                }else{
                  echo '<tr><td colspan="6">没有更多数据！</td></tr>';
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
    var del = $(".del");
    del.on('click', function(){
      var res = confirm('确定要删除这条新闻吗？');
      if(!res){
        return false;
      }
    });
  </script>
</body>
</html>
