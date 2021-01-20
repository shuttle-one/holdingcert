<!--/* Copyright (C) 2020 ShuttleOne - All Rights Reserved */-->
<?
include '../include/function.php';
include '../include/authen.php';
include '../include/database.php';
$db = new Database();  
$db->connect();

$role = $_SESSION['role'];
$userid = $_SESSION['id'];
$caseid = $_REQUEST['id'];
$casetype = $_REQUEST['casetype'];
$buysell = $_REQUEST['buysell'];
$title = $_REQUEST['title'];
$tradeno = $_REQUEST['tradeno'];
$transportunit = $_REQUEST['transportunit'];
$comment = $_REQUEST['comment'];
$clientname = $_REQUEST['clientname'];

$tempid = $_REQUEST['tempid'];

$status = $_REQUEST['status'];
//----- ARRAY OF TANKS -----//
$tankno = $_REQUEST['tankno'];
$productname = $_REQUEST['productname'];
$mt = $_REQUEST['mt'];
$bbl = $_REQUEST['bbl'];

//----- ARRAY OF FILE
$file_id = $_REQUEST['fileid'];
$file_remark = $_REQUEST['file_remark'];

//----- NEXT PROCESS
$process = $_REQUEST['process'];

$param = array(
			// "refno" => $refno,
			"userid" => $userid,
			"casetype" => $casetype,
			"buysell" => $buysell,
			"title" => $title,
			"tradeno" => $tradeno,
			"transportunit" => $transportunit,
			"clientname" => $clientname,
			// "comment" => $comment,
			// "tankno" => $tankno
		);

if ($comment != '' ) {
	$param['comment'] = $comment;
}
// var_dump($param);
// return;

//----- STILL NOT SUBMIT
if ($status==1) {
	// if ($buysell == 'sell') {
	if ($role==3) {
		

		if (count($tankno)>0) {
			//------ REMOVE OLD TANK
			$sql = "delete from tbl_tank where caseid=$caseid";
			$db->sql($sql);

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

					$db->insert("tbl_tank", $param);
				}
			}
		}
		
		//------ UPDATE FILE
		for ($i=0;$i<count($file_remark);$i++) {
			$sql = "update tbl_upload_temp set remark='" . $file_remark[$i] . "' where id=" . $file_id[$i];
			// echo $sql;
			$db->sql($sql);
		}

		//------ UPDATE UPLOAD FILE
		$sql = "update tbl_upload_temp set caseid='$caseid' where caseid='$tempid'";
		$db->sql($sql);

		if ($comment != '' ) {
			$sql = "update tbl_case set comment='$comment ' where id=$caseid";
			$db->sql($sql);
		}

	}else  {
		if ($db->update("tbl_case", $param, "id=$caseid")) {
			// echo 'ee';
			//------ REMOVE OLD TANK
			$sql = "delete from tbl_tank where caseid=$caseid";
			$db->sql($sql);

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

					$db->insert("tbl_tank", $param);
				}
			}

			//------ UPDATE FILE
			for ($i=0;$i<count($file_remark);$i++) {
				$sql = "update tbl_upload_temp set remark='" . $file_remark[$i] . "' where id=" . $file_id[$i];
				// echo $sql;
				$db->sql($sql);
			}

			//------ UPDATE UPLOAD FILE
			$sql = "update tbl_upload_temp set caseid='$caseid' where caseid='$tempid'";
			$db->sql($sql);
			
		}
	}
} else //if ($status==2) 
{ //----- ALREADY ACKNOWLEDGE

	if (count($tankno)>0) {
		//------ REMOVE OLD TANK
		$sql = "delete from tbl_tank where caseid=$caseid";
		$db->sql($sql);

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

				$db->insert("tbl_tank", $param);
			}
		}
	}

	//------ UPDATE FILE
	for ($i=0;$i<count($file_remark);$i++) {
		$sql = "update tbl_upload_temp set remark='" . $file_remark[$i] . "' where id=" . $file_id[$i];
		// echo $sql;
		$db->sql($sql);
	}

	//------ UPDATE UPLOAD FILE
	$sql = "update tbl_upload_temp set caseid='$caseid' where caseid='$tempid'";
	$db->sql($sql);

	if ($comment != '' ) {
		$sql = "update tbl_case set comment='$comment ' where id=$caseid";
		$db->sql($sql);
	}
}


$nextURL = "case_process.php?id=$caseid&cmd=" . $process;

header("Location:$nextURL");
?>