<?php 
include '../functions.php';
//$current_user = balls_get_current_user();
//$query = balls_fetch_one("select * from admin where id = 8");
//var_dump($query);
// echo '<pre>';
// print_r($query);
// echo '</pre>';
//session_start();
function login(){
  global $error_message;
  if(empty($_POST['nickname'])){
    $error_message = '请输入管理员昵称';
    return;
  }
  if(empty($_POST['password'])){
    $error_message = '请输入密码';
    return;
  }
  $nickname = $_POST['nickname'];
  $password = $_POST['password'];

  $query = balls_fetch_one("select * from `admin` where nickname='{$nickname}' and password='{$password}'");

  //var_dump($query);
  if(!$query){
    $error_message = '用户名或密码有误！';
    return;
  }
  
  //$_SESSION['is_logged_in'] = true ;
  $_SESSION['current_login_user'] = $query ;//记录登录的用户名
  $_SESSION['expiretime'] = time()+1800 ;//设置登录过期时间

  header('Location:/admin/');
  exit;
}

if($_SERVER['REQUEST_METHOD']==='POST'){
  login();
}

if($_SERVER['REQUEST_METHOD']==='GET'){
  if(isset($_GET['action'])&&$_GET['action']==='logout'){
    unset($_SESSION['current_login_user']);
    unset($_SESSION['expiretime']);
  }elseif (isset($_SESSION['current_login_user']) && $_SESSION['expiretime'] >= time()) {
    $_SESSION['expiretime'] = time() + 1800;
    header('Location:/admin');
    exit;
  }
  
  //header('Location:/admin/');
}

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Sign in &laquo; Admin</title>
  <link rel="stylesheet" href="/static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/static/assets/vendors/animate/animate.min.css">
  <link rel="stylesheet" href="/static/assets/css/admin.css">
</head>
<body>
  <div class="login">
    <form class="login-wrap<?php echo isset($error_message)?' shake animated':'' ; ?>" action="<?php echo $_SERVER['PHP_SELF'] ; ?>" method="post" autocomplete="off" novalidate>
      <div class="avatar-box">
        <img class="avatar" src="/static/assets/img/default.png">
      </div>
      <?php if (isset($error_message)): ?>
        <!-- 有错误信息时展示 -->
        <div class="alert alert-danger">
          <strong>错误！</strong> <?php echo $error_message ; ?>
        </div>
      <?php endif ?>
      
      <div class="form-group">
        <label for="nickname" class="sr-only">管理员</label>
        <input id="nickname" type="text" name="nickname"<?php echo !empty($_POST['nickname'])?" value='{$_POST['nickname']}'":'' ?> class="form-control" placeholder="管理员" autofocus>
      </div>
      <div class="form-group">
        <label for="password" class="sr-only">密码</label>
        <input id="password" type="password" name="password" class="form-control" placeholder="密码">
      </div>
      <button class="btn btn-primary btn-block">登 录</button>
    </form>
  </div>
  <script src="/static/assets/vendors/jquery/jquery.js"></script>
  <script type="text/javascript">

    $(function($){
      var emailFormat = /^[\w.-]+[@][\w.-]+([.][a-zA-Z]+){1,2}$/ ;
      function bb(){
        //console.log(999);
        //var value = $(this).val();
        var value =  $('#email').val();
        //var email = '' ;
        if(!value || !emailFormat.test(value)) return;
       //$('#email').on('change',function(){
        // if(email===value){
        //   return ;
        // }
        $.get('/admin/api/avatar.php',{avatar:value},function(data){
          //if(!data || $('.avatar').attr('src')===data['avatar'] ) return ;
          if(!data){//$('.avatar').attr('src')===data['avatar']
            $('.avatar').attr('src','/static/assets/img/default.png');
            return;
          } ;
          //email = data['email'];
          if($('.avatar').attr('src')===data['avatar']) return;
          //console.log(data);
          $('.avatar').fadeOut(50,function(){
            $(this).on('load',function(){
              $(this).fadeIn(500);
            }).attr('src',data['avatar']);
          });
        }); 
      }
      bb();
      //

      //$('#email').on('blur',bb);
      $('#email').on('change',bb);
      
      
    });
  </script>
</body>
</html>
