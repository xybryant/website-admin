<?php 
	require_once '../../functions.php';
	$id = $_POST['id'];
	if(!is_numeric($id)){
		echo '<script>alert("参数id不是合法数值");location.href="/admin/newslist.php"</script>';
	}
	$module_name = $_POST['modulename'];
	$content = htmlspecialchars($_POST['content']);
	// $sql = "update `module` set `name`='{$module_name}',`content`='{$content}' where id={$id} limit 1";
	// var_dump($sql);
	// exit;
	//echo '<pre>';
	//print_r($content);
	//var_dump($content);
	//echo '</pre>';
	
	$affected_rows = balls_execute("update `module` set `name`='{$module_name}',`content`='{$content}' where id={$id} limit 1");
	if($affected_rows){
		echo '<script>alert("修改成功");location.href="/admin/pagelist.php"</script>';
		//echo '<script>alert("修改成功");location.href="/admin/editpage.php?id='.$id.'"</script>';

	}else{
		echo '<script>alert("修改失败");location.href="/admin/editpage.php?id='.$id.'"</script>';
	}
 ?>