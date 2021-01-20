<!--/* Copyright (C) 2020 ShuttleOne - All Rights Reserved */-->
<?

$fileid = $_REQUEST['fileid'];
$temp = $_REQUEST['temp'];

include '../include/database.php';
$db = new Database();  
$db->connect();

if ($temp == '1') {
	$sql = "delete from tbl_upload_temp where id='$fileid'";
	if ($db->sql($sql))
		echo 1;
	else echo 0;
}

?>