<?php 
	require_once '../../functions.php';
	$title = $_POST['title'];
	$author = $_POST['author'];
	$category_id = $_POST['category'];
	$content = htmlspecialchars($_POST['content']);
	$images = $_FILES['images'];
	$images_name = substr(mt_rand(), 0).uniqid().'.'.pathinfo($images['name'], PATHINFO_EXTENSION);
	
	$year = date('Y');
	$month = date('m');
	$day = date('d');
	$upload_dir = '../../static/uploads/news/'.$year.$month.$day;
	$images_save_path = $upload_dir.'/'.$images_name;
	$images_domain_path = substr($images_save_path, 5);
	// echo $images_save_path;
	// echo '<br>';
	// echo $images_domain_path;
	// echo '<pre>';
	// print_r($images);
	// //var_dump($content);
	// echo '</pre>';
	// $sql = "insert into `news`(title, category_id, author, content, images) values('{$title}', {$category_id}, '{$author}', '{$content}', '{$images_domain_path}')";
	// echo $sql;
	// exit;
 $affected_rows = balls_execute("insert into `news`(title, category_id, author, content, images) values('{$title}', {$category_id}, '{$author}', '{$content}', '{$images_domain_path}')");
if($affected_rows){
	if(!file_exists($upload_dir)){
		mkdir($upload_dir);
	}
	move_uploaded_file($images['tmp_name'], $images_save_path);
	echo '<script>alert("添加成功");location.href="/admin/newslist.php"</script>';
}else{
	echo '<script>alert("添加失败");"</script>';
	//echo '<script>alert("添加失败");location.href="/admin/addpage.php"</script>';
}
 ?>