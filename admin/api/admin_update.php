<?php 
	require_once '../../functions.php';
	$id = $_POST['id'];
	if(!is_numeric($id)){
		echo '<script>alert("参数id不是合法数值");location.href="/admin/newslist.php"</script>';
	}
	$nickname = $_POST['nickname'];
	$password = $_POST['password'];
	$origin_avatar = $_POST['originavatar'];
	$origin_avatar_path = '../..'.$origin_avatar;//原保存路径
	$avatar = $_FILES['avatar'];
	if($avatar['error'] === 4){//没有修改图片，则用回原图片地址
		// $query = balls_fetch_one("select images from `news` where id={$id} limit 1");
		// if(!$query){
		// 	echo '<script>alert("没有对应数据！");location.href="/admin/newslist.php"</script>';
		// }
		//$images_domain_path = $query['images'];
		$avatar_domain_path = $origin_avatar;
	}else{
		$avatar_name = substr(mt_rand(), 0).uniqid().'.'.pathinfo($avatar['name'], PATHINFO_EXTENSION);
		$year = date('Y');
		$month = date('m');
		$day = date('d');
		$upload_dir = '../../static/uploads/avatar/'.$year.$month.$day;
		$avatar_save_path = $upload_dir.'/'.$avatar_name;
		$avatar_domain_path = substr($avatar_save_path, 5);
	}
	
	// $sql = "update `admin` set `nickname`='{$nickname}', password='{$password}', avatar='{$avatar_domain_path}' where id={$id} limit 1";
	// echo($sql);
	
	// echo '<pre>';
	// print_r($images_domain_path);
	// //var_dump($content);
	// echo '</pre>';
	//exit;
	$affected_rows = balls_execute("update `admin` set `nickname`='{$nickname}', password='{$password}', avatar='{$avatar_domain_path}' where id={$id} limit 1");
	if($affected_rows){
		if($avatar['error'] !== 4){
			if(!file_exists($upload_dir)){
				mkdir($upload_dir);
			}
			if(file_exists($origin_avatar_path)){
				unlink($origin_avatar_path);
			}
			move_uploaded_file($avatar['tmp_name'], $avatar_save_path);
		}
		echo '<script>alert("修改成功");location.href="/admin/adminlist.php"</script>';
		//echo '<script>alert("修改成功");location.href="/admin/editpage.php?id='.$id.'"</script>';

	}else{
		echo '<script>alert("未作任何修改！");location.href="/admin/editadmin.php?id='.$id.'"</script>';
	}
 ?>