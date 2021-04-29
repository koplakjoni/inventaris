
<div class="col-md-7">
            
    <div class="content-box-large">
   <script type="text/javascript" src="libs/jquery.min.js"></script>
    <script type="text/javascript" src="libs/jquery.form.js"></script>
    <script type="text/javascript" src="libs/jquery.validate.min.js"></script>
    <link rel="stylesheet" type="text/css" href="libs/flexigrid/css/flexigrid.css">
    <script type="text/javascript" src="libs/jquery.cookie.js"></script>
    <script type="text/javascript" src="libs/flexigrid/js/flexigrid.js"></script>
   <script type="text/javascript">
    $(document).ready(function() {
        $('.ab').click(function() {
            var id = $(this).attr("id");
            if (confirm("Yakin ingin di setujui?")) {
                $.ajax({
                    type: "POST",
                    url: "pages/aksitrans.php",
                    data: ({
                        id: id
                    }),
                    cache: false,
                    success: function(html) {
                       $('#pesan').html("<h4>"+html+"</h4>");
                        $(".add_persetujuan" + id).fadeOut('slow');

                    $('.aa').load('pages/daftar_terima.php').fadeIn("slow");

                    }
                });
            } else {
                return false;
            }
        });
    });
</script>
 <script type="text/javascript">
    $(document).ready(function() {
        $('.ac').click(function() {
            var id = $(this).attr("id");
            if (confirm("Yakin ingin di Batalkan?")) {
                $.ajax({
                    type: "POST",
                    url: "pages/deltrans.php",
                    data: ({
                        id: id
                    }),
                    cache: false,
                    success: function(html) {
                     $('#pesan').html("<h4>"+html+"</h4>");
                        $(".add_persetujuan" + id).fadeOut('slow');
                    }
                });
            } else {
                return false;
            }
        });
    });
</script>
 <script type="text/javascript">
    $(document).ready(function() {
        $('.kembali').click(function() {
            var id = $(this).attr("id");
            if (confirm("Apakah Barang Siap Di Kembalikan?")) {
                $.ajax({
                    type: "POST",
                    url: "pages/kembalitrans.php",
                    data: ({
                        id: id
                    }),
                    cache: false,
                    success: function(html) {
                     $('#pesan1').html("<h4>"+html+"</h4>");
                        $(".add_sukses" + id).fadeOut('slow');
                    }
                });
            } else {
                return false;
            }
        });
    });
</script>
 <script>  
      $(document).ready(function(){  
           $('#search').keyup(function(){  
                search_table($(this).val());  
           });  
           function search_table(value){  
                $('#tbBarangqq tbody tr').each(function(){  
                     var found = 'false';  
                     $(this).each(function(){  
                          if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0)  
                          {  
                               found = 'true';  
                          }  
                     });  
                     if(found == 'true')  
                     {  
                          $(this).show();  
                     }  
                     else  
                     {  
                          $(this).hide();  
                     }  
                });  
           }  
      });  
 </script>    

    <?php 

        $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
                $limit = 20;
                $limit_start = ($page - 1) * $limit;

      $q=mysql_query("select * from tb_transaksi as t inner join tb_user as u on t.user_id = u.user_id inner join tb_pinjam as p on t.pinjam_id = p.pinjam_id inner join tb_barang as b on p.barang_id = b.barang_id
       where t.persetujuan = 'belum' limit ".$limit_start.",".$limit);
     ?>
           <h3>List Permintaan Barang </h3>
           <div id="pesan"></div>
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="tbBarangqq">
                <thead>
                                  <tr>
                                  <td colspan="7">
                                    <input type="text" name="search" placeholder="Pencarian.." id="search" class="form-control" />  
                                  </td>
                 
                                </tr>
                   <tr>
                          <td><b>Nomor</b></td>
                          <td><b>Nama User</b></td>
                          <td><b>Nama Barang</b></td>
                          <td><b>Jumlah Pinjam</b></td>
                          <td><b>Tanggal Ambil</b></td>
                          <td><b>Alasan</b></td>
                          <td><b>Aksi</b></td>
                        </tr>
                </thead>
                
                      <tbody id="isipermintaan">
                  <?php 
                  $nomor = $limit_start + 1;
                  while($data=mysql_fetch_array($q)) {
                    $id = $data["transaksi_id"]; 
                  ?>
                        <tr class="add_persetujuan<?php echo $id ?>">

                          <td><?php echo $nomor; ?></td>
                          <td><?php echo $data["nama"]; ?></td>
                          <td><?php echo $data["nama_barang"]; ?></td>
                           <td><?php echo $data["jumlah_barang"]; ?></td>
                            <td><?php echo $data["tanggal_pengambilan"]; ?></td>
                             <td><?php echo $data["alasan"]; ?></td>
                          <td>
                            <form id="aksitrans" method="GET" >
                             <a id="<?php  echo $data['transaksi_id']; ?>" class="ab btn btn-success btn-block"><i class="glyphicon glyphicon-ok"></i> Setuju</a>
                            <a id="<?php  echo $data['transaksi_id']; ?>" class="ac btn btn-danger text-success btn-block"><i class="glyphicon glyphicon-remove"></i> Batalkan</a>
                            </form>
                           
                            </td>
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
                <li><a href="./index/barang/?page=1">First</a></li>
                <li><a href="./index/barang/?page=<?php echo $link_prev; ?>">&laquo;</a></li>
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
        <div class="aa content-box-large">
           <script>  
      $(document).ready(function(){  
           $('#search').keyup(function(){  
                search_table($(this).val());  
           });  
           function search_table(value){  
                $('#tbBarang tbody tr').each(function(){  
                     var found = 'false';  
                     $(this).each(function(){  
                          if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0)  
                          {  
                               found = 'true';  
                          }  
                     });  
                     if(found == 'true')  
                     {  
                          $(this).show();  
                     }  
                     else  
                     {  
                          $(this).hide();  
                     }  
                });  
           }  
      });  
 </script>  

  

    <?php 

        $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
                $limit = 20;
                $limit_start = ($page - 1) * $limit;

      $q=mysql_query("select t.transaksi_id,t.pinjam_id,u.nama,b.nama_barang,p.jumlah_barang,p.tanggal_pengambilan,t.alasan,t.persetujuan
       from tb_transaksi as t inner join tb_user as u on t.user_id = u.user_id inner join tb_pinjam as p on t.pinjam_id = p.pinjam_id inner join tb_barang as b on p.barang_id = b.barang_id
       where t.persetujuan = 'ya' limit ".$limit_start.",".$limit);
     ?>
           <h3>List Pengembalian Barang </h3>
           <div id="pesan1"></div>
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="tbBarang">
                <thead>
                                  <tr>
                                  <td colspan="7">
                                    <input type="text" name="search" placeholder="Pencarian.." id="search" class="form-control" />  
                                  </td>
                 
                                </tr>
                   <tr>
                          <td><b>Nomor</b></td>
                          <td><b>Nama User</b></td>
                          <td><b>Nama Barang</b></td>
                          <td><b>Jumlah Pinjam</b></td>
                          <td><b>Tanggal Ambil</b></td>
                          <td><b>Alasan</b></td>
                          <td><b>Aksi</b></td>
                        </tr>
                </thead>
                
                      <tbody id="pengembalian">
                  <?php 
                  $nomor = $limit_start + 1;
                  while($data=mysql_fetch_array($q)) {
                       $ids = $data["transaksi_id"]; 
                  ?>
                    <tr class="add_sukses<?php echo $ids; ?>">

                          <td><?php echo $nomor; ?></td>
                          <td><?php echo $data["nama"]; ?></td>
                          <td><?php echo $data["nama_barang"]; ?></td>
                           <td><?php echo $data["jumlah_barang"]; ?></td>
                            <td><?php echo $data["tanggal_pengambilan"]; ?></td>
                             <td><?php echo $data["alasan"]; ?></td>
                          <td>
                            <form id="aksitrans" method="GET" >
                  
                             <a id="<?php  echo $data['transaksi_id']; ?>" class="kembali btn btn-success btn-block"><i class="glyphicon glyphicon-log-out"></i> Kembali</a>
                            </form>
                           
                            </td>
                        </tr>
                      <?php 
                      $nomor++;
                  } ?>
                      
                      </tbody>
                    
                    </table>


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
                <li><a href="./index/barang/?page=1">First</a></li>
                <li><a href="./index/barang/?page=<?php echo $link_prev; ?>">&laquo;</a></li>
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