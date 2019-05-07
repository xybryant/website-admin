<?php 
	require_once '../../functions.php';
	$id = $_POST['id'];
	if(!is_numeric($id)){
		echo '<script>alert("参数id不是合法数值");location.href="/admin/flinklist.php"</script>';
	}
	
	$site = $_POST['site'];
	$url = $_POST['url'];
	$description = htmlspecialchars($_POST['description']);
	// $sql = "update `module` set `name`='{$module_name}',`content`='{$content}' where id={$id} limit 1";
	// var_dump($sql);
	// exit;
	//echo '<pre>';
	//print_r($content);
	//var_dump($content);
	//echo '</pre>';
	
	$affected_rows = balls_execute("update `flink` set `site`='{$site}',`url`='{$url}',description='{$description}' where id={$id} limit 1");
	if($affected_rows){
		echo '<script>alert("修改成功");location.href="/admin/flinklist.php"</script>';
		//echo '<script>alert("修改成功");location.href="/admin/editpage.php?id='.$id.'"</script>';

	}else{
		echo '<script>alert("没有修改任何数据！");location.href="/admin/editflink.php?id='.$id.'"</script>';
	}
 ?>