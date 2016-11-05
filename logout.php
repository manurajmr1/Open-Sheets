<?php
include_once("config.php");
//$msg=$_GET['msg'];
//if(array_key_exists('logout',$_GET))
//{
	unset($_SESSION['token']);
	unset($_SESSION['google_data']); //Google session data unset
	$gClient->revokeToken();
	session_destroy();
	header("location:login.php");
//}
?>