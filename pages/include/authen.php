<!--/* Copyright (C) 2020 ShuttleOne - All Rights Reserved */-->

<?
session_start();
if ($_SESSION['username'] == ''){
	session_destroy();
	header("Location:../login/login.php?e=f");
}

?>