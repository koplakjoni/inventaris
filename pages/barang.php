
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
                $limit = 20;
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
                                    <button class="btn btn-default"  onclick="location.href = './index/barang-view<?php echo $data[barang_id] ?>1user#popup';" ><i class="glyphicon glyphicon-eye-open"></i> View</button>
                                    
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

        <?php if($_GET["del"]){
            mysql_query("delete from tb_kategori where kategori_id = '$_GET[del]'");
            echo "<script>window.alert('Data Berhasil Dihapus')</script>";
            echo "<script>window.location=('./index/barang/')</script>";
        } ?>

                            

                        <br /><br />
                    </div>
                </div>

<?php if(isset($_GET["view"])){ 
    $data = mysql_fetch_array(mysql_query("Select * from tb_barang where barang_id = '$_GET[view]'"));
    $kat = mysql_fetch_array(mysql_query("select * from tb_kategori where kategori_id = '$data[kategori_id]'"));
    ?>

<div id="popup">
        <div class="window">
            <a href="./index/barang/#" class="close-button" title="Close">X</a>
            

            <div class="row panel panel-success" style="margin-top:2%;">
            <div class="panel-heading lead">
                <div class="row">
                    <div class="col-lg-7 col-md-7"><i class="fa fa-users"></i> Barang Details</div>
                </div>
            </div>
            <div class="panel-body">
                                        
                
                                                          
                    <div class="row">
                        <div class="col-lg-12 col-md-12">

                            <div class="row">
                                <div class="col-lg-3 col-md-3">
                                    <center>
                                        <span class="text-left">
                                        <img src="images/barang/<?php echo $data['gambar']; ?>" class="img-responsive img-thumbnail">
                
                                    </span></center>

                                    <div class="table-responsive panel">
                                        <table class="table">
                                            <tbody>
                                                        <tr>
                                                        <td class="text-center">
                                                    
                                                             <a href="./index/barang-view<?php echo $data[barang_id]; ?>1user#pgambar" class="btn btn-danger text-success btn-block"><i class="fa fa-photo"></i> EDIT IMAGES</a>
                                                            <a href="./index/barang-view<?php echo $data[barang_id]; ?>1user#pedit" class="btn btn-success btn-block"><i class="fa fa-photo"></i> EDIT DATA</a>
                                                        </td>
                                                    </tr>
                                                                                        
                                            </tbody>
                                        </table>
                                    </div>

                                    
                                </div>
                                <div class="col-lg-9 col-md-9">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a data-toggle="tab" href="#Summery" class="text-success"><i class="fa fa-indent"></i> LIST DETAIL</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        <div id="Summery" class="tab-pane fade in active">

                                            <div class="table-responsive panel">
                                                <table class="table">
                                                    <tbody>
    
                                                            <tr>
                                                                <td class="text-success"><i class="fa fa-user"></i> Nama Barang</td>
                                                                <td><?php echo $data["nama_barang"]; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-success"><i class="fa fa-list-ol"></i> Kategori</td>
                                                                <td><?php echo $kat["nama_kategori"]; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-success"><i class="fa fa-book"></i> Jumlah</td>
                                                                <td><?php echo $data["jumlah"]; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-success"><i class="fa fa-group"></i> Satuan</td>
                                                                <td><?php echo $data["satuan"]; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-success"><i class="fa fa-calendar"></i> Cara Perolehan</td>
                                                                <td><?php echo $data["cara_perolehan"]; ?></td>
                                                            </tr>

                                                                                                                                   
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                        <div class="col-lg-9 col-md-9">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a data-toggle="tab" href="#Summery" class="text-success"><i class="fa fa-indent"></i> DESKRIPSI</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        <div id="Summery" class="tab-pane fade in active">

                                            <div class="table-responsive panel" style="padding: 5px;">
                                               <?php echo $data["deskripsi"]; ?>
                                            </div>
                                        </div>
                   

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                <!-- /.table-responsive -->
                
            </div>
        </div>


            </h2>
        </div>
    </div>
<?php } ?>


<div id="pedit">
        <div class="window">
            <h3>Edit Data Barang</h3> <span style="float: right;margin-top: -30px;"><button onclick="window.history.go(-2);">Close</button></span>
            <hr>
            <?php 
             ?>
            <form id="my_form_id" name="updatebarang">
            <input type="hidden" required= name="id" id="id" value="<?php echo $data['barang_id']; ?>">
            Nama Barang : 
            <input type="text" required name="name" class="required form-control" value="<?php echo $data['nama_barang']; ?>" id="name" /><br>
            Kategori Barang :
            <select required class="form-control" id="kategori_id" name="kategori_id" <?php echo $read; ?> >
                <?php $q1 = mysql_query("Select * from tb_kategori");
                while ($row = mysql_fetch_array($q1)){
                    if($data['kategori_id'] == "$row[kategori_id]"){
                        $select = "Selected";   
                    }else{
                        $select ="";
                    }?>
                <option value="<?php echo $row['kategori_id']; ?>" <?php echo $select; ?>><?php echo $row['kategori_id']." - ".$row['nama_kategori']; ?></option>
                <?php } ?>
            </select><br>
            Jumlah Barang :
            <input type="text" name="jumlah" required class=" form-control" value="<?php echo $data['jumlah']; ?>" id="jumlah" /><br>
            Satuan Barang :
            <input type="text" name="satuan" required class="required form-control" value="<?php echo $data['satuan']; ?>" id="satuan" /><br>
            Cara Perolehan :
            <input type="text" name="cara" required class="required form-control" value="<?php echo $data['cara_perolehan']; ?>" id="cara" /><br>
            Deskripsi :
            <input type="text" name="deskripsi" required class="required form-control" value="<?php echo $data['deskripsi']; ?>" id="deskripsi" /><br>

                      <input type="submit" class="btn btn-success" id="update" name="update" value="update" />

                    </form>
                    <hr>
                </div>
    </div>


<div id="pgambar">
<?php $_SESSION['idb'] = $data['barang_id'];  ?>
        <div class="window">
            <h3>Edit Gambar Barang</h3> <span style="float: right;margin-top: -30px;"><button onclick="window.history.go(-2);">Close</button></span>
            <hr>

    <br />
    <div class="upload_container">
        <br clear="all" />
        <center>
            <div style="width:350px" align="center">
                <div id='preview'></div>    
                <form id="image_upload_form" method="post" enctype="multipart/form-data" action='upload.php' autocomplete="off">
                    <div class="browse_text">Buka File Gambar:</div>
                    <div class="file_input_container">
                        <div class="upload_button"><input type="file" name="photo" id="photo" class="file_input" /></div>
                    </div><br clear="all">
                </form>
            </div>
        </center>
        <br clear="all" />
    </div>
   <br><br><br><br>
                    <hr>
                    
                </div>
    </div>
