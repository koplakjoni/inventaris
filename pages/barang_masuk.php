
 <script type="text/javascript" src="libs/jquery.min.js"></script>
    <script type="text/javascript" src="libs/jquery.form.js"></script>
    <script type="text/javascript" src="libs/jquery.validate.min.js"></script>
    <link rel="stylesheet" type="text/css" href="libs/flexigrid/css/flexigrid.css">
    <script type="text/javascript" src="libs/jquery.cookie.js"></script>
    <script type="text/javascript" src="libs/flexigrid/js/flexigrid.js"></script>
     <script type="text/javascript">
$(document).ready(function() {      
    $('#photo').live('change', function()           { 
        $("#preview").html('');
        $("#preview").html('<img src="images/loader.gif" alt="Uploading...."/>');
    $("#image_upload_form").ajaxForm({
                target: '#preview'
}).submit();

    });
}); 
</script>
    <script type="text/javascript">
         $(document).ready(function(){  

            $("#tambahbarang").validate({
            rules: {
      name: "required",
      kategori_id: "required",
      satuan: "required",
      jumlah:{ required :true, digits:true },
      cara: "required",
      deskripsi: "required"
    },
  
    messages: {
      name: "Tidak Boleh Kosong",
      kategori_id: "Tidak Boleh Kosong",
      satuan: "Tidak Boleh Kosong",
      jumlah: {required:"Tidak Boleh Kosong",digits:"Hanya dapat di isi angka"},
      cara: "Tidak Boleh Kosong",
      deskripsi: "Tidak Boleh Kosong"
    },
        submitHandler: function (form) {
               var name = $('#name').val();
                   var kategori_id = $('#kategori_id').val();
                   var jumlah = $('#jumlah').val();
                   var satuan = $('#satuan').val();
                   var cara = $('#cara').val();
                   var deskripsi = $('#deskripsi').val();
                   
                    $.ajax({
                        type: "POST",
                        url: 'uploadB.php',
                        data: {name: name,kategori_id: kategori_id,jumlah: jumlah,satuan: satuan,cara: cara,deskripsi: deskripsi },
                        success: function(data){
                     $('#message').html("<h3>"+data+"</h3>")
                         .append("<p>Iqbalcakep.com</p>")
                        }                
                });   
                    return false;
         }

            });

         });
    </script>
<div class="col-md-7">
		  			
		  			<div class="content-box-large">

				            	 <h3>Tambah Barang</h3>

				            	 <div id='preview'></div>   
             <form id="image_upload_form" method="post" enctype="multipart/form-data" action='uploadB.php' autocomplete="off">
                    <div class="browse_text">Buka File Gambar:</div>
                    <div class="file_input_container">
                        <div class="upload_button"><input type="file" name="photo" id="photo" class="file_input" /></div>
                    </div><br clear="all">
                </form><br>

				            	
			<form id="tambahbarang"  name="tambahbarang" enctype="multipart/form-data">
   
            Nama Barang : 
            <input type="text" required name="name" class="required form-control"  id="name" /><br>
            Kategori Barang :
            <select required class="form-control" id="kategori_id" name="kategori_id"  >
            	<option value="">- Pilih Kategori -</option>
                <?php $q1 = mysql_query("Select * from tb_kategori");
                while ($row = mysql_fetch_array($q1)){
                    ?>
                <option value="<?php echo $row['kategori_id']; ?>"><?php echo $row['kategori_id']." - ".$row['nama_kategori']; ?></option>
                <?php } ?>
            </select><br>
            Jumlah Barang :
            <input type="text" name="jumlah" required class=" form-control" " id="jumlah" /><br>
            Satuan Barang :
            <input type="text" name="satuan" required class="required form-control" id="satuan" /><br>
            Cara Perolehan :
            <input type="text" name="cara" required class="required form-control"  id="cara" /><br>
            Deskripsi :
            <input type="text" name="deskripsi" required class="required form-control" id="deskripsi" /><br><br><br>
             
                <div class="action">
			                	 <button type="submit" name="simpan" class="btn btn-info"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
			                </div>      

                    </form>

                    <div id='message'></div>

						<br /><br />
					</div>
		  		</div>

