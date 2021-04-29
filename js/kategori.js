
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
        dataType  : 'json'
      };
      $('#frm').ajaxForm(options); 
      
      //validasi form dgn jquery validate
      $('#frm').validate({
        rules: {
          nim : {
            digits: true,
            minlength:10,
            maxlength:10
          }
        },
        messages: {
          nim: {
            required: "Kolom nim harus diisi",
            minlength: "Kolom nim harus terdiri dari 10 digit",
            maxlength: "Kolom nim harus terdiri dari 10 digit",
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
          {display: 'NIM', name : 'nim', width : 100, sortable : true, align: 'left', process: doaction},
          {display: 'Nama', name : 'nama', width : 200, sortable : true, align: 'left', process: doaction},
          {display: 'Alamat', name : 'alamat', width : 400, sortable : true, align: 'left', process: doaction}
          ],
        searchitems : [
          {display: 'NIM', name : 'nim'},
          {display: 'Nama', name : 'nama', isdefault: true}
          ],
          
        sortname: 'nama',
        sortorder: 'asc',
        usepager: true,
        title: 'Data Mahasiswa',
        useRp: true,
        rp: 15,
        width: 700,
        height: 400
        }
      );
      
        }); 
        function doaction( celDiv, id ) {
      $( celDiv ).click( function() {
        var nim = $(this).parent().parent().children('td').eq(0).text();
        $.getJSON ('index.php',{action:'get_mhs',nim:nim}, function (json) {
          $('#nim').val(json.nim);
          $('#nama').val(json.nama);
          $('#alamat').val(json.alamat);
        }); 
        $('#nim').attr('readonly','readonly');
        $('#input').attr('disabled','disabled');
        $('#edit, #delete').removeAttr('disabled');
      });
    }
        function showResponse(responseText, statusText) {
      var data = responseText['data'];
      var pesan = responseText['pesan'];
      alert(pesan);
      resetForm();
      $('#flex1').flexReload();
    }
    function resetForm() {
      $('#input').removeAttr('disabled');
      $('#edit, #delete').attr('disabled','disabled');
      $('#nim').removeAttr('readonly');
    }
    