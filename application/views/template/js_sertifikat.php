
<script type="text/javascript">

var save_method; //for save method string
var table;

$(document).ready(function() {
  table = $('#table_sertifikat').DataTable({

    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.
  "searchable": true,
    // Load data for the table's content from an Ajax source
    "ajax": {
      "url": "<?php echo site_url('Sertifikat/ajax_list')?>",
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


  function insert_check()
  {
      var nama = document.forms["form_addsert"]["nama_sertifikat"].value;
     
     

    if(nama == "" )
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


  function add_data()
  {
      save_method = 'add';
      $('#form_addsert')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#modal_addsert').modal('show'); // show bootstrap modal
      $('.modal-title').text('#Tambah Sertifikat');
     
  }


  function delete_data(id)
    {
        if(confirm('Anda Yakin Ingin Menghapus Data ?'))
        {
            // ajax delete data to database
            $.ajax({
                url : "<?php echo site_url('sertifikat/ajax_delete')?>/"+id,
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
      $('#form_addsert')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('.modal-title').text('#Edit Sertifikat');
      //Ajax Load data from ajax
      $.ajax({
          url : "<?php echo site_url('sertifikat/ajax_view/')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {

              $('[name="id_detail"]').val(data.id_detail);
              $('[name="nama_sertifikat"]').val(data.nama_sertifikat);
              
             
              $('#modal_addsert').modal('show'); // show bootstrap modal when complete loaded
             

          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
  }



function save()
  {
    var url;
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable

    if(save_method == 'add'){
        url = "<?php echo site_url('sertifikat/ajax_add')?>";
    }
    else if(save_method == 'update'){
           url = "<?php echo site_url('sertifikat/ajax_update')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form_addsert').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                
                $('#modal_addsert').modal('hide');
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
</script>
