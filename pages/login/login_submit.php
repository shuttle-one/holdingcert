<!--/* Copyright (C) 2020 ShuttleOne - All Rights Reserved */-->
<?
session_start();

include '../include/database.php';
$db = new Database();  
$db->connect();

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

$next_url = "../system/dashboard.php";


$sql = "select * from tbl_account where username='$username'";
$db->sql($sql);
$res = $db->getResult();

if (count($res)>0) {
	$p = $res[0]['password'];
	$role = $res[0]['role'];
	$id = $res[0]['id'];
	if ($p == $password) { //====== CORRECT LOGIN
		$_SESSION['username'] = $username;
		$_SESSION['role'] = $role;
		$_SESSION['id'] = $id;
	}else {
		//====== INCORRECT PASSWORD
		$next_url = "../login/login.php?e=2";
	}
	
} else {
	//======= NOT FOUND USER
	$next_url = "../login/login.php?e=1";
}

header("Location:$next_url");
?>