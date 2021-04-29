<div class="col-md-7">
            
    <div class="content-box-large">
   <script type="text/javascript" src="libs/jquery.min.js"></script>
    <script type="text/javascript" src="libs/jquery.form.js"></script>
    <script type="text/javascript" src="libs/jquery.validate.min.js"></script>
    <link rel="stylesheet" type="text/css" href="libs/flexigrid/css/flexigrid.css">
    <script type="text/javascript" src="libs/jquery.cookie.js"></script>
    <script type="text/javascript" src="libs/flexigrid/js/flexigrid.js"></script>
  

    <?php 

        $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
                $limit = 20;
                $limit_start = ($page - 1) * $limit;

      $q=mysql_query("select * from tb_transaksi as t inner join tb_pinjam as p on t.pinjam_id = p.pinjam_id inner join tb_barang as b on p.barang_id = b.barang_id
       where user_id = '$_SESSION[id]' and persetujuan ='ya' or persetujuan='tidak' limit ".$limit_start.",".$limit);
     ?>
           <h3>Detail Peminjaman </h3>
           <div id="pesan"></div>
            <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="tbBarangqq">
                <thead>
                                  <tr>
                                  <td colspan="7">
                                    <input type="text" name="search" placeholder="Pencarian.." id="search" class="form-control" />  
                                  </td>
                 
                                </tr>
                   <tr>
                          <td><b>Nomor</b></td>
                          <td><b>Nama Barang</b></td>
                          <td><b>Jumlah Pinjam</b></td>
                          <td><b>Tanggal Ambil</b></td>
                          <td><b>Alasan</b></td>
                          <td><b>Persetujuan</b></td>
                         
                        </tr>
                </thead>
                
                      <tbody id="isipermintaan">
                  <?php 
                  $nomor = $limit_start + 1;
                  while($data=mysql_fetch_array($q)) {
           
                  ?>
                        <tr class="add_persetujuan<?php echo $id ?>">

                          <td><?php echo $nomor; ?></td>
                          <td><?php echo $data["nama_barang"]; ?></td>
                           <td><?php echo $data["jumlah_barang"]; ?></td>
                            <td><?php echo $data["tanggal_pengambilan"]; ?></td>
                             <td><?php echo $data["alasan"]; ?></td>
                           <?php  if($data['persetujuan']=="ya"){ ?>
                             <td class="alert-success">Barang bisa di ambil di gedung AF</td>
                        <?php }else if($data['persetujuan']=="tidak"){ ?>
                          <td class="alert-danger">Barang tidak bisa di pinjam</td>
                        <?php } ?>
                        </tr>
                      <?php 
                      $nomor++;
                  } ?>
                      
                      </tbody>
                    
                    </table>
            <div id='message'></div>

                     <ul class="pagination">
           
            <?php
            if ($page == 1) {
            ?>
                <li class="disabled"><a href="#">First</a></li>
                <li class="disabled"><a href="#">&laquo;</a></li>
            <?php
            } else { 
                $link_prev = ($page > 1) ? $page - 1 : 1;
            ?>
                <li><a href="./index/pinjam_details/?page=1">First</a></li>
                <li><a href="./index/pinjam_details/?page=<?php echo $link_prev; ?>">&laquo;</a></li>
            <?php
            }
            ?>

            
            <?php
            
            $sql2 = mysql_query("SELECT COUNT(*) AS jumlah FROM tb_kategori");
            $get_jumlah = mysql_fetch_array($sql2);

            $jumlah_page = ceil($get_jumlah['jumlah'] / $limit); 
            $jumlah_number = 3;
            $start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1; 
            $end_number = ($page < ($jumlah_page - $jumlah_number)) ? $page + $jumlah_number : $jumlah_page; 

            for ($i = $start_number; $i <= $end_number; $i++) {
                $link_active = ($page == $i) ? 'class="active"' : '';
            ?>
                <li <?php echo $link_active; ?>><a href="./index/barang/?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php
            }
            ?>

            
            <?php

            if ($page == $jumlah_page) { 
            ?>
                <li class="disabled"><a href="#">&raquo;</a></li>
                <li class="disabled"><a href="#">Last</a></li>
            <?php
            } else { 
                $link_next = ($page < $jumlah_page) ? $page + 1 : $jumlah_page;
            ?>
                <li><a href="./index/barang/?page=<?php echo $link_next; ?>">&raquo;</a></li>
                <li><a href="./index/barang/?page=<?php echo $jumlah_page; ?>">Last</a></li>
            <?php
            }
            ?>
        </ul>
                    

            <br /><br />
          </div>
       
            <br /><br />
          </div>