<?php
session_start();
require_once('config.php');
/**
 * 获取当前用户信息
 * @return [type] [description]
 */
function balls_get_current_user(){
	if(empty($_SESSION['current_login_user']) || $_SESSION['expiretime'] < time()){
		//$_SESSION['current_login_user'] = null;
		unset($_SESSION['expiretime']);
    header('Location:/admin/login.php');
    exit;
  }
  $_SESSION['expiretime'] = time() + 1800;
  return $_SESSION['current_login_user'];
}
function balls_pdo($sql){
	try{
		$pdo = new PDO('mysql:host='.BALLS_DB_HOST.';dbname='.BALLS_DB_NAME, BALLS_DB_USER, BALLS_DB_PASS, array(
		PDO::ATTR_PERSISTENT => true));
		//var_dump($pdo);
		$pdo->exec('set names utf8');
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		$smt = $pdo->prepare($sql);
		//return $smt;
		if(!$smt->execute()){//只要语法没错都会执行成功返回true
			die('sql语法有误！');//语法有误或字段名不存在 返回false不打印  注：字段的值不加引号也会返回false
		}
		return $smt;
	} catch (PDOException $e) {
	    //print "Error!: " . $e->getMessage() . "<br/>";
	    die('连接数据库失败！');
	}
}
/**
 * 查询数据库获取多条数据,拿到的是一个索引数组套关联数组
 * @param  [type] $sql [description]
 * @return [type]      [description]
 */
function balls_fetch_all($sql){
	//try {
	    // $pdo = new PDO('mysql:host='.BALLS_DB_HOST.';dbname='.BALLS_DB_NAME, BALLS_DB_USER, BALLS_DB_PASS, array(
	    // PDO::ATTR_PERSISTENT => true));
	    // //var_dump($pdo);
	    // $pdo->exec('set names utf8');
	    // $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	    // $smt = $pdo->prepare($sql);
	    //$smt = balls_pdo($sql);
	    // if(!$smt->execute()){//只要语法没错都会执行成功返回true
	    // 	die('sql语法有误！');//语法有误或字段名不存在 返回false不打印
	    // }
	    $smt = balls_pdo($sql);
	    $affected_rows = $smt->rowCount();//所以要用rowCount获取受影响行数
	    if(!$affected_rows){
	    	 return null ;
	    	//die('用户不存在！');
	    }
	    $data = $smt->fetchAll();
	    //$data = $smt->fetchAll(PDO::FETCH_NUM);
	    // echo '<pre>';
	    // print_r($data);
	    // echo '</pre>';
	    // $pdo = null;
	    return $data ;
	//}catch (PDOException $e) {
	    //print "Error!: " . $e->getMessage() . "<br/>";
	   // die('连接数据库失败！');
	//}
}

/**
 * 获取单条数据，拿到的是一个条关联数组
 * @param  [type] $sql [description]
 * @return [type]      [description]
 */
function balls_fetch_one($sql){
	$data = balls_fetch_all($sql);
	return isset($data[0]) ? $data[0] : null ;//$data可能是一个空数组或false，所以要判断是否存在
}

/**
 * 操作数据库－增删改
 * @param  [type] $sql [description]
 * @return [type]      [description]
 */
function balls_execute($sql){
	$smt = balls_pdo($sql);
	$affected_rows = $smt->rowCount();
	return $affected_rows;//为0时说明没做修改或要删除的数据不存在或
}

function balls_get_total($sql){
	$smt = balls_pdo($sql);
	$total = $smt->fetch(PDO::FETCH_NUM);
	return $total[0];
}
?>