<?php 
include 'config.php';
$output = '';
$transid = $_POST['id'];
  mysql_query("update tb_transaksi set persetujuan = 'tidak' where transaksi_id='$transid'") or die(mysql_error());
  echo "Peminjaman Di Batalkan";