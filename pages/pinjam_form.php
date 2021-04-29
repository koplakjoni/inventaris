<?php if(isset($_GET['id'])){ ?>
 <script type="text/javascript" src="libs/jquery.min.js"></script>
    <script type="text/javascript" src="libs/jquery.form.js"></script>
    <script type="text/javascript" src="libs/jquery.validate.min.js"></script>
    <link rel="stylesheet" type="text/css" href="libs/flexigrid/css/flexigrid.css">
    <script type="text/javascript" src="libs/jquery.cookie.js"></script>
    <script type="text/javascript" src="libs/flexigrid/js/flexigrid.js"></script>
    <script type="text/javascript">
         $(document).ready(function(){  
      
            $("#barang").validate({
            rules: {
      
      id: "required",
      jumlah:{ required :true, digits:true },
      lama: "required",
      alasan : "required",
      tanggalambil : "required"
    },
  
    messages: {
      id: "Tidak Boleh Kosong",
     jumlah: {required:"Tidak Boleh Kosong",digits:"Hanya dapat di isi angka"},
      alasan: "Tidak Boleh Kosong",
      tanggalambil : "Tidak Boleh Kosong"
    },
        submitHandler: function (form) {
                   var id = $('#id').val();
                   var jumlah = $('#jumlah').val();
                   var alasan = $('#alasan').val();
                   var tanggalambil = $('#tanggalambil').val();
                   
                    $.ajax({
                        type: "POST",
                        url: 'pages/pinjam_proses.php',
                        data: {id: id,jumlah: jumlah,alasan: alasan,tanggalambil : tanggalambil },
                        success: function(data){
                     $('#message').html("<h4>"+data+"</h4>");
                         
                        }                
                });   
                    return false;
         }

            });
         });
    </script>
<div class="col-md-7">
  <?php $data = mysql_fetch_array(mysql_query("select * from tb_barang where barang_id = '$_GET[id]'")) ?>
		  			
		  			<div class="content-box-large">

				            	 <h3>Pinjam Barang</h3>
				            	<div id="message" style="color: red;"></div>
			<form id="barang" method="post"  name="barang" >

          <img src='images/barang/<?php echo $data["gambar"]; ?>' class='preview'><br><br>
        
            ID Barang : 
            <input type="text" required name="id" disabled value="<?php echo $data['barang_id']; ?>" class="required form-control"  id="id" /><br>
            Nama Barang : 
            <input type="text" required name="id" disabled value="<?php echo $data['nama_barang']; ?>" class="required form-control"  id="id" /><br>
            Jumlah Pinjam :
            <input type="text" name="jumlah" required class=" form-control" " id="jumlah" /><br>
            Alasan :
            <input type="text" name="alasan" required class=" form-control" " id="alasan" /><br>
            Tanggal Pengambilan :
            <input type="text" name="tanggalambil" required placeholder="2018-01-10" class="required form-control" id="tanggalambil" /><br>
                <div class="action">
                         <button type="submit" name="simpan" class="btn btn-info"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
                      </div>      


                    </form>

						<br /><br />
					</div>
		  		</div>

<?php } ?>