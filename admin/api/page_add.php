<?php 
	require_once '../../functions.php';
	$module_name = $_POST['modulename'];
	$content = htmlspecialchars($_POST['content']);
	//echo '<pre>';
	//print_r($content);
	//var_dump($content);
	//echo '</pre>';
	
	$affected_rows = balls_execute("insert into `module`(name,content) values('{$module_name}','{$content}')");
	if($affected_rows){
		echo '<script>alert("添加成功");location.href="/admin/pagelist.php"</script>';
	}else{
		echo '<script>alert("添加失败");location.href="/admin/addpage.php"</script>';
	}
 ?>