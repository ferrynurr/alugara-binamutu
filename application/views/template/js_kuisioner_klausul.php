
<script type="text/javascript">

var save_method; //for save method string
var table;

$(document).ready(function() {
  table = $('#table_klausul').DataTable({

    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.
  "searchable": true,
    // Load data for the table's content from an Ajax source
    "ajax": {
      "url": "<?php echo site_url('kuisioner_klausul/ajax_list')?>",
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
      var nama = document.forms["form_addklausul"]["nama_klausul"].value;
     
    if(nama == "")
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
      $('#form_addklausul')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#modal_addklausul').modal('show'); // show bootstrap modal
      $('.modal-title').text('#Tambah Klausul');
     
  }

  function delete_data(id)
    {
        if(confirm('Anda Yakin Ingin Menghapus Data ?'))
        {
            // ajax delete data to database
            $.ajax({
                url : "<?php echo site_url('kuisioner_klausul/ajax_delete')?>/"+id,
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
      $('#form_addklausul')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('.modal-title').text('#Edit Klausul');
      //Ajax Load data from ajax
      $.ajax({
          url : "<?php echo site_url('kuisioner_klausul/ajax_view/')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {

              $('[name="id_klausul"]').val(data.id_klausul);
              $('[name="nama_klausul"]').val(data.nama_klausul);
              
             
              $('#modal_addklausul').modal('show'); // show bootstrap modal when complete loaded
             

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
        url = "<?php echo site_url('kuisioner_klausul/ajax_add')?>";
    }
    else if(save_method == 'update'){
           url = "<?php echo site_url('kuisioner_klausul/ajax_update')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form_addklausul').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                
                $('#modal_addklausul').modal('hide');
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
