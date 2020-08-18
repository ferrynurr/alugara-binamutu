
<script type="text/javascript">

var save_method; //for save method string
var table;

$(document).ready(function() {
  table = $('#table_pembinaan').DataTable({

    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.
  "searchable": true,
    // Load data for the table's content from an Ajax source
    "ajax": {
      "url": "<?php echo site_url('pembinaan/ajax_list')?>",
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
      var tgl_pembinaan = document.forms["form_addpembinaan"]["tgl_pembinaan"].value;
      var id_user = document.forms["form_addpembinaan"]["id_user"].value;
      var id_upi = document.forms["form_addpembinaan"]["id_upi"].value;
      var pimpinan = document.forms["form_addpembinaan"]["pimpinan"].value;
      //var status = document.forms["form_addpembinaan"]["status"].value;



    if(tgl_pembinaan == "" || id_user == "" || id_upi == "" || pimpinan == "")
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


  function add_data() //add data
  {
      save_method = 'add';
     
      $('#form_addpembinaan')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#modal_addpembinaan').modal('show'); // show bootstrap modal
      $('.modal-title').text('#Tambah Jadwal Pembinaan');
      $(".select2").select2();
  }


  function delete_data(id)
    {
        if(confirm('Anda Yakin Ingin Menghapus Data ?'))
        {
            // ajax delete data to database
            $.ajax({
                url : "<?php echo site_url('pembinaan/ajax_delete')?>/"+id,
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
      $('#form_addpembinaan')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('.modal-title').text('#Edit Jadwal Pembinaan');
      //Ajax Load data from ajax
      $.ajax({
          url : "<?php echo site_url('pembinaan/ajax_view/')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {

              $('[name="id_pembinaan"]').val(data.id_pembinaan);
              $('[name="tgl_pembinaan"]').val(data.tgl_pembinaan);
              $('[name="id_user"]').val(data.id_user).trigger('change');
              $('[name="id_upi"]').val(data.id_upi).trigger('change');
              $('[name="pimpinan"]').val(data.pimpinan);
             // $('[name="status"]').val(data.status).trigger('change');
            
             
              $('#modal_addpembinaan').modal('show'); // show bootstrap modal when complete loaded
             

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
        url = "<?php echo site_url('pembinaan/ajax_add')?>";
    }
    else if(save_method == 'update'){
           url = "<?php echo site_url('pembinaan/ajax_update')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form_addpembinaan').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                
                $('#modal_addpembinaan').modal('hide');
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
          url : "<?php echo site_url('pembinaan/update_sisa_hari')?>",
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
             $('#btnSync').html('<i class="glyphicon glyphicon-cloud-upload"></i> Update Sisa Hari');
             $('#btnSync').attr('disabled',false); //set button enable

            if(data.status == true){
              alert('Success! Berhasil update data sisa hari');
            }else{
              alert('Error! Gagal update data sisa hari');
            }
            reload_table();

          },
          error: function (jqXHR, textStatus, errorThrown)
          {
             $('#btnSync').html('<i class="glyphicon glyphicon-cloud-upload"></i> Update Sisa Hari');
             $('#btnSync').attr('disabled',false); //set button enable
               alert('Error! Gagal update data sisa Hari');
          }
      });
  } */

  


</script>
