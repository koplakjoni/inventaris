<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "db_inventaris";

// Koneksi dan memilih database di server
mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");
/* penanganan form */
if (isset($_POST['Input'])) {
  $kategori_id    = strip_tags($_POST['kategori_id']);
  $nama_kategori   = strip_tags($_POST['nama_kategori']);
  $keterangan = strip_tags($_POST['keterangan']);
  
  //input ke db
  $query = sprintf("INSERT INTO tb_kategori VALUES('%s', '%s', '%s')", 
      mysql_escape_string($kategori_id), 
      mysql_escape_string($nama_kategori), 
      mysql_escape_string($keterangan)
    );
  $sql = mysql_query($query);
  $pesan = "";
  if ($sql) {
    $pesan = "Data berhasil disimpan";
  } else {
    $pesan = "Data gagal disimpan ";
    $pesan .= mysql_error();
  }
  echo json_encode($pesan);
  exit;
} else if (isset($_POST['Edit'])) {
  $kategori_id    = strip_tags($_POST['kategori_id']);
  $nama_kategori   = strip_tags($_POST['nama_kategori']);
  $keterangan = strip_tags($_POST['keterangan']);
  
  //update data
  $query = sprintf("UPDATE tb_kategori SET nama_kategori='%s', keterangan='%s' WHERE kategori_id='%s'", 
      mysql_escape_string($nama_kategori), 
      mysql_escape_string($keterangan),
      mysql_escape_string($kategori_id)
    );
  $sql = mysql_query($query);
  $pesan = "";
  if ($sql) {
    $pesan = "Data berhasil disimpan";
  } else {
    $pesan = "Data gagal disimpan ";
    $pesan .= mysql_error();
  }
 echo json_encode($pesan);
  exit;
} else if (isset($_POST['Delete'])) {
  $kategori_id    = strip_tags($_POST['kategori_id']);
  
  //delete data
  $query = sprintf("DELETE FROM tb_kategori WHERE kategori_id='%s'", 
      mysql_escape_string($kategori_id)
    );
  $sql = mysql_query($query);
  $pesan = "";
  if ($sql) {
    $pesan = "Data berhasil dihapus";
  } else {
    $pesan = "Data gagal dihapus ";
    $pesan .= mysql_error();
  }
echo json_encode($pesan);
  exit;
} else if (isset($_GET['action']) && $_GET['action'] == 'getdata') {
    
  $page = (isset($_POST['page']))?$_POST['page']: 1;
  $rp = (isset($_POST['rp']))?$_POST['rp'] : 10;
  $sortname = (isset($_POST['sortname']))? $_POST['sortname'] : 'nama_kategori';
  $sortorder = (isset($_POST['sortorder']))? $_POST['sortorder'] : 'asc';
      
  $sort = "ORDER BY $sortname $sortorder";
  $start = (($page-1) * $rp);
  $limit = "LIMIT $start, $rp";
  
  $query = (isset($_POST['query']))? $_POST['query'] : '';
  $qtype = (isset($_POST['qtype']))? $_POST['qtype'] : '';
  
  $where = "";
  if ($query) $where .= "WHERE $qtype LIKE '%$query%' ";
  
  $query = "SELECT kategori_id,nama_kategori,keterangan ";
  $query_from =" FROM tb_kategori ";
  
  $query .= $query_from . " $where $sort $limit";
    
  $query_total = "SELECT COUNT(*)". $query_from." ".$where;
  
  $sql = mysql_query($query) or die($query);
  $sql_total = mysql_query($query_total) or die($query_total);
  $total = mysql_fetch_row($sql_total);
  $data = $_POST;
  $data['total'] = $total[0];
  $datax = array();
  $datax_r = array();
  while ($row = mysql_fetch_row($sql)) {
    $rows['kategori_id'] = $row[0];
    $datax['cell'] = $row;
    array_push($datax_r, $datax);
  }
  $data['rows'] = $datax_r;
  echo json_encode($data);
  exit;
} else if (isset($_GET['action']) && $_GET['action'] == 'get_kat') {
  $id = $_GET['kategori_id'];
  $query = "SELECT * FROM tb_kategori WHERE kategori_id='$id'";
  $sql = mysql_query($query);
  $row = mysql_fetch_assoc($sql);
  echo json_encode ($row);
  exit;
}
?>

    <style type="text/css">
    .labelfrm {
      display:block;
      font-size:small;
      margin-top:5px;
    }
    .error {
      font-size:small;
      color:red;
    }
    </style>
    <script type="text/javascript" src="libs/jquery.min.js"></script>
    <script type="text/javascript" src="libs/jquery.form.js"></script>
    <script type="text/javascript" src="libs/jquery.validate.min.js"></script>
    <link rel="stylesheet" type="text/css" href="libs/flexigrid/css/flexigrid.css">
    <script type="text/javascript" src="libs/jquery.cookie.js"></script>
    <script type="text/javascript" src="libs/flexigrid/js/flexigrid.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {

      resetForm();
            //aktifkan ajax di form
        var options = {
        success   : showResponse,
        beforeSubmit:  function(){
          return $("#frm").valid();
        },
      
        resetForm : true,
        clearForm : true,
       
      };
      $('#frm').ajaxForm(options); 
      
      //validasi form dgn jquery validate
      $('#frm').validate({
        rules: {
          kategori_id : {
            digits: true,
            minlength:1,
            maxlength:3
          }
        },
        messages: {
          kategori_id: {
            required: "Kolom nim harus diisi",
            minlength: "Kolom nim harus terdiri dari 1 digit",
            maxlength: "Kolom nim harus terdiri dari 3 digit",
            digits: "NIM harus berupa angka"
          },
          nama: {
            required: "Nama harus diisi dengan benar"
          }
        }
      });
      
      //flexigrid handling
      $('#flex1').flexigrid
      (
        {
        url: 'pages/kategori.php?action=getdata',
        dataType: 'json',
        
        colModel : [
          {display: 'ID', name : 'kategori_id', width : 100, sortable : true, align: 'left', process: doaction},
          {display: 'Nama', name : 'nama_kategori', width : 200, sortable : true, align: 'left', process: doaction},
          {display: 'Keterangan', name : 'keterangan', width : 400, sortable : true, align: 'left', process: doaction}
          ],
        searchitems : [
          {display: 'ID', name : 'kategori_id'},
          {display: 'Nama', name : 'nama_kategori', isdefault: true}
          ],
          
        sortname: 'nama_kategori',
        sortorder: 'asc',
        usepager: true,
        title: 'Data Kategori',
        useRp: true,
        rp: 15,
        width: 730,
        height: 200
        }
      );
      
        }); 

        function doaction( celDiv, id ) {
      $( celDiv ).click( function() {
        var kategori_id = $(this).parent().parent().children('td').eq(0).text();
        $.getJSON ('pages/kategori.php',{action:'get_kat',kategori_id:kategori_id}, function (json) {
          $('#kategori_id').val(json.kategori_id);
          $('#nama_kategori').val(json.nama_kategori);
          $('#keterangan').val(json.keterangan);
        }); 
        $('#kategori_id').attr('readonly','readonly');
        $('#input').attr('disabled','disabled');
        $('#edit, #delete').removeAttr('disabled');
      });
    }
        function showResponse(pesan) {
       alert('Refresh Data');
      resetForm();
      $('#flex1').flexReload();
    }
    function resetForm() {
      $('#input').removeAttr('disabled');
      $('#edit, #delete').attr('disabled','disabled');
      $('#kategori_id').removeAttr('readonly');
    }
 
    </script>
 
<div class="col-md-7">
            
            <div class="content-box-large">
    <h1> Kategori Barang</h1>
    <form action="" method="post" id="frm"  onReset="resetForm()">
      <label for="nim" class="labelfrm">ID: </label>
      <input type="text" name="kategori_id" id="kategori_id" maxlength="3" class="required form-control" size="15"/>
      
      <label for="nama" class="labelfrm">NAMA: </label>
      <input type="text" name="nama_kategori" id="nama_kategori" size="30" class="required form-control"/>
      
      <label for="alamat" class="labelfrm">KETERANGAN: </label>
      <textarea name="keterangan" id="keterangan" cols="40" rows="4" class="required form-control"></textarea>
      <label for="submit" class="labelfrm">&nbsp;</label>
      <input type="submit" name="Input" value="Input" id="input"/>
      <input type="submit" name="Edit" value="Edit" id="edit"/>
      <input type="submit" name="Delete" value="Delete" id="delete"/>
      <input type="reset" name="Clear" value="Clear" id="clear"/>
    </form>
    
    <table id="flex1" style="display:none"></table>
</div>
</div>