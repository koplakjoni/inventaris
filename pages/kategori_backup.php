
<div class="col-md-7">
		  			
		  			<div class="content-box-large">

		<?php 
		
				$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
                $limit = 5;
                $limit_start = ($page - 1) * $limit;

			$q=mysql_query("select * from tb_kategori limit ".$limit_start.",".$limit);
		 ?>
					 <h3>List Kategori </h3>
			  		<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
			  				<thead>
			  					 <tr>
				                  <td><b>Nomor</b></td>
				                  <td><b>Nama Kategori</b></td>
				                  <td><b>Keterangan</b></td>
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
				                  <td><?php echo $data["nama_kategori"]; ?></td>
				                  <td><?php echo $data["keterangan"]; ?></td>
				                  <td><button class="btn btn-danger" onclick="location.href = './index/kategori/?del=<?php echo $data[kategori_id]; ?>';"><i class="glyphicon glyphicon-remove"></i> Hapus</button></td>
				                </tr>
				              <?php 
				              $nomor++;
				          } ?>
				                <tr>
				                  <td colspan="4">
				 
				                  	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i> Tambah</button>
				                  </td>
				 
				                </tr>
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
                <li><a href="./index/kategori/?page=1">First</a></li>
                <li><a href="./index/kategori/?page=<?php echo $link_prev; ?>">&laquo;</a></li>
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
                <li <?php echo $link_active; ?>><a href="./index/kategori/?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
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
                <li><a href="./index/kategori/?page=<?php echo $link_next; ?>">&raquo;</a></li>
                <li><a href="./index/kategori/?page=<?php echo $jumlah_page; ?>">Last</a></li>
            <?php
            }
            ?>
        </ul>

        <?php if($_GET["del"]){
        	mysql_query("delete from tb_kategori where kategori_id = '$_GET[del]'");
        	echo "<script>window.alert('Data Berhasil Dihapus')</script>";
			echo "<script>window.location=('./index/kategori/')</script>";
        } ?>

				        


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Data</h4>
      </div>
      <div class="modal-body">
    
			<?php if($_GET["pesan"]){ ?>
	              <span style="color: red;"><?php echo $_GET["pesan"]; ?></span>
	            <?php } ?>
				            <form action=".?p=kategori&add" method="post">
			                <input style="margin: 10px;" class="form-control" type="text"  name="kategori" placeholder="Nama Kategori">
			                <input style="margin: 10px;" class="form-control" type="text" name="keterangan" placeholder="Keterangan">
			                               
			            </form>

       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="simpan" id="save" class="btn btn-primary"> <i class="glyphicon glyphicon-floppy-disk"></i> Save</button>
      </div>
    </div>
  </div>
</div> 







						<br /><br />
					</div>
		  		</div>

		  		<?php 
		  		if(isset($_POST["simpan"])){
		  			$kategori = $_POST["kategori"];
					$keterangan = $_POST["keterangan"];
			if(empty($kategori) || empty($keterangan)){
				$pesan = "Maaf Pastikan tidak ada data yang kosong";
				echo "<script>window.location=('./index/kategori/add?pesan=$pesan')</script>";
		    	}else{
		    		mysql_query("insert into tb_kategori set nama_kategori='$kategori',keterangan='$keterangan'");
				$msg = "Data berhasil di simpan";
			$response = array('pesan'=>$msg, 'data'=>$_POST);
	echo json_encode($response);
	exit;
		    }
		}

		    		?>
		    	
<script type="text/javascript">
			$(document).ready(function() {
            var options = {
				success	  : showResponse,
				resetForm : true,
				clearForm : true,
				dataType  : 'json'
			};
			$('#frm').ajaxForm(options); 
	      function showResponse(responseText, statusText) {
			var data = responseText['data'];
			var pesan = responseText['pesan'];
			alert(pesan);
			resetForm();
		}
	}
</script>
