<?php 
	require_once '../../functions.php';
	$site = $_POST['site'];
	$url = $_POST['url'];
	$description = htmlspecialchars($_POST['description']);
	//echo '<pre>';
	//print_r($content);
	//var_dump($content);
	//echo '</pre>';
	//exit;
	$affected_rows = balls_execute("insert into `flink`(site,url,description) values('{$site}','{$url}','{$description}')");
	if($affected_rows){
		echo '<script>alert("添加成功");location.href="/admin/flinklist.php"</script>';
	}else{
		echo '<script>alert("添加失败");location.href="/admin/addflink.php"</script>';
	}
 ?>