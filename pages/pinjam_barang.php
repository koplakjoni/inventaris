
<div class="col-md-7">
                    
                    <div class="content-box-large">
   <script type="text/javascript" src="libs/jquery.min.js"></script>
    <script type="text/javascript" src="libs/jquery.form.js"></script>
    <script type="text/javascript" src="libs/jquery.validate.min.js"></script>
    <link rel="stylesheet" type="text/css" href="libs/flexigrid/css/flexigrid.css">
    <script type="text/javascript" src="libs/jquery.cookie.js"></script>
    <script type="text/javascript" src="libs/flexigrid/js/flexigrid.js"></script>
    <script type="text/javascript">
         $(document).ready(function(){  
            function goBack() {
    location.reload();
}
            $("#my_form_id").validate({
            rules: {
      
      id: "required",
      name: "required",
      kategori_id: "required",
      satuan: "required",
      jumlah:{ required :true, digits:true },
      cara: "required",
      deskripsi: "required"
    },
  
    messages: {
      id: "Tidak Boleh Kosong",
      name: "Tidak Boleh Kosong",
      kategori_id: "Tidak Boleh Kosong",
      satuan: "Tidak Boleh Kosong",
      jumlah: {required:"Tidak Boleh Kosong",digits:"Hanya dapat di isi angka"},
      cara: "Tidak Boleh Kosong",
      deskripsi: "Tidak Boleh Kosong"
    },
        submitHandler: function (form) {
               var name = $('#name').val();
                   var id = $('#id').val();
                   var kategori_id = $('#kategori_id').val();
                   var jumlah = $('#jumlah').val();
                   var satuan = $('#satuan').val();
                   var cara = $('#cara').val();
                   var deskripsi = $('#deskripsi').val();
                   
                    $.ajax({
                        type: "POST",
                        url: 'pages/read.php',
                        data: {name: name,id: id,kategori_id: kategori_id,jumlah: jumlah,satuan: satuan,cara: cara,deskripsi: deskripsi },
                        success: function(data){
                        $(form).html("<div id='message'></div>");
                     $('#message').html("<h2>Data Berhasil Di Edit</h2>")
                         .append("<p>Iqbalcakep.com</p>")
                        }                
                });   
                    return false;
         }

            });
         });
    </script>
    <script type="text/javascript">
$(document).ready(function() {      
    $('#photo').live('change', function()           { 
        $("#preview").html('');
        $("#preview").html('<img src="loader.gif" alt="Uploading...."/>');
    $("#image_upload_form").ajaxForm({
                target: '#preview'
}).submit();

    });
}); 
</script>
 <script>  
      $(document).ready(function(){  
           $('#search').keyup(function(){  
                search_table($(this).val());  
           });  
           function search_table(value){  
                $('#tbBarangku tbody tr').each(function(){  
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
                $limit = 5;
                $limit_start = ($page - 1) * $limit;

            $q=mysql_query("select * from tb_barang limit ".$limit_start.",".$limit);
         ?>
                     <h3>Daftar Barang </h3>
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="tbBarangku">
                            <thead>
                                  <tr>
                                  <td colspan="4">
                                    <input type="text" name="search" placeholder="Pencarian.." id="search" class="form-control" />  
                                  </td>
                 
                                </tr>
                                 <tr>
                                  <td><b>Nomor</b></td>
                                  <td><b>Nama Barang</b></td>
                                  <td><b>jumlah</b></td>
                                  <td><b>Aksi</b></td>
                                </tr>
                            </thead>
                            
                              <tbody>
                          <?php 
                          $nomor = $limit_start + 1;
                          while($data=mysql_fetch_array($q)) {
                          ?>
                                <tr>

                                  <td><?php echo $nomor; ?></td>
                                  <td><?php echo $data["nama_barang"]; ?></td>
                                  <td><?php echo $data["jumlah"]; ?></td>
                                  <td>
                                    <?php if($data["jumlah"]<=1){ ?>
                                      <button disabled class="btn btn-default"><i class="glyphicon glyphicon-print"></i> Pinjam</button>
                                    <?php }else{ ?>
                                    <button class="btn btn-default"  onclick="location.href = './index/pinjam_form/?id=<?php echo $data[barang_id] ?>';" ><i class="glyphicon glyphicon-print"></i> Pinjam</button>
                                    <?php } ?>
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
                <li><a href="./index/pinjam_barang/?page=1">First</a></li>
                <li><a href="./index/pinjam_barang/?page=<?php echo $link_prev; ?>">&laquo;</a></li>
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
                <li <?php echo $link_active; ?>><a href="./index/pinjam_barang/?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
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
                <li><a href="./index/pinjam_barang/?page=<?php echo $link_next; ?>">&raquo;</a></li>
                <li><a href="./index/pinjam_barang/?page=<?php echo $jumlah_page; ?>">Last</a></li>
            <?php
            }
            ?>
        </ul>

      

                            

                        <br /><br />
                    </div>
                </div>


