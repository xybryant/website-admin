<?php 
	require_once '../../functions.php';
	// $str = 'kobe455.jpg';
	// echo strrchr($str, '.');//.jpg
	// //返回最后出现.的位置开始到最后部分
	// echo '<br>';
	// echo pathinfo($str, PATHINFO_EXTENSION);//jpg
	// echo '<br>';
	$nickname = $_POST['nickname'];
	$password = $_POST['password'];
	$avatar = $_FILES['avatar'];
	$avatar_name = substr(mt_rand(), 0).uniqid().'.'.pathinfo($avatar['name'], PATHINFO_EXTENSION);
	
	$year = date('Y');
	$month = date('m');
	$day = date('d');
	$upload_dir = '../../static/uploads/avatar/'.$year.$month.$day;
	$avatar_save_path = $upload_dir.'/'.$avatar_name;
	$avatar_domain_path = substr($avatar_save_path, 5);
	// echo $avatar_save_path;
	// echo '<br>';
	// echo $avatar_domain_path;
	// echo '<pre>';
	// print_r($avatar);
	// //var_dump($content);
	// echo '</pre>';
	// $sql = "insert into `admin`(nickname, password, avatar) values('{$nickname}', {$password}, '{$avatar_domain_path}')";
	// echo $sql;
	// exit;
 	$affected_rows = balls_execute("insert into `admin`(nickname, password, avatar) values('{$nickname}', {$password}, '{$avatar_domain_path}')");
	if($affected_rows){
		if(!file_exists($upload_dir)){
			mkdir($upload_dir);
		}
		move_uploaded_file($avatar['tmp_name'], $avatar_save_path);
		echo '<script>alert("添加成功");location.href="/admin/adminlist.php"</script>';
	}else{
		echo '<script>alert("添加失败");"</script>';
		//echo '<script>alert("添加失败");location.href="/admin/addpage.php"</script>';
	}
?>