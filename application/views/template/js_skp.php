
<script type="text/javascript">

var save_method; //for save method string
var table;
var status_skp = '<?php echo $this->input->get('status_skp') ?>';
$(document).ready(function() {

  table = $('#table_skp').DataTable({

    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.
  "searchable": true,
    // Load data for the table's content from an Ajax source
    "ajax": {
      "url": "<?php echo site_url('skp/ajax_list/')?>"+status_skp,
      "type": "POST",
    
    },

    //Set column definition initialisation properties.
    "columnDefs": [
    {
     "searchable": true,
      "targets": [ -1 ], //last column
      "orderable": false, //set not orderable
    },
    ],

  });
  
  $('#btn-filter').click(function(){ //button filter event click
        table.ajax.reload();  //just reload table
    });


    $("#btn-tambah-form").click(function(){ // Ketika tombol Tambah Data Form di klik
      var jumlah = parseInt($("#jumlah-form").val()); // Ambil jumlah data form pada textbox jumlah-form
      var nextform = jumlah + 1; // Tambah 1 untuk jumlah form nya
     
      // Kita akan menambahkan form dengan menggunakan append
      // pada sebuah tag div yg kita beri id insert-form
      $("#insert-form").append('<div class="panel panel-default">'+
        '<div class="panel-heading">'+
          '<h3 class="panel-title">Produk '+nextform+' :</h3>'+
            '</div><div class="panel-body">'+
              '<div class="form-group" style="padding-left: 20px; padding-right: 20px;">'+
                  '<label class="control-label ">NO.SKP :</label>'+
                      '<input name="no_skp[]" placeholder="masukan no.skp" class="form-control" type="text"></div>'+
              '<div class="form-group" style="padding-left: 20px; padding-right: 20px;">'+
                                '<label class="control-label ">NAMA PRODUK :</label>'+
                                  '<select class="form-control" name="id_produk[]">'+
                                         '<option value="">-- Pilih Produk --</option>'+
                                          '<?php foreach ($data_produk as $field) { ?>'+
                                             '<option value="<?php echo $field->id_produk ?>"><?php echo $field->nama_produk ?> </option>'+

                                            
                                          '<?php } ?>'+
                                   '</select>'+
                              '</div> </div>'+
      '</div> ');
      
        $("#jumlah-form").val(nextform); // Ubah value textbox jumlah-form dengan variabel nextform
    });
    
    // Buat fungsi untuk mereset form ke semula
    $("#btn-reset-form").click(function(){
      $("#insert-form").html(""); // Kita kosongkan isi dari div insert-form
      $("#jumlah-form").val("1"); // Ubah kembali value jumlah form menjadi 1
    });
    
});


  function insert_check()  //check produk
  {
     // var no_skp = document.forms["form_addskp"]["no_skp"].value;
      var id_upi = document.forms["form_addskp"]["id_upi"].value;
     // var id_produk = document.forms["form_addskp"]["id_produk"].value;
      var jenis_skp = document.forms["form_addskp"]["jenis_skp"].value;
      var tgl_keluar = document.forms["form_addskp"]["tgl_keluar"].value;
      var tgl_akhir = document.forms["form_addskp"]["tgl_akhir"].value;
     // var peringkat = document.forms["form_addskp"]["peringkat"].value;


    if(id_upi == "" || jenis_skp == "" || tgl_keluar == "" || tgl_akhir == "")
     {
        alert("Data Tidak Boleh Ada Yang Kosong");
     }
     else{ 
             save();
     }
  
  }

  function reload_table()
  {
      table.ajax.reload(null,false); //reload datatable ajax
      location.reload();
  }


  function add_data() //add produk
  {
      save_method = 'add';
       $('#btn_addbatch').css('display', 'block');
      $('#form_addskp')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#modal_addskp').modal('show'); // show bootstrap modal
      $('.modal-title').text('#Tambah SKP');
     
  }


  function delete_data(id)
    {
        if(confirm('Anda Yakin Ingin Menghapus Data ?'))
        {
            // ajax delete data to database
            $.ajax({
                url : "<?php echo site_url('skp/ajax_delete')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    
                    reload_table();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });

        }
    }
function edit_data(id) // select data & display to field
  {
      save_method = 'update';
      $('#form_addskp')[0].reset(); // reset form on modals
      $('#btn_addbatch').css('display', 'none');
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('.modal-title').text('#Edit SKP');
      //Ajax Load data from ajax
      $.ajax({
          url : "<?php echo site_url('skp/ajax_view/')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {

              $('[name="id_skp"]').val(data.id_skp);
              $('[name="no_skp[]"]').val(data.no_skp);
              
               $('[name="jenis_skp"]').val(data.jenis_skp).trigger('change');
               $('[name="id_upi"]').val(data.id_upi).trigger('change');
               $("#id_produk").val(data.id_produk).trigger('change');
               
            // $('[name="id_upi"]').val(data.id_upi);
            //  $('[name="id_produk[]"]').val(data.id_produk);
              //$('[name="jenis_skp"]').val(data.jenis_skp);
              $('[name="tgl_keluar"]').val(data.tgl_keluar);
              $('[name="tgl_akhir"]').val(data.tgl_akhir);
             // $('[name="peringkat"]').val(data.peringkat);

             
             
              $('#modal_addskp').modal('show'); // show bootstrap modal when complete loaded
             

          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
  }

function view_user(id) // select data & display to field
  {

      $('#form_lihat')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('.modal-title').text('#Info Login');
      //Ajax Load data from ajax
      $.ajax({
          url : "<?php echo site_url('user/ajax_view/')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {

              $('[name="username_v"]').text(data.username);
             
              $('[name="level_v"]').text(data.level);
              $('[name="ip_address"]').text(data.ip_address);
              $('[name="last_login"]').text(data.last_login);


              $('#modal_lihat').modal('show'); // show bootstrap modal when complete loaded
             

          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
  }



function save()  //save or update produk
  {
    var url;
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable

    if(save_method == 'add'){
        url = "<?php echo site_url('skp/ajax_add')?>";
    }
    else if(save_method == 'update'){
           url = "<?php echo site_url('skp/ajax_update')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form_addskp').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                
                $('#modal_addskp').modal('hide');
                reload_table();
            }

            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable

        }
    });
}

/*
function sync_data() // select data & display to field
  {
      
      $('#btnSync').html('<i class="glyphicon glyphicon-cloud-upload"></i> Updating...');
      $('#btnSync').attr('disabled',true); //set button enable

      $.ajax({
          url : "<?php echo site_url('skp/update_sisa_skp')?>",
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
             $('#btnSync').html('<i class="glyphicon glyphicon-cloud-upload"></i> Update Sisa SKP');
             $('#btnSync').attr('disabled',false); //set button enable

            if(data.status == true){
              alert('Success! Berhasil update data sisa SKP');
            }else{
              alert('Error! Gagal update data sisa SKP');
            }
            reload_table();

          },
          error: function (jqXHR, textStatus, errorThrown)
          {
             $('#btnSync').html('<i class="glyphicon glyphicon-cloud-upload"></i> Update Sisa SKP');
             $('#btnSync').attr('disabled',false); //set button enable
               alert('Error! Gagal update data sisa SKP');
          }
      });
  }
  */


</script>
