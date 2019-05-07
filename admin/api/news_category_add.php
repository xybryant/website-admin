<?php 
	require_once '../../functions.php';
	$name = $_POST['name'];
	$slug = $_POST['slug'];
	//echo '<pre>';
	//print_r($content);
	//var_dump($content);
	//echo '</pre>';
	
	$affected_rows = balls_execute("insert into `category_news`(name,slug) values('{$name}','{$slug}')");
	if($affected_rows){
		echo '<script>alert("添加成功");location.href="/admin/newsort.php"</script>';
	}else{
		echo '<script>alert("添加失败");location.href="/admin/addnewscategory.php"</script>';
	}
 ?>