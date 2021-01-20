<!--/* Copyright (C) 2020 ShuttleOne - All Rights Reserved */-->
<?
session_start();
unset($_SESSION["username"]);
unset($_SESSION["role"]);
unset($_SESSION["id"]);
header("Location:login.php");
?>