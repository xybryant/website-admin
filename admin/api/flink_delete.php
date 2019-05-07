<?php 

	require_once '../../functions.php';
	$id = $_GET['id'];
	if(!is_numeric($id)){
		echo '<script>alert("参数id不是合法数值");location.href="/admin/flinklist.php"</script>';
	}
	$affected_rows = balls_execute("delete from `flink` where id={$id} limit 1");
	if($affected_rows){
		echo '<script>alert("删除成功");location.href="/admin/flinklist.php"</script>';
	}else{
		echo '<script>alert("删除失败");location.href="/admin/flinklist.php"</script>';
	}

?>