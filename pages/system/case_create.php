<!--/* Copyright (C) 2020 ShuttleOne - All Rights Reserved */-->
<?

include '../include/function.php';
include '../include/authen.php';
include '../include/database.php';
$db = new Database();  
$db->connect();


$userid = $_SESSION['id'];
$casetype = $_REQUEST['casetype'];
$buysell = $_REQUEST['buysell'];
$title = $_REQUEST['title'];
$tradeno = $_REQUEST['tradeno'];
$transportunit = $_REQUEST['transportunit'];
$comment = $_REQUEST['comment'];
$clientname = $_REQUEST['clientname'];
$tempid = $_REQUEST['tempid'];


//----- ARRAY OF TANKS -----//
$tankno = $_REQUEST['tankno'];
$productname = $_REQUEST['productname'];
$mt = $_REQUEST['mt'];
$bbl = $_REQUEST['bbl'];

//----- ARRAY OF FILE
$file_id = $_REQUEST['fileid'];
$file_remark = $_REQUEST['file_remark'];

$refno = gererateRefNo();

$param = array(
			"refno" => $refno,
			"userid" => $userid,
			"casetype" => $casetype,
			"buysell" => $buysell,
			"title" => $title,
			"tradeno" => $tradeno,
			"transportunit" => $transportunit,
			"clientname" => $clientname,
			"comment" => $comment,
			"status" => 1,
			// "tankno" => $tankno
		);

if ($db->insert("tbl_case", $param))
{
	$resArr = $db->getResult();
	$caseid = $resArr[0];

	//------ INSERT TANK
	for ($i=0;$i<count($tankno); $i++) {
		if ($tankno[$i] != '') {

			$param = array(
					"caseid" => $caseid,
					"tankno" => $tankno[$i],
					"productname" => $productname[$i],
					"mt" => $mt[$i],
					"bbl" => $bbl[$i],
					"torder" => ($i+1)
				);
			// var_dump($param);

			$db->insert("tbl_tank", $param);
		}else {
			// echo 'tank 1 zero';
		}
	}

	//------ UPDATE UPLOAD FILE
	$sql = "update tbl_upload_temp set caseid='$caseid' where caseid='$tempid'";
	$db->sql($sql);

	//------ UPDATE FILE
	for ($i=0;$i<count($file_remark);$i++) {
		$sql = "update tbl_upload_temp set remark='" . $file_remark[$i] . "' where id=" . $file_id[$i];
		// echo $sql;
		$db->sql($sql);
	}
	
}
header("Location:dashboard.php");
?>