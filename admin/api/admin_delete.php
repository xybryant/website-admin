<?php 

	require_once '../../functions.php';
	$id = $_GET['id'];
	if(!is_numeric($id)){
		echo '<script>alert("参数id不是合法数值");location.href="/admin/pagelist.php"</script>';
	}
	$avatar_domain_path = balls_fetch_one("select avatar from `admin` where id={$id} limit 1");
	if(!$avatar_domain_path){
		die('<script>location.href="/admin/adminlist.php"</script>');
	}
	//echo $avatar_domain_path['avatar'];
	$avatar_save_path = '../..'.$avatar_domain_path['avatar'];
	// echo $avatar_save_path;
	// echo '<br>';
	// if(file_exists($avatar_save_path)){
	// 	echo 'yes';
	// }else{
	// 	echo 'no';
	// }
	// exit;
	
	$affected_rows = balls_execute("delete from `admin` where id={$id} limit 1");
	if($affected_rows){
		if(file_exists($avatar_save_path)){
			unlink($avatar_save_path);
		}
		echo '<script>alert("删除成功");location.href="/admin/adminlist.php"</script>';
	}else{
		echo '<script>alert("删除失败");location.href="/admin/adminlist.php"</script>';
	}

?>