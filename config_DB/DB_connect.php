<?php 
	$host ="127.0.0.1";
	$user ="root";
	$pass="";
	$DB = "sports_equipment";
	$connect= mysqli_connect($host,$user,$pass,$DB) or die("connect false");
	mysqli_set_charset($connect,"utf8");

?>