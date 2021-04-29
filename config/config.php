<?php

$server = "localhost";
$usernames = "root";
$passwords = "";
$database = "db_inventaris";

$dbs = mysqli_connect($server, $usernames, $passwords, $database);

if(mysqli_connect_errno()){
	echo 'Koneksi gagal, ada masalah pada : '.mysqli_connect_errno();
	exit();
	mysqli_close($dbs);
}

?>