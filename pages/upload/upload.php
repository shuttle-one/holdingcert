<!--/* Copyright (C) 2020 ShuttleOne - All Rights Reserved */-->
<?php

include '../include/authen.php';
include '../include/database.php';
$db = new Database();
$db->connect();
/* Getting file name */
$filename = $_FILES['file']['name'];
$tempid = $_REQUEST['tempid'];
$uploadby = $_SESSION['username'];

$milliseconds = round(microtime(true) * 1000);

/* Location */
$filename = $milliseconds ."_". $filename;
$location = __DIR__. "/../upload_file/".$filename;
// $location = __DIR__. "/../upload_file/test.gff";

// $location = "upload_file/".$filename;
// $location = $_SERVER['DOCUMENT_ROOT'] . '/../upload_file/'.$filename;
$uploadOk = 1;

if($uploadOk == 0){
	echo 0;
}else{

	/* Upload file */
	if(move_uploaded_file($_FILES['file']['tmp_name'], $location)){

		$param = array(
				"caseid" => $tempid,
				"title" => $filename,
				"uploadby" => $uploadby
				);

		if ($db->insert("tbl_upload_temp", $param)) {
			$newRes = $db->getResult();
			$newid = $newRes[0];
			$sql = "select * from tbl_upload_temp where id=$newid";
			$db->sql($sql);
			$res = $db->getResult();
			$param = array(
					"code" => 0,
					"data" => $res
					);
			echo json_encode($param,true);

		}

		// $sql = "insert into tbl_upload_temp(caseid,title,uploadby) value('$tempid','$filename','$uploadby')";
		// $db->sql($sql);

	}else{
		$param = array(
					"code" => 1,
					"data" => "Fail upload file, please try again."
					);
		echo json_encode($param,true);
	}
}
?>