<?php 
	require_once '../../functions.php';
	$id = $_POST['id'];
	if(!is_numeric($id)){
		echo '<script>alert("参数id不是合法数值");location.href="/admin/newslist.php"</script>';
	}
	$origin_img = $_POST['originimg'];
	$title = $_POST['title'];
	$author = $_POST['author'];
	$category_id = $_POST['category'];
	$content = htmlspecialchars($_POST['content']);
	$images = $_FILES['images'];
	if($images['error'] === 4){//没有修改图片，则用回原图片地址
		// $query = balls_fetch_one("select images from `news` where id={$id} limit 1");
		// if(!$query){
		// 	echo '<script>alert("没有对应数据！");location.href="/admin/newslist.php"</script>';
		// }
		//$images_domain_path = $query['images'];
		$images_domain_path = $origin_img;
	}else{
		$images_name = substr(mt_rand(), 0).uniqid().'.'.pathinfo($images['name'], PATHINFO_EXTENSION);
		$year = date('Y');
		$month = date('m');
		$day = date('d');
		$upload_dir = '../../static/uploads/news/'.$year.$month.$day;
		$images_save_path = $upload_dir.'/'.$images_name;
		$images_domain_path = substr($images_save_path, 5);
	}
	
	// $sql = "update `news` set `title`='{$title}', category_id={$category_id}, author='{$author}', `content`='{$content}', images='{$images_domain_path}' where id={$id} limit 1";
	// echo($sql);
	
	// echo '<pre>';
	// print_r($images_domain_path);
	// //var_dump($content);
	// echo '</pre>';
	//exit;
	$affected_rows = balls_execute("update `news` set `title`='{$title}', category_id={$category_id}, author='{$author}', `content`='{$content}', images='{$images_domain_path}' where id={$id} limit 1");
	if($affected_rows){
		if($images['error'] !== 4){
			if(!file_exists($upload_dir)){
				mkdir($upload_dir);
			}
			move_uploaded_file($images['tmp_name'], $images_save_path);
		}
		echo '<script>alert("修改成功");location.href="/admin/newslist.php"</script>';
		//echo '<script>alert("修改成功");location.href="/admin/editpage.php?id='.$id.'"</script>';

	}else{
		echo '<script>alert("未作任何修改！");location.href="/admin/editnews.php?id='.$id.'"</script>';
	}
 ?>