<?php 

  //require_once(BX_ROOT_DIR.'/functions.php');
  $current_page = explode('.', end(explode('/',$_SERVER['PHP_SELF'])))[0];
  require_once('../functions.php');
  $current_user = balls_get_current_user();
?>

<div class="aside">

  <div class="profile">
    <img class="avatar" src="<?php echo 'http://balls.love'.$current_user['avatar'] ; ?>">
    <h3 class="name"><?php echo $current_user['nickname'] ; ?></h3>
  </div>
  <ul class="nav">
    <li<?php echo $current_page==='index'?' class="active"':'' ; ?>>
      <a href="/admin"><i class="fa fa-dashboard"></i>后台首页</a>
    </li>

    <?php $menu_pages=array('pagelist','addpage') ; ?>

    <li<?php echo in_array($current_page,$menu_pages)?' class="active"':'' ; ?>>
      <a href="#menu-pages"<?php echo in_array($current_page,$menu_pages)?'':' class="collapsed"' ; ?> data-toggle="collapse">
        <i class="fa fa-thumb-tack"></i>单页管理<i class="fa fa-angle-right"></i>
      </a>
      <ul id="menu-pages" class="collapse<?php echo in_array($current_page,$menu_pages)?' in':'' ; ?>">
        <li<?php echo $current_page==='pagelist'?' class="active"':'' ; ?>><a href="pagelist.php">单页列表</a></li>
        <li<?php echo $current_page==='addpage'?' class="active"':'' ; ?>><a href="addpage.php">新增单页</a></li>
      </ul>
    </li>

    <?php $menu_news=array('newslist','publishnews', 'addnewscategory','newsort') ; ?>

    <li<?php echo in_array($current_page,$menu_news)?' class="active"':'' ; ?>>
      <a href="#menu-news"<?php echo in_array($current_page,$menu_news)?'':' class="collapsed"' ; ?> data-toggle="collapse">
        <i class="fa fa-thumb-tack"></i>新闻管理<i class="fa fa-angle-right"></i>
      </a>
      <ul id="menu-news" class="collapse<?php echo in_array($current_page,$menu_news)?' in':'' ; ?>">
        <li<?php echo $current_page==='newslist'?' class="active"':'' ; ?>><a href="newslist.php">新闻列表</a></li>
        <li<?php echo $current_page==='publishnews'?' class="active"':'' ; ?>><a href="publishnews.php">发布新闻</a></li>
        <li<?php echo $current_page==='addnewscategory'?' class="active"':'' ; ?>><a href="addnewscategory.php">新增分类</a></li>
        <li<?php echo $current_page==='newsort'?' class="active"':'' ; ?>><a href="newsort.php">新闻分类</a></li>
      </ul>
    </li>
  
    <?php $menu_product=array('productlist','productsort', 'addproduct') ; ?>

    <li<?php echo in_array($current_page,$menu_product)?' class="active"':'' ; ?>>
       <a href="#menu-products"<?php echo in_array($current_page,$menu_product)?'':' class="collapsed"' ; ?> data-toggle="collapse">
        <i class="fa fa-thumb-tack"></i>产品管理<i class="fa fa-angle-right"></i>
      </a>
      <ul id="menu-products" class="collapse<?php echo in_array($current_page,$menu_product)?' in':'' ; ?>">
        <li<?php echo $current_page==='productlist'?' class="active"':'' ; ?>><a href="productlist.php">产品列表</a></li>
        <li<?php echo $current_page==='addproduct'?' class="active"':'' ; ?>><a href="addproduct.php">新增产品</a></li>
        <li<?php echo $current_page==='productsort'?' class="active"':'' ; ?>><a href="productsort.php">产品分类</a></li>
      </ul>
    </li>

    <?php $menu_message=array('messagelist') ; ?>

    <li<?php echo in_array($current_page, $menu_message)?' class="active"':'' ; ?>>
      <a href="#menu-message"<?php echo in_array($current_page,$menu_message)?'':' class="collapsed"' ; ?> data-toggle="collapse">
        <i class="fa fa-cogs"></i>留言管理<i class="fa fa-angle-right"></i>
      </a>
      <ul id="menu-message" class="collapse<?php echo in_array($current_page,$menu_message)?' in':'' ; ?>">
        <li<?php echo $current_page==='messagelist'?' class="active"':'' ; ?>><a href="messagelist.php">留言列表</a></li>
      </ul>
    </li>

    <?php $menu_flinks=array('flinklist', 'addflink') ; ?>

    <li<?php echo in_array($current_page, $menu_flinks)?' class="active"':'' ; ?>>
      <a href="#menu-links"<?php echo in_array($current_page,$menu_flinks)?'':' class="collapsed"' ; ?> data-toggle="collapse">
        <i class="fa fa-cogs"></i>友情链接<i class="fa fa-angle-right"></i>
      </a>
      <ul id="menu-links" class="collapse<?php echo in_array($current_page,$menu_flinks)?' in':'' ; ?>">
        <li<?php echo $current_page==='flinklist'?' class="active"':'' ; ?>><a href="flinklist.php">链接列表</a></li>
        <li<?php echo $current_page==='addflink'?' class="active"':'' ; ?>><a href="addflink.php">新增链接</a></li>
      </ul>
    </li>

    <?php $menu_admin=array('adminlist', 'addadmin') ; ?>

    <li<?php echo in_array($current_page, $menu_admin)?' class="active"':'' ; ?>>
      <a href="#menu-admin"<?php echo in_array($current_page,$menu_admin)?'':' class="collapsed"' ; ?> data-toggle="collapse">
        <i class="fa fa-cogs"></i>管理员<i class="fa fa-angle-right"></i>
      </a>
      <ul id="menu-admin" class="collapse<?php echo in_array($current_page,$menu_admin)?' in':'' ; ?>">
        <li<?php echo $current_page==='adminlist'?' class="active"':'' ; ?>><a href="adminlist.php">管理员列表</a></li>
        <li<?php echo $current_page==='addadmin'?' class="active"':'' ; ?>><a href="addadmin.php">新增管理员</a></li>
      </ul>
    </li>
  </ul>
</div>
