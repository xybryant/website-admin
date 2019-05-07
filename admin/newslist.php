<?php 
  require_once('../functions.php');
  $current_user = balls_get_current_user();
  //$query = balls_fetch_all('select * from `news` where id>8');
  
  //$page = $_GET['page'] ? $_GET['page'] : 1;
  //$str = '';
  //var_dump(isset($str));
  //var_dump($page);
  //var_dump('');
  //exit;
  $news_sort = balls_fetch_all('select * from category_news');
  $sort_arr = array('all');
  foreach ($news_sort as $key => $value) {
    $sort_arr[] = $value['slug'];
  }
  $sort = $_GET['sort'] ? $_GET['sort'] : 'all';
  if(!in_array($sort, $sort_arr)){
    die('<script>location.href = "/admin/newslist.php"</script>');
  }

  //$page = $_GET['page'] ? $_GET['page'] : 1;
  $page = $_GET['page'] ?? 1;//php7
  if(!is_numeric($page)){
    die('<script>location.href = "/admin/newslist.php"</script>');
    //echo '<script>location.href = "/admin/newslist.php"</script>';
  }

  $where = '1 = 1';
  $search = '';
  if($sort !== 'all'){
    $where .= " and c.slug='{$_GET['sort']}'";
    $search .= 'sort='.$_GET['sort'].'&';
  }

  $total_page = balls_get_total("select count(*) from `news` n inner join category_news c on n.category_id=c.id where {$where}");
  // echo '<pre>';
  // print_r($total_page);
  // echo '</pre>';
  
  // exit;
  $page_size = 7;
  $max_page = ceil($total_page / $page_size);
  if($page > $max_page && $max_page > 0){
    $page = $max_page;
    echo '<script>location.href = "/admin/newslist.php?'.$search.'page='.$page.'"</script>';
  }
  if($page < 1){
    $page = 1;
    echo '<script>location.href = "/admin/newslist.php?page='.$search.'page='.$page.'"</script>';
  }
  
  $offset = ($page -1) * $page_size;
  //$offset = $page  * $page_size;
  

  
  


  $query = balls_fetch_all("select n.*,c.name sort from `news` n inner join category_news c on n.category_id = c.id where {$where} order by n.id desc limit {$offset}, {$page_size}");
  //$query = balls_fetch_one('select count(*) as total from `news`');
  //echo strrchr('kobe.jpg', '.');
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
  <link rel="stylesheet" href="/static/assets/vendors/jquery/pagination.css">
  <script src="/static/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
    <?php include 'inc/navbar.php' ; ?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>新闻列表</h1>
        <a href="/admin/publishnews.php" class="btn btn-primary btn-xs">发布新闻</a>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="sort">
            <span>类别：</span>
            <ul>
              <li<?php echo $sort==='all'?' class="active"':'' ?>><a href="/admin/newslist.php?sort=all">全部</a></li>
              <?php
                foreach ($news_sort as $key => $value) {
                  if($sort===$value['slug']){
                    echo "<li class='active'><a href='/admin/newslist.php?sort={$value['slug']}'>{$value['name']}</a></li>";
                  }else{
                    echo "<li><a href='/admin/newslist.php?sort={$value['slug']}'>{$value['name']}</a></li>";
                  }
                  
                }
              ?>
            </ul>
          </div>
          <table class="table table-striped table-bordered table-hover text-center">
            <thead>
               <tr>
                <th class="text-center" width="45">序号</th>
                <th class="text-center" width="45">ID</th>
                <th class="text-center">分类</th>
                <th class="text-center">标题</th>
                <th class="text-center">作者</th>
                <th class="text-center">缩略图</th>
                <th class="text-center">内容</th>
                <th class="text-center">发布时间</th>
                <th class="text-center">点击率</th>
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
                    echo "<td>{$value['sort']}</td>";
                    echo "<td>{$value['title']}</td>";
                    echo "<td>{$value['author']}</td>";
                    echo "<td><img width='50' height='50' src='{$value['images']}'></td>";
                    echo '<td>'.mb_substr(strip_tags(htmlspecialchars_decode($value['content'])), 0, 10,'utf-8').'...</td>';
                    //strip_tags去除所有html标签date('Y年m月d日<b\r>H:i:s',strtotime($created))
                    echo '<td>'.date('Y年m月d日<b\r>H:i:s',strtotime($value['create_time'])).'</td>';
                    echo "<td>{$value['hits']}</td>";
                    echo "<td>
                            <a href='./editnews.php?id={$value['id']}' class='btn btn-success btn-sm'>修改</a>
                            <a href='./api/news_delete.php?id={$value['id']}' class='btn btn-danger btn-sm del'>删除</a>
                          </td>";

                    echo '</tr>';
                  }
                }else{
                  echo '<tr><td colspan="10">没有更多数据！</td></tr>';
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="ht-page"></div>
    </div>
  </div>

  <?php include 'inc/asidebar.php' ; ?>
  <script src="/static/assets/vendors/jquery/jquery.js"></script>
  <script src="/static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="/static/assets/vendors/jquery/pagination.js"></script>
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
  <script type="text/javascript">
    var totalPage = <?php echo $total_page ?>;
    var pageSize = <?php echo $page_size ?>;
    var page = <?php echo $page ?>;
    <?php 
      if(!$search){
        echo 'var search = "";';
      }else{
        echo 'var search = "'.$search.'";';
      }
    ?>

    /**
     * [pageChange description]
     * @param  {[type]} i [description]
     * @return {[type]}   [description]
     */
    function pageChange(i) {
            //alert("index is :" + i);
            //location.href = '/admin/newslist.php?'+search+'page='+(i+1);
            location.href = '/admin/newslist.php?'+search+'page='+(i+1);
            Pagination.Page($(".ht-page"), i, totalPage, pageSize);
            //Pagination.Page($(".ht-page"), i, 10000, 10);
    }

    
    if(totalPage>0){
      Pagination.init($(".ht-page"), pageChange);
      Pagination.Page($(".ht-page"), page-1, totalPage, pageSize);
    }
    //Pagination.Page($(".ht-page"), 3, 10000, 10);
  </script>
</body>
</html>
