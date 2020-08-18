
<script type="text/javascript">

var save_method; //for save method string
var table;

$(document).ready(function() {
  table = $('#table_sertif').DataTable({

    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.
  "searchable": true,
    // Load data for the table's content from an Ajax source
    "ajax": {
      "url": "<?php echo site_url('upi_sertifikat/ajax_list')?>",
      "type": "POST"
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



});


  function insert_check()  //check produk
  {
      var no_sertifikat = document.forms["form_addsertif"]["no_sertifikat"].value;
      var id_detail = document.forms["form_addsertif"]["id_detail"].value;
      var id_upi = document.forms["form_addsertif"]["id_upi"].value;
      var tgl_kadaluwarsa = document.forms["form_addsertif"]["tgl_kadaluwarsa"].value;



    if(no_sertifikat == "" || id_detail == "" || id_upi == "" || tgl_kadaluwarsa == "")
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
      $('#form_addsertif')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#modal_addsertif').modal('show'); // show bootstrap modal
      $('.modal-title').text('#Tambah UPI Sertifikat');
     
  }


  function delete_data(id)
    {
        if(confirm('Anda Yakin Ingin Menghapus Data ?'))
        {
            // ajax delete data to database
            $.ajax({
                url : "<?php echo site_url('upi_sertifikat/ajax_delete')?>/"+id,
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
      $('#form_addsertif')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('.modal-title').text('#Edit Sertifikat UPI');
      //Ajax Load data from ajax
      $.ajax({
          url : "<?php echo site_url('upi_sertifikat/ajax_view/')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {

              $('[name="id_sertifikat"]').val(data.id_sertifikat);
              $('[name="no_sertifikat"]').val(data.no_sertifikat);
              $('[name="tgl_kadaluwarsa"]').val(data.tgl_kadaluwarsa);
              $('[name="id_detail"]').val(data.id_detail);
              $('[name="id_upi"]').val(data.id_upi);
            
             
              $('#modal_addsertif').modal('show'); // show bootstrap modal when complete loaded
             

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
        url = "<?php echo site_url('upi_sertifikat/ajax_add')?>";
    }
    else if(save_method == 'update'){
           url = "<?php echo site_url('upi_sertifikat/ajax_update')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form_addsertif').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                
                $('#modal_addsertif').modal('hide');
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
          url : "<?php echo site_url('upi_sertifikat/update_sisa_skp')?>",
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
             $('#btnSync').html('<i class="glyphicon glyphicon-cloud-upload"></i> Update Sisa Sertifikat');
             $('#btnSync').attr('disabled',false); //set button enable

            if(data.status == true){
              alert('Success! Berhasil update data sisa sertifikat');
            }else{
              alert('Error! Gagal update data sisa sertifikat');
            }
            reload_table();

          },
          error: function (jqXHR, textStatus, errorThrown)
          {
             $('#btnSync').html('<i class="glyphicon glyphicon-cloud-upload"></i> Update Sisa Sertifikat');
             $('#btnSync').attr('disabled',false); //set button enable
               alert('Error! Gagal update data sisa sertifikat');
          }
      });
  }
*/

</script>
