<!--/* Copyright (C) 2020 ShuttleOne - All Rights Reserved */-->
<?
include '../include/function.php';
include '../include/authen.php';
include '../include/database.php';
$db = new Database();  
$db->connect();

$id = $_REQUEST['id'];
$cmd = $_REQUEST['cmd'];

$buy = 0;

$sql = "select * from tbl_case where id=$id";
$db->sql($sql);
$res = $db->getResult();
if (count($res) > 0) {
	if ($res[0]['buysell'] == 'buy')
		$buy = 1;
}

$status = -1;

if ($cmd=='submit') 
{
	$status = 1;
} else if ($cmd=='approve')
{
	$status = 2;
}
else if ($cmd=='ack')
{
	$status = 3;
	if ($buy==1)
		$status = 4;
	
}else if ($cmd == 'default')
{
	$status = 0;
}else if ($cmd == 'complete')
{
	$status = 4;
}

if ($status != -1){
	$sql = "update tbl_case set status=$status where id=$id";
	$db->sql($sql);
}

header("Location:dashboard.php");

?>