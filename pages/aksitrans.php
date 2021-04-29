<?php 
include 'config.php';
$output = '';
$transid = $_POST['id'];
  mysql_query("update tb_transaksi set persetujuan = 'ya' where transaksi_id='$transid'") or die(mysql_error());
  $row = mysql_fetch_array(mysql_query("select b.jumlah as jumlah,p.jumlah_barang as jumlah_barang,u.nama,p.barang_id as baru,b.nama_barang,p.jumlah_barang,p.tanggal_pengambilan,t.alasan,t.persetujuan
       from tb_transaksi as t inner join tb_user as u on t.user_id = u.user_id inner join tb_pinjam as p on t.pinjam_id = p.pinjam_id inner join tb_barang as b on p.barang_id = b.barang_id where transaksi_id='$transid'"));
   	$jml = $row['jumlah'] - $row['jumlah_barang'];
  mysql_query("update tb_barang set jumlah = '$jml' where barang_id = '$row[baru]'");
  echo "Peminjaman Di Setujui";