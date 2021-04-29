<?php 
$host = "localhost";
$username = "root";
$password = "";
$dbname = "db_inventaris";

$koneksi = mysqli_connect("localhost","root","","db_inventaris");
$conn = mysqli_connect($host, $username, $password, $dbname);
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
 
?>