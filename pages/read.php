<?php 

include 'config.php';
 
$emailAddress = false;
if(isset($_POST['name'])){
	$id = $_POST['id'];
    $nama = $_POST['name'];
    $kategori = $_POST['kategori_id'];
    $jumlah = $_POST['jumlah'];
    $satuan = $_POST['satuan'];
    $cara = $_POST['cara'];
    $deskripsi = $_POST['deskripsi'];

  mysql_query("update tb_barang set nama_barang = '$nama',kategori_id='$kategori',jumlah='$jumlah',satuan='$satuan',cara_perolehan='$cara',deskripsi='$deskripsi' where barang_id='$id'") or die(mysql_error());
}
 
echo 'Data Berhasil Di Update ';

?>