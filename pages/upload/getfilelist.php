<!--/* Copyright (C) 2020 ShuttleOne - All Rights Reserved */-->
<?

$caseid = $_REQUEST['id'];
$tempid = $_REQUEST['tempid'];
$temp = $_REQUEST['temp'];

include '../include/database.php';
$db = new Database();  
$db->connect();

$sql = "select * from tbl_upload_temp where caseid='$caseid'";

if ($tempid != '') {
	$sql .= " or caseid='$tempid'";
}

$db->sql($sql);
$res = $db->getResult();

$param = array(
		"code" => 0,
		"data" => $res
		);
echo json_encode($param,true);
?>